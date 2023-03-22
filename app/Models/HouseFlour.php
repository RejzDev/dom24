<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseFlour extends Model
{
    use HasFactory;
    public $timestamps = false;


    public function create(array $data, int $houseId)
    {

        $arrFlour = array();


        foreach ($data['nameFlour'] as $item){
            $arrFlour[] =  ['name' => $item, 'houses_id' => $houseId];
        }

        $this->insert(
            $arrFlour
        );


        return $this->id;
    }


    public function updates(array $data, int $id)
    {

        $arraySave = array();


        foreach ($data['nameFlour'] as $key=>$item){
            $arraySave[] = ['id' => isset($data['idFlour'][$key]) ? $data['idFlour'][$key] : null,'name' => $item, 'houses_id' => $id];

        }


        $result = $this->upsert($arraySave, ['id'], ['name', 'houses_id']);

        return $result;
    }

    public function getFlourIds($id)
    {
        return $this->find($id);
    }
}
