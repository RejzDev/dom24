<?php

namespace App\Http\Controllers;

use App\Models\Apartaments;
use App\Models\House;
use App\Models\PersonalAccounts;
use App\Models\Tariff;
use App\Models\User;
use Illuminate\Http\Request;

class ApartamentsController extends Controller
{
    public function create()
    {

        $modelTariff = new Tariff();
        $modelAccounts = new PersonalAccounts();
        $modelHouse = new House();
        $modelUser = new User();


        $house = $modelHouse->getHouse();
        $tariffs = $modelTariff->getTariff();
        $accounts = $modelAccounts->getAccounts();
        $users = $modelUser->getUsers();

        return view('admin.apartaments.create', ['houses' => $house, 'tariffs' => $tariffs,
                                                        'accounts' => $accounts, 'users' => $users]);
    }

    public function getHouse(Request $request): object
    {
        $modelHouse = new House();
        $data = $request->all();
        $house = $modelHouse->getHouseIds($data['name']);



        return response()->json($house);
    }

    public function save(Request $request)
    {

        $request->validate([
            'numberApartaments' => 'required',
            'house' => 'required',

        ], [
                'numberApartaments.required' => 'Введите номер',
                'house.required' => 'Виберете дом'
            ]);

        $modelApartament = new Apartaments();
        $modelAccount = new PersonalAccounts();

        $data = $request->all();



        $apartmantId = $modelApartament->creates($data);
        if ($data['numberPersonalAccount'] !== null) {
            $modelAccount->updateApartament($apartmantId, $data);
        }




        return redirect()->route('adminApartamentsCreate')->withSuccess('Успешно!');

    }


    public function index()
    {
        $modelApartaments = new Apartaments();



        $apartments = $modelApartaments->getApartaments();



        return view('admin.apartaments.main', ['apartments' => $apartments]);
    }

    public function edit($id)
    {
        $modelApartaments = new Apartaments();
        $modelTariff = new Tariff();
        $modelAccounts = new PersonalAccounts();
        $modelHouse = new House();
        $modelUser = new User();


        $house = $modelHouse->getHouse();
        $tariffs = $modelTariff->getTariff();
        $accounts = $modelAccounts->getAccounts();
        $users = $modelUser->getUsers();
        $apartments = $modelApartaments->getApartamentsIds($id);





        return view('admin.apartaments.edit', ['apartments' => $apartments, 'houses' => $house, 'tariffs' => $tariffs,
            'accounts' => $accounts, 'users' => $users]);
    }

    public function updates(Request $request, $id)
    {



        $request->validate([
            'numberApartaments' => 'required',
            'house' => 'required',
            'numberPersonalAccount' => 'unique:personal_accounts,number,'.$request->numberPersonalAccountId,

        ]);

        $modelApartament = new Apartaments();


        $data = $request->all();


        $apartaments = $modelApartament->getApartamentsIds($id);



        $modelApartament->updates($data, $apartaments);




        return redirect()->route('adminApartamentsIndex')->withSuccess('Успешно!');

    }

    public function show($id)
    {
        $modelApartaments = new Apartaments();

        $apartaments = $modelApartaments->getApartamentsIds($id);

        return view('admin.apartaments.show', ['apartaments' => $apartaments]);
    }

    public function remove($id)
    {
        $modelApartaments = new Apartaments();

        $apartaments = $modelApartaments->getApartamentsIds($id);

        $apartaments->delete();

        return redirect()->route('adminApartamentsIndex')->withSuccess('Успешно!');
    }

    public function getApartments(int $id)
    {
        $modelApartments = new Apartaments();
        $apartments = $modelApartments->getApartamentsIds($id);


        return json_encode($apartments);


    }
}
