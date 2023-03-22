<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteServicesPage extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function create(array $data)
    {

        $this->upsert([
            ['id' => $data['websiteServicesPageId'], 'seo_title' => $data['seoTitle'], 'seo_description' => $data['seoDescription'], 'seo_keywords' => $data['seoKeywords'
            ],],
        ], ['id'], ['seo_title', 'seo_description', 'seo_keywords']);

        return $this->id;
    }

    public function getData(): object
    {
        return $this->all();
    }
}
