<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AccountTransaction extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'uid',
        'uid_date',
        'type',
        'description',
        'status',
        'amount',
        'account_id',
        'invoice_id',
        'user_admin_id',
        'transaction_purpose_id'
    ];


    public function account()
    {
        return $this->belongsTo(PersonalAccounts::class, 'account_id');
    }

    public function transactionPurpose()
    {
        return $this->belongsTo(TransactionPurpose::class, 'transaction_purpose_id');
    }

    public function getLastUid()
    {
        return $this->latest('id')->first()->uid;
    }

    public function getTransaction()
    {
        return $this->all();
    }


    public function getTransactionAccount()
    {
        return $this->whereNotNull('account_id')->get();
    }

    public function getAcountAmount()
    {
        return $this->selectRaw('account_id, type, sum(amount) as amount')->whereNotNull('account_id')->groupBy('account_id', 'type')->get();
    }

    public function getTransactionAmount()
    {
        $data = $this->whereNull('invoice_id')->get();
        $in = 0;
        $out = 0;

        foreach ($data as $item)
        {
            if ($item['type'] == 'in'){
                $in += $item['amount'];
            } else{
                $out += $item['amount'];
            }
        }

        $amount = $in - $out;

        return $amount;

    }


    public function storeInvoice(array $data, int $id)
    {


        if ($data['invoiceService']) {
            foreach ($data['invoiceService'] as $invoiceService) {


                $price = $invoiceService['price'];
            }
        } else {
            $price = 0.00;
        }


        if ($data['invoice']['is_checked'] == 1) {
                $status = 10;
        } else {
            $status = 0;
        }



        $transaction = AccountTransaction::create([
            'uid' => $this->getLastUid() + 1,
            'uid_date' => isset($data['invoice']['uid_date']) ? $data['invoice']['uid_date'] : NULL,
            'type' => 'out',
            'description' => NULL,
            'status' => $status,
            'amount' => $price,
            'account_id' => isset($data['account_numberId']) ? $data['account_numberId'] : NULL,
            'invoice_id' => isset($id) ? $id : NULL,
            'user_admin_id' => Auth::guard('admin')->user()->id,
            'transaction_purpose_id' => NULL,
        ]);

        return $transaction;
    }


    public function updateInvoice(array $data, int $id)
    {


        if ($data['invoiceService']) {
            foreach ($data['invoiceService'] as $invoiceService) {


                $price = $invoiceService['price'];
            }
        } else {
            $price = 0.00;
        }


        if ($data['invoice']['is_checked'] == 1) {

            $status = 10;
        } else {
            $status = 0;
        }

        $accounts = AccountTransaction::where('invoice_id', '=', $id)->get();

        $account = $accounts[0];


            $account->uid_date = isset($data['invoice']['uid_date']) ? $data['invoice']['uid_date'] : NULL;
            $account->type = 'out';
            $account->description = NULL;
            $account->status = $status;
            $account->amount = $price;
            $account->account_id = isset($data['account_numberId']) ? $data['account_numberId'] : NULL;
            $account->invoice_id = isset($id) ? $id : NULL;
            $account->user_admin_id = Auth::guard('admin')->user()->id;
            $account->transaction_purpose_id = NULL;


               $transaction = $account->save();
        return $transaction;
    }

    public function store(array $data)
    {

        if (isset($data['invoice']['is_checked'])) {
            $status = 10;
        } else {
            $status = null;
        }


        $transaction = AccountTransaction::create([
            'uid' => $data['transaction']['number'],
            'uid_date' => isset($data['transaction']['uid_date']) ? $data['transaction']['uid_date'] : NULL,
            'type' => $data['transaction']['type'],
            'description' => isset($data['transaction']['description']) ? $data['transaction']['description'] : NULL,
            'status' => $status,
            'amount' => $data['transaction']['amount'],
            'account_id' => isset($data['transaction']['account_id']) ? $data['transaction']['account_id'] : NULL,
            'invoice_id' => null,
            'user_admin_id' => $data['transaction']['admin'],
            'transaction_purpose_id' => $data['transaction']['transaction_purpose_id'],
        ]);

        return $transaction;
    }

    public function updates(AccountTransaction $accountTransaction, array $data)
    {

        if (isset($data['invoice']['is_checked'])) {
            $status = 10;
        } else {
            $status = null;
        }



            $accountTransaction->uid = $data['transaction']['number'];
            $accountTransaction->uid_date = isset($data['transaction']['uid_date']) ? $data['transaction']['uid_date'] : NULL;
            $accountTransaction->type = $data['transaction']['type'];
            $accountTransaction->description = isset($data['transaction']['description']) ? $data['transaction']['description'] : NULL;
            $accountTransaction->status = $status;
            $accountTransaction->amount = $data['transaction']['amount'];
            $accountTransaction->account_id = isset($data['transaction']['account_id']) ? $data['transaction']['account_id'] : NULL;
            $accountTransaction->invoice_id = null;
            $accountTransaction->user_admin_id = $data['transaction']['admin'];
            $accountTransaction->transaction_purpose_id = $data['transaction']['transaction_purpose_id'];

        $accountTransaction->update();


        return $accountTransaction;
    }




    public function getCashboxIn()
    {

        $ins = $this->where([['type', '=', 'in'], ['status', '=', 10]])->sum('amount');

        return $ins;
    }

    public function getCashboxOut()
    {

        $outs = $this->where([['type', '=', 'out'], ['status', '=', 10]])->whereNull('account_id')->sum('amount');


        return $outs;
    }

    public function getCashboxBalance()
    {

        $balance = $this->getCashboxIn() - $this->getCashboxOut();
        return $balance;
    }

}
