<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseSection extends Model
{
    use HasFactory;
    public $timestamps = false;


    public function create(array $data, int $houseId)
    {

        $arrSection = array();


        foreach ($data['nameSection'] as $item){
            $arrSection[] =  ['name' => $item, 'houses_id' => $houseId];
        }

        $this->insert(
            $arrSection
        );


        return $this->id;
    }


    public function updates(array $data, int $id)
    {

        $arraySave = array();

        foreach ($data['nameSection'] as $key=>$item){
             $arraySave[] = ['id' => isset($data['idSection'][$key]) ? $data['idSection'][$key] : null  ,'name' => $item, 'houses_id' => $id];

        }


        $result = $this->upsert($arraySave, ['id'], ['name', 'houses_id']);

        return $result;
    }

    public function apartaments()
    {
        return $this->hasMany(Apartaments::class,'house_sections_id', 'id');
    }

    public function getSectionIds($id)
    {
        return $this->with('apartaments')->find($id);
    }
}
