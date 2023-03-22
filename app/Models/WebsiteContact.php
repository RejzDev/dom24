<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteContact extends Model
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
            ['id' => $data['websiteContactId'],'title' => $data['websiteContactTitle'], 'description' => $data['websiteContactDescriptionText'],
                'url_comersial_site' => $data['websiteContactAddress'], 'name_company' => $data['websiteContactNameCompany'], 'location' => $data['websiteContactLocation'],
                'address' => $data['websiteContactAddress'], 'phone' => $data['websiteContactPhone'], 'email' => $data['websiteContactEmail'], 'code_maps' => $data['websiteContactCodeMap'],
                'seo_title' => $data['seoTitle'], 'seo_description' => $data['seoDescription'], 'seo_keywords' => $data['seoKeywords'],
                ],
        ], ['id'], ['title', 'description', 'url_comersial_site', 'name_company', 'location', 'address', 'phone', 'email','code_maps', 'seo_title', 'seo_description', 'seo_keywords']);

        return $this->id;
    }
}
