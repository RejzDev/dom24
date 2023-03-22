<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TariffService extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function services()
    {
        return $this->hasMany(Service::class, 'id', 'service_id');
    }

    public function store(array $data, int $tariffId)
    {

        $units = array();

        foreach ($data['tariff']['service'] as $item) {
            $units = ['id' => $item['tariffServiceId'], 'price_unit' => $item['price'], 'tariff_id' => $tariffId, 'service_id' => $item['service_id'],];
        }

        $this::upsert([
            $units
        ], ['id'], ['price_unit', 'tariff_id', 'service_id']);

    }

    public function deleteService(int $id)
    {
        return $this->destroy($id);
    }

}
