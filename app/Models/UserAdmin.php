<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class UserAdmin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public $timestamps = false;
    protected $fillable = [
        'firstname',
        'lastname',
        'phone',
        'email',
        'password',
        'status',
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


    public function creates(array $data)
    {


        $this->firstname = $data['UserAdmin']['firstname'];
        $this->lastname = $data['UserAdmin']['lastname'];
        $this->phone = $data['UserAdmin']['phone'];
        $this->status = $data['UserAdmin']['status'];
        $this->email = $data['email'];
        $this->password = Hash::make($data['UserAdmin']['password']);

        $users = $this->save();

        $user = $this->find($this->id);
        $role = Role::findByName($data['UserAdmin']['role'], 'admin');
        $user->assignRole($role);

        return $this->id;
    }

    public function updates(array $data, int $id)
    {
        $user = $this->find($id);
        $rolesUser = $user->getRoleNames();

        $role = Role::findByName($data['UserAdmin']['role'], 'admin');

        if (isset($rolesUser[0])){
            $user->removeRole($rolesUser[0]);
        }
           $user->assignRole($role);

        $user->firstname = $data['UserAdmin']['firstname'];
        $user->lastname = $data['UserAdmin']['lastname'];
        $user->phone = $data['UserAdmin']['phone'];
        $user->status = $data['UserAdmin']['status'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['UserAdmin']['password']);

        $users = $user->save();



        return $user->id;
    }



}
