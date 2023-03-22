<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceUnit extends Model
{
    use HasFactory;
    public $timestamps = false;


    public function service()
    {
        return $this->hasMany(Service::class, 'service_unit_id', 'id');
    }

    public function getData(): object
    {
        return $this->with('service')->get();
    }
    public function getDataIds($id): object
    {
        return $this->find($id);
    }



    public function create(array $data)
    {

        $arraySave = array();

        foreach ($data['unit'] as $key=>$item){

            $arraySave[] = [
                'id' => $item['id'], 'name' => $item['name'],
            ];


        }


        $result = $this->upsert($arraySave, ['id'], ['name']);

        return $result;
    }

    public function deleteUnit(int $id)
    {
        return $this->destroy($id);
    }

}
