<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteAboutGalery extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function getGallery(): object
    {
       return $this->where('sort', '=', 0)->get();
    }

    public function getDopGallery(): object
    {
        return $this->where('sort', '=', 1)->get();
    }

    public function saveGallery(array $data)
    {

        $arrGallery = array();


        foreach ($data['aboutGallery'] as $key => $item){
            $arrGallery[] =  ['image' => $item, 'sort' => $key];
        }

        $this->insert(
            $arrGallery
        );


        return $this->id;
    }

    public function deleteImage(int $id)
    {
        return $this->destroy($id);
    }

    public function getGalleryIds(int $id): object
    {
        return $this->find($id);
    }

}
