<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteMainSlide extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function getSlide(): object
    {
        return $this->all();
    }


    public function create(array $data)
    {
        $id = $this->max('id');

        $arraySave = array();

        foreach ($data['pathImage'] as $key=>$item){
            if (isset($data['slideSave'][$key]) && $data['slideSave'][$key] !== $data['pathImage'][$key]){
                $arraySave[] = [
                    'id' => $data['idSlide'][$key],'image' => $data['slideSave'][$key], 'sort' => 0
                ];
            } else if (isset($data['slideSave'][$key]) && $data['pathImage'][$key] === null){
                $arraySave[] = [
                    'id' => $id += '1','image' => $data['slideSave'][$key], 'sort' => 0
                ];
            }

        }


       $result = $this->upsert($arraySave, ['id', 'image'], ['image']);

       return $id;
    }
}
