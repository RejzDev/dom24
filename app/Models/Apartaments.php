<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartaments extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function flours()
    {
        return $this->belongsTo(HouseFlour::class,'house_flour_id');
    }

    public function tariffs()
    {
        return $this->belongsTo(Tariff::class,'tariff_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function sections()
    {
        return $this->belongsTo(HouseSection::class,'house_sections_id');
    }
    public function accounts()
    {
        return $this->hasOne(PersonalAccounts::class,'apartaments_id');
    }

    public function houses()
    {
        return $this->belongsTo(House::class,'houses_id');
    }

    public function getApartaments()
    {
        return $this->with('flours', 'sections', 'tariffs', 'houses', 'users', 'accounts')->get();
    }

    public function getApartamentsIds(int $id)
    {
        return $this->with('flours', 'sections', 'tariffs', 'houses', 'users', 'accounts')->find($id);
    }


    public function creates(array $data)
    {
        $this->number = $data['numberApartaments'];
        $this->square = $data['squareApartaments'];
        $this->houses_id = $data['house'];
        $this->house_sections_id = $data['section'];
        $this->house_flour_id = $data['flours'];
        $this->user_id = $data['owner'];
        $this->tariff_id = $data['tariff'];

        $apartaments = $this->save();

        return $this->id;
    }

    public function updates(array $data, $apartaments)
    {
        $apartaments->number = $data['numberApartaments'];
        $apartaments->square = $data['squareApartaments'];
        $apartaments->houses_id = $data['house'];
        $apartaments->house_sections_id = $data['section'];
        $apartaments->house_flour_id = $data['flours'];
        $apartaments->user_id = $data['owner'];
        $apartaments->tariff_id = $data['tariff'];

        $apartament = $apartaments->update();

        return $apartaments->id;
    }
}
