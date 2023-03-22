<?php

namespace App\Http\Controllers;

use App\Models\AccountTransaction;
use App\Models\PersonalAccounts;
use App\Models\TransactionPurpose;
use App\Models\User;
use App\Models\UserAdmin;
use Illuminate\Http\Request;

class AccountTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $modelAccount= new PersonalAccounts();
        $modelTransaction = new AccountTransaction();



        $data['debt'] = $modelAccount->getBalanceDebtTotal();
        $data['total'] = $modelAccount->getBalanceTotal();


        $data['cashBox'] = $modelTransaction->getCashboxBalance();

        $modelPurpose = new TransactionPurpose();
        $purpose = $modelPurpose->all();




        $accountTransaction = $modelTransaction->where('transaction_purpose_id', '!=', null)->get();
        return view('admin.transaction.main', [ 'accountTransaction' => $accountTransaction, 'data' => $data, 'purpose' => $purpose]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {


        $modelAccount = new PersonalAccounts();
        $modelUser = new User();
        $modelTransaction = new AccountTransaction();

        $accounts = $modelAccount->getAccounts();
        $users = $modelUser->getUsers();
        $transactionUid = $modelTransaction->getLastUid() + 1;

        $modelUserAdmin = new UserAdmin();
        $usersAdmin = $modelUserAdmin->all();

        if ($request->input('type') == 'out'){
            $type = 'out';
        } else{
            $type = 'in';
        }
        $modelPurpose = new TransactionPurpose();
        $purpose = $modelPurpose->where('type', '=', $type)->get();



        return view('admin.transaction.create', ['accounts' => $accounts, 'users' => $users, 'transactionUid' => $transactionUid, 'usersAdmin' => $usersAdmin, 'purpose' => $purpose]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();
        $modelTransaction = new AccountTransaction();

        $modelTransaction->store($data);

        return redirect()->back()->withSuccess('Успешно!');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\AccountTransaction $accountTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(AccountTransaction $accountTransaction)
    {

        return view('admin.transaction.show', ['transaction' => $accountTransaction]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\AccountTransaction $accountTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(AccountTransaction $accountTransaction)
    {
        $modelAccount = new PersonalAccounts();
        $modelUser = new User();
        $modelTransaction = new AccountTransaction();

        $accounts = $modelAccount->getAccounts();
        $users = $modelUser->getUsers();
        $transactionUid = $modelTransaction->getLastUid() + 1;

        $modelUserAdmin = new UserAdmin();
        $usersAdmin = $modelUserAdmin->all();


        $modelPurpose = new TransactionPurpose();
        $purpose = $modelPurpose->where('type', '=', $accountTransaction->type)->get();





        return view('admin.transaction.edit', ['accounts' => $accounts, 'users' => $users,
            'transactionUid' => $transactionUid, 'usersAdmin' => $usersAdmin, 'purpose' => $purpose,
            'accountTransaction' => $accountTransaction]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AccountTransaction $accountTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccountTransaction $accountTransaction)
    {
        $data = $request->all();


        $accountTransaction->updates($accountTransaction, $data);

        return redirect()->back()->withSuccess('Успешно!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\AccountTransaction $accountTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountTransaction $accountTransaction)
    {
        //
    }


    public function getUser($id)
    {
        $modelUser = new User();

        $user = $modelUser->getUserIds($id);

        $user->apartaments;


       foreach ($user->apartaments as $item){
           $apart[] = $item->accounts;
       }

        return json_encode($apart);
    }
}
