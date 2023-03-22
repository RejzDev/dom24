<?php

namespace App\Http\Controllers;

use App\Helper\ImageSaver;
use App\Models\House;
use App\Models\HouseFlour;
use App\Models\HouseSection;
use App\Models\UserAdmin;
use Illuminate\Http\Request;

class HouseController extends Controller
{

    public function index()
    {
        $modelHouse = new House();

        $houses = $modelHouse->getHouse();

        return view('admin.house.main', ['houses' => $houses]);
    }

    public function show(int $id)
    {
        $modelHouse = new House();

        $house = $modelHouse->getHouseIds($id);

        return view('admin.house.show', ['house' => $house]);
    }

    public function edit(int $id)
    {
        $modelHouse = new House();


        $house = $modelHouse->getHouseIds($id);


        return view('admin.house.edit', ['house' => $house]);
    }

    public function create()
    {
        $modelUser = new UserAdmin();
        $users = $modelUser->all();

        return view('admin.house.create', ['users' => $users]);

    }


    public function save(Request $request)
    {


        $request->validate([
            'houseImage.*' => 'mimes:jpeg,jpg,png,svg|max:5000',
            'nameFlour.*' => 'required',
            'nameSection.*' => 'required',

        ]);

        $modelHouse = new House();
        $modelHouseSection = new HouseSection();
        $modelHouseFlour = new HouseFlour();
        $imageSaved = new ImageSaver();


        $data = $request->all();



        if ($request->file('houseImage') !== null) {

            $file = $request->file('houseImage');
            foreach ($file as $key => $item) {
                $path[$key] = $imageSaved->upl($item, 'house');
            }

            $data['houseImages'] = $path;

        }
        $houseId =  $modelHouse->create($data);
        $sectionId =  $modelHouseSection->create($data, $houseId);
        $flourId =  $modelHouseFlour->create($data,$houseId);



        return redirect()->route('adminHouseIndex')->withSuccess('Успешно!');
    }


    public function update(Request $request, $id)
    {




        $request->validate([
            'houseImage.*' => 'mimes:jpeg,jpg,png,svg|max:5000',
            'nameFlour.*' => 'required',
            'nameSection.*' => 'required',

        ]);

        $modelHouse = new House();
        $modelHouseSection = new HouseSection();
        $modelHouseFlour = new HouseFlour();
        $imageSaved = new ImageSaver();

        $house = $modelHouse->getHouseIds($id);
        $data = $request->all();


        if ($request->file('houseImage') !== null) {
            $file = $request->file('houseImage');


            foreach ($file as $key => $item) {
                if ($data['pathHouseImage'] !== null) {
                    $imageSaved->remove($data['pathHouseImage'][$key]);
                }
                $path[$key] = $imageSaved->upl($item, 'house');
            }

            $data['houseImages'] = $path;

        }

        $houseId =  $modelHouse->updates($data, $house);
        if (isset($data['nameSection'])) {
            $sectionId = $modelHouseSection->updates($data, $id);
        }
        if (isset($data['nameFlour'])) {
            $flourId =  $modelHouseFlour->updates($data,$id);
        }




        return redirect()->route('adminHouseIndex')->withSuccess('Успешно!');
    }

    public function removeHouse($id)
    {
        $modelHouse = new House();
        $imageSaved = new ImageSaver();

        $house = $modelHouse->getHouseIds($id);
        $i = 1;
        foreach ($house as $key => $item) {
                $imageSaved->remove($house['image' . $i]);
                $i++;
        }
        $house->delete();

        return redirect()->route('adminHouseIndex')->withSuccess('Успешно!');
    }

    public function removeHouseFlour($id)
    {
        $modelHouseFlour = new HouseFlour();
        $flour =  $modelHouseFlour->getFlourIds($id);

        $flour->delete();

    }

    public function removeSectionFlour($id)
    {
        $modelHouseSection = new HouseSection();
        $section =  $modelHouseSection->getSectionIds($id);

        $section->delete();

    }


    public function houseId(int $id)
    {
        $modelHouse = new House();
        $house = $modelHouse->getHouseIds($id);


        return json_encode($house);


    }

    public function sectionId(int $id)
    {
        $modelHouseSection = new HouseSection();
        $section = $modelHouseSection->getSectionIds($id);


        return json_encode($section);


    }

}


