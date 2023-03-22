<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\PersonalAccounts;
use Illuminate\Http\Request;

class PersonalAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modelHouse = new House();
        $modelAccount = new PersonalAccounts();

        $houses = $modelHouse->getHouse();

        $accounts = $modelAccount->getAccounts();


        return view('admin.personalAccount.main', ['houses' => $houses, 'accounts' => $accounts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $modelHouse = new House();

        $houses = $modelHouse->getHouse();

        return view('admin.personalAccount.create', ['houses' => $houses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'account.number' => 'required',

        ], [
            'account.number.required' => 'Введите номер'
        ]);

        $modelAccount = new PersonalAccounts();

        $data = $request->all();


        $modelAccount->store($data);

        return redirect()->back()->withSuccess('Успешно!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PersonalAccounts  $personalAccount
     * @return \Illuminate\Http\Response
     */
    public function show(PersonalAccounts $personalAccount)
    {
        return view('admin.personalAccount.show', ['accounts' => $personalAccount]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PersonalAccounts  $personalAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(PersonalAccounts $personalAccount)
    {

        $modelHouse = new House();

        $houses = $modelHouse->getHouse();

        return view('admin.personalAccount.create', ['houses' => $houses, 'personalAccount' => $personalAccount]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PersonalAccounts  $personalAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PersonalAccounts $personalAccount)
    {

        $request->validate([
            'account.number' => 'required|unique:personal_accounts,number,'.$personalAccount->id,

        ], [
            'account.number.required' => 'Введите номер'
        ]);

        $data = $request->all();
        $personalAccount->getRelationValue('apartaments');



        $personalAccount->store($data);



        return redirect()->back()->withSuccess('Успешно!');

    }


    public function delete(int $id)
    {
        $modelAccount = new PersonalAccounts();

        $account = $modelAccount->getAccountsIds($id);

        $account->delete();

        return redirect()->back()->withSuccess('Успешно!');
    }

    public function getAccount(string $number)
    {
        $modelAccount = new PersonalAccounts();

        $account = $modelAccount->getAccountNumber($number);

        $account['house'] = $account->apartaments->houses;
        $account['section'] = $account->apartaments->sections;

        return json_encode($account);
    }


}
