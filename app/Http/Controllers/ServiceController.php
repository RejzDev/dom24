<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceUnit;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function edit()
    {



        $modelServices = new Service();
        $modelUnit = new ServiceUnit();

        $data['services'] = $modelServices->getData();
        $data['units'] = $modelUnit->getData();

        return view('admin.service.edit', ['data' => $data]);
    }

    public function saveService(Request $request){


        $modelServices = new Service();
        $modelUnit = new ServiceUnit();



        $data = $request->all();


        if (isset($data['service'])) {
            $result = $modelServices->create($data);
        }
        if (isset($data['unit'])) {
            $results = $modelUnit->create($data);
        }


        return redirect()->back()->withSuccess('Успешно!');
    }


    public function removeServices($id)
    {
        $service = new Service();

        $service->deleteServices($id);

        return redirect()->back()->withSuccess('Успешно удалено');
    }

    public function removeUnit($id)
    {
        $unit = new ServiceUnit();

        $unit->deleteUnit($id);

        return redirect()->back()->withSuccess('Успешно удалено');
    }


    public function ajaxServiceUnits($id)
    {

        $serviceModel = new Service();


        $service = $serviceModel->getDataIds($id);

        return json_encode($service);
    }
}
