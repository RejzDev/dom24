<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Array_;

class WebsiteAboutDocument extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function saveDocument(array $data)
    {

        foreach ($data['aboutDocument'] as $key => $item){
            $arrGallery[] =  ['patch' => $item, 'title' => $data['websiteDocumentTitle'][$key]];
        }

        $this->insert(
            $arrGallery
        );


        return $this->id;
    }

    public function getDocument(): object
    {
        return $this->all();
    }

    public function deleteDocument(int $id)
    {
        return $this->destroy($id);
    }

    public function getDocumentIds(int $id)
    {
        return $this->find($id);
    }
}
