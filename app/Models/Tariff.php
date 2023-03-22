<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    use HasFactory;

    public function tariffService()
    {
        return $this->hasMany(TariffService::class, 'tariff_id', 'id');
    }

    public function getTariff()
    {
        return $this->with('tariffService')->get();
    }

    public function getTariffIds($id)
    {
        return $this->with('tariffService')->find($id);
    }


    public function create(array $data)
    {
        $this->name = $data['tariff']['name'];
        $this->description = $data['tariff']['description'];
        $this->is_default = 0;

        $this->save();

        return $this->id;
    }

    public function updates(Tariff $tariff,array $data)
    {
        $tariff->name = $data['tariff']['name'];
        $tariff->description = $data['tariff']['description'];
        $tariff->is_default = 0;

        $tariff->save();

        return $this->id;
    }

}
