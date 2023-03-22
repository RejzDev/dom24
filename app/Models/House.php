<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;
    public $timestamps = false;


    public function flours()
    {
        return $this->hasMany(HouseFlour::class,'houses_id');
    }



    public function sections()
    {
        return $this->hasMany(HouseSection::class,'houses_id');
    }

    public function getHouse()
    {
        return $this->with('flours', 'sections')->get();
    }

    public function getHouseIds(int $id)
    {
        return $this->with('flours', 'sections')->find($id);
    }

    public function create(array $data)
    {
        $this->house_name = $data['name'];
        $this->house_address = $data['addressHouse'];

        $this->image1 = isset($data['houseImages'][0]) ? $data['houseImages'][0] : null;
        $this->image2 = isset($data['houseImages'][1]) ? $data['houseImages'][1] : null;
        $this->image3 = isset($data['houseImages'][2]) ? $data['houseImages'][2] : null;
        $this->image4 = isset($data['houseImages'][3]) ? $data['houseImages'][3] : null;
        $this->image5 = isset($data['houseImages'][4]) ? $data['houseImages'][4] : null;

        $this->save();


        return $this->id;
    }

    public function updates(array $data, House $house)
    {
        $house->house_name = $data['name'];
        $house->house_address = $data['addressHouse'];

        $house->image1 = isset($data['houseImages'][0]) ? $data['houseImages'][0] : $data['pathHouseImage'][0];
        $house->image2 = isset($data['houseImages'][1]) ? $data['houseImages'][1] : $data['pathHouseImage'][1];
        $house->image3 = isset($data['houseImages'][2]) ? $data['houseImages'][2] : $data['pathHouseImage'][2];
        $house->image4 = isset($data['houseImages'][3]) ? $data['houseImages'][3] : $data['pathHouseImage'][3];
        $house->image5 = isset($data['houseImages'][4]) ? $data['houseImages'][4] : $data['pathHouseImage'][4];

        $house->update();

        return $house->id;
    }


}
