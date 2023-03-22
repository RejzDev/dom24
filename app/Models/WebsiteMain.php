<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteMain extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function getData(): object
    {
        return $this->all();
    }

    public function create(array  $data)
    {

        $url_application = isset($data['url_application']) ? 1 : 0;

       $this->upsert([
           ['id' => $data['websiteId'],'title' => $data['websiteTitle'], 'description' => $data['DescriptionText'], 'url_application' => $url_application,
               'seo_title' => $data['seoTitle'], 'seo_description' => $data['seoDescription'], 'seo_keywords' => $data['seoKeywords'],],
          ], ['id'], ['title', 'description', 'url_application', 'seo_title', 'seo_description', 'seo_keywords']);
    }

}
