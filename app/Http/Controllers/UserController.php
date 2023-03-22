<?php

namespace App\Http\Controllers;

use App\Helper\ImageSaver;
use App\Models\House;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function create()
    {

        return view('admin.users.create');
    }

    public function save(Request $request)
    {

        $request->validate([
            'email'            => 'required|email|unique:users',     // required and must be unique in the ducks table
            'password'         => 'required',
            'password2'         => 'required|same:password'

        ],
        [
        'email.required' => 'Необходимо заполнить «Email (логин)».!',
            'email.unique' => 'Email (логин) должен бить уникальним.!',
            'email.email' => 'Email (логин) должен иметь @.!',
            'password.required' => 'Необходимо заполнить «Пароль».',
            'password2.required' => 'Необходимо заполнить «Повторить пароль».',
            'password2.same' => 'Пароль не совпадает',
        ]
        );


        $modelUser = new User();
        $imageSave = new ImageSaver();



        $data = $request->all();



        if ($request->file('image') !== null) {
            $file = $request->file('image');

            if ($data['imageId'] !== null) {
                $imageSave->remove($data['imageId']);
            }
            $data['pathImage'] = $imageSave->upl($file, 'user');

        }


        $user = $modelUser->creates($data);



        return redirect()->route('userIndex')->withSuccess('Успешно!');
    }

    public function index()
    {
        $modelUser = new User();
        $modelHouse = new House();

        $users = $modelUser->getUsers();
        $house = $modelHouse->getHouse();

        return view('admin.users.main', ['users' => $users, 'houses' => $house]);
    }

    public function edit($id)
    {

        $modelUser = new User();

        $user = $modelUser->getUserIds($id);

        return view('admin.users.edit', ['user' => $user]);
    }

    public function updates(Request $request, int $id)
    {

        $request->validate([
            'email'            => 'required|email|unique:users,email, '. $id,     // required and must be unique in the ducks table
            'password2'         => 'same:password'

        ], [
            'email.required' => 'Необходимо заполнить «Email (логин)».!',
            'email.unique' => 'Email (логин) должен бить уникальним.!',
            'email.email' => 'Email (логин) должен иметь @.!',
            'password2.same' => 'Пароль не совпадает',
        ]
    );


        $modelUser = new User();
        $imageSave = new ImageSaver();



        $data = $request->all();



        if ($request->file('image') !== null) {
            $file = $request->file('image');

            if ($data['imageId'] !== null) {
                $imageSave->remove($data['imageId']);
            }
            $data['pathImage'] = $imageSave->upl($file, 'user');

        }


        $user = $modelUser->updates($data, $id);



        return redirect()->route('userIndex')->withSuccess('Успешно!');
    }


    public function show(int $id)
    {
        $modelUser = new User();

        $user = $modelUser->getUserIds($id);


        return view('admin.users.show', ['user' => $user]);
    }



    public function remove($id)
    {
        $modelUser = new User();
        $imageSaved = new ImageSaver();

        $user = $modelUser->getUserIds($id);

        foreach ($user as $key => $item) {
            $imageSaved->remove($user['image']);

        }
        $user->delete();

        return redirect()->route('userIndex')->withSuccess('Успешно!');
    }


}
