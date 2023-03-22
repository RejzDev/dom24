<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'userid',
        'firstname',
        'lastname',
        'middlename',
        'birthdate',
        'phone',
        'viber',
        'telegram',
        'image',
        'email',
        'password',
        'status',
        'note',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function house()
    {
        return $this->belongsToMany(House::class, 'apartaments', 'user_id', 'houses_id', 'id', 'id');
    }

    public function apartaments()
    {
        return $this->hasMany(Apartaments::class,'user_id');
    }


    public function getUsers()
    {
        return $this->all();
    }
    public function getUserIds(int $id)
    {
        return $this->find($id);
    }

    public function creates(array $data)
    {
        $this->userid = $data['uid'];
        $this->status = $data['status'];
        $this->firstname = $data['firstname'];
        $this->lastname = $data['lastname'];
        $this->middlename = $data['middlename'];
        $this->birthdate = $data['birthdate'];
        $this->phone = $data['phone'];
        $this->viber = $data['viber'];
        $this->telegram = $data['telegram'];
        $this->image = isset($data['pathImage']) ? $data['pathImage'] : null;
        $this->note = $data['note'];
        $this->email = $data['email'];
        $this->password = Hash::make($data['password']);

        $user = $this->save();

        return $this->id;
    }

    public function updates(array $data, int $id)
    {
        $user = $this->getUserIds($id);

        $user->userid = $data['uid'];
        $user->status = $data['status'];
        $user->firstname = $data['firstname'];
        $user->lastname = $data['lastname'];
        $user->middlename = $data['middlename'];
        $user->birthdate = $data['birthdate'];
        $user->phone = $data['phone'];
        $user->viber = $data['viber'];
        $user->telegram = $data['telegram'];
        $user->image = isset($data['pathImage']) ? $data['pathImage'] : null;
        $user->note = $data['note'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);

        $users = $user->save();

        return $user->id;
    }
}
