<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteServices extends Model
{
    use HasFactory;
    public $timestamps = false;


    public function getServices(): object
    {
        return $this->all();
    }

    public function create(array $data)
    {
        $id = $this->max('id');

        $arraySave = array();

        foreach ($data['websiteServicesTitle'] as $key=>$item){
            if ($data['websiteServicesTitle'][$key] !== null && !isset($data['servicesSave'][$key])){
                $arraySave[] = [
                    'id' => $data['idWebsiteServices'][$key],'image' => $data['pathWebsiteServicesImage'][$key], 'name' => $data['websiteServicesTitle'][$key], 'description' => $data['smallText'][$key],
                ];
            } else if (isset($data['servicesSave'][$key]) && $data['servicesSave'][$key] !== $data['pathWebsiteServicesImage'][$key]){
                $arraySave[] = [
                    'id' => $data['idWebsiteServices'][$key],'image' => $data['servicesSave'][$key], 'name' => $data['websiteServicesTitle'][$key], 'description' => $data['smallText'][$key],
                ];
            }
            else if (isset($data['servicesSave'][$key]) && $data['pathWebsiteServicesImage'][$key] === null){
                $arraySave[] = [
                    'id' => $id += '1','image' => $data['servicesSave'][$key], 'name' => $data['websiteServicesTitle'][$key], 'description' => $data['smallText'][$key],
                ];
            }

        }


        $result = $this->upsert($arraySave, ['id'], ['image', 'name', 'description']);

        return $result;
    }

    public function deleteServices(int $id)
    {
        return $this->destroy($id);
    }

    public function getServicesIds(int $id): object
    {
        return $this->find($id);
    }

    public function getServicesPaginate()
    {
        return $this->paginate(4);
    }
}
