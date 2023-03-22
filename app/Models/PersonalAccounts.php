<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PersonalAccounts extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function apartaments()
    {
        return $this->hasOne(Apartaments::class, 'id', 'apartaments_id');
    }

    public function getAccounts(): object
    {
        return $this->with('apartaments')->get();
    }
    public function accountTransactions(): object
    {
        return $this->hasMany(AccountTransaction::class, 'account_id', 'id');
    }

    public function getAccountsIds(int $id) : PersonalAccounts
    {
        return $this->with('apartaments')->find($id);
    }

    public function getAccountNumber(string $number)
    {

        $account = $this->where('number', '=', $number)->limit(1)->get();
        return $account[0];
    }

    public function updateApartament(int $apartmentId, array $data): int
    {

        $account = $this->getAccountNumber($data['numberPersonalAccount']);

        $account->apartaments_id = $apartmentId;

        $account->update();

        return $account->id;
    }
    public function deleteApartament($apartaments): int
    {



        $account = $apartaments['accounts'][0];

        $account->apartaments_id = "";

        $account->update();

        return $account->id;
    }


    public function store(array $data)
    {


        $this::upsert([
            'id' => $data['account']['accountId'], 'number' => $data['account']['number'], 'status' => $data['account']['status'], 'apartaments_id' => $data['account']['apartments_id']
        ], ['id'], ['number', 'status', 'apartaments_id']);

    }




    public function getBalance()
    {

        $ins = $this->accountTransactions()->where([['type', '=', 'in'], ['status', '=', 10]])->sum('amount');

        $outs = $this->accountTransactions()->where([['type', '=', 'out'], ['status', '=', 10]])->sum('amount');

        $balance = $ins - $outs;


        return $balance;
    }





    public function getBalanceTotal()
    {


        $accountsQuery =  $this->select('personal_accounts.*')->join('account_transactions', 'personal_accounts.id', '=', 'account_transactions.account_id')
            ->whereNotNull('account_transactions.account_id')->whereNull('invoice_id')->groupBy('account_transactions.account_id')->get();


        $total = 0;
        foreach ($accountsQuery as $account){
            $balance = $account->getBalance();
            if ($balance > 0) {
                $total += $balance;
            }
        }


        return $total;
    }


    public function getBalanceDebtTotal()
    {


       $accountsQuery =  $this->select('personal_accounts.*')->join('apartaments', 'apartaments.id', '=', 'personal_accounts.apartaments_id')->with('apartaments')
           ->get();


        $total = 0;
        foreach ($accountsQuery as $account){



            $balance = $account->getBalance();
            if ($balance < 0) {
                $total += $balance;
            }
        }


        return $total;
    }

}
