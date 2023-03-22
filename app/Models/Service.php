<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class Service extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function getData(): object
    {
        return $this->with('units')->get();
    }
    public function getDataIds($id): object
    {
        return $this->with('units')->find($id);
    }

    public function units()
    {
        return $this->hasOne(ServiceUnit::class, 'id', 'service_unit_id');
    }

    public function create(array $data)
    {

        $arraySave = array();

        foreach ($data['service'] as $key=>$item){

                $arraySave[] = [
                    'id' => $item['id'], 'name' => $item['name'], 'is_counter' => $item['is_counter'], 'service_unit_id' => $item['serviceUnit'],
                ];


        }


        $result = $this->upsert($arraySave, ['id'], ['name', 'is_counter', 'service_unit_id']);

        return $result;
    }

    public function deleteServices(int $id)
    {
        return $this->destroy($id);
    }

}
