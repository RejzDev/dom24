<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseAdmin extends Model
{
    use HasFactory;


    public function create(array $data, int $houseId)
    {

        $arrFlour = array();


        foreach ($data['houseUser'] as $item){
            $arrUser[] =  ['admin_id' => $item, 'houses_id' => $houseId];
        }

        $this->insert(
            $arrUser
        );


        return $this->id;
    }
}
