<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceUnit;
use App\Models\Tariff;
use App\Models\TariffService;
use Illuminate\Http\Request;

class TariffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modelTariff = new Tariff();

        $data = $modelTariff->getTariff();

        return view('admin.tariff.main', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $modelServices = new Service();
        $modelTariff = new Tariff();

        $tariffId = $request->get('tariff_id');
        $tariff = $modelTariff->getTariffIds($tariffId);

        $data = $modelServices->getData();


        return view('admin.tariff.create', ['data' => $data, 'tariff' => $tariff]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $modelTariff = new Tariff();
        $modelService = new TariffService();

        $data = $request->all();


        $tariffId = $modelTariff->create($data);
        $serviceId = $modelService->store($data, $tariffId);

        return redirect()->back()->withSuccess('Успешно!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tariff  $tariff
     * @return \Illuminate\Http\Response
     */
    public function show(Tariff $tariff)
    {
        $tariff->getRelationValue('tariffService');

        return view('admin.tariff.show', ['tariff' => $tariff]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tariff  $tariff
     * @return \Illuminate\Http\Response
     */
    public function edit(Tariff $tariff)
    {
        $modelServices = new Service();

        $tariff->getRelationValue('tariffService');
        $data = $modelServices->getData();



        return view('admin.tariff.edit', ['data' => $data, 'tariff' => $tariff]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tariff  $tariff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tariff $tariff)
    {

        $modelService = new TariffService();

        $data = $request->all();


        $tariff->updates($tariff, $data);
        $serviceId = $modelService->store($data, $tariff['id']);

        return redirect()->back()->withSuccess('Успешно!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tariff  $tariff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tariff $tariff)
    {
        $tariff->delete();
        return redirect()->back()->withSuccess('Успешно!');
    }


    public function removeTariffServices($id)
    {
        $tariffService = new TariffService();

        $tariffService->deleteService($id);

        return redirect()->back()->withSuccess('Успешно удалено');
    }

    public function getTariffId(int $id)
    {
        $modelTariff = new Tariff();
        $modelService = new Service();
        $modelUnit = new ServiceUnit();

        $tariff = $modelTariff->getTariffIds($id);
        $data['tariffServices'] = $tariff->tariffService;
        $data['services'] = $modelService->getData();
        $data['serviceUnit'] = $modelUnit->getData();



        return json_encode($data);
    }

}
