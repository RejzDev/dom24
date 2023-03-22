<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteAbout extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function getData(): object
    {
        return $this->all();
    }

    public function create(array $data)
    {

        $this->upsert([
            ['id' => $data['websiteAboutId'],'title' => $data['websiteAboutTitle'], 'description' => $data['AboutDescriptionText'], 'image' => $data['pathWebsiteAboutImage'],
                'dop_title' => $data['websiteAboutDopTitle'], 'dop_description' => $data['websiteAboutDopDescriptionText'],
                'seo_title' => $data['seoTitle'], 'seo_description' => $data['seoDescription'], 'seo_keywords' => $data['seoKeywords'
            ],],
        ], ['id'], ['title', 'description', 'image', 'dop_title', 'dop_description',  'seo_title', 'seo_description', 'seo_keywords']);

    return $this->id;
    }
}
