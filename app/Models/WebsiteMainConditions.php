<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteMainConditions extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function getAll(){
        return $this->all();
    }


    public function create(array $data)
    {
        $id = $this->max('id');

        $arraySave = array();

        foreach ($data['conditionsTitle'] as $key=>$item){
            if ($data['conditionsTitle'][$key] !== null && !isset($data['conditionsSave'][$key])){
                $arraySave[] = [
                    'id' => $data['idConditions'][$key],'image' => $data['pathConditionsImage'][$key], 'title' => $data['conditionsTitle'][$key], 'description' => $data['smallText'][$key],
                ];
            } else if (isset($data['conditionsSave'][$key]) && $data['conditionsSave'][$key] !== $data['pathConditionsImage'][$key]){
                $arraySave[] = [
                    'id' => $data['idConditions'][$key],'image' => $data['conditionsSave'][$key], 'title' => $data['conditionsTitle'][$key], 'description' => $data['smallText'][$key],
                ];
            }
            else if (isset($data['conditionsSave'][$key]) && $data['pathConditionsImage'][$key] === null){
                $arraySave[] = [
                    'id' => $id += '1','image' => $data['conditionsSave'][$key], 'title' => $data['conditionsTitle'][$key], 'description' => $data['smallText'][$key],
                ];
            }

        }


        $result = $this->upsert($arraySave, ['id'], ['image', 'title', 'description']);

        return $result;
    }
}
