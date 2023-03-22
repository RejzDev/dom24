<?php


namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\UserAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserAdminController extends Controller
{
    protected $guard = 'admin';
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        if (Auth::guard('admin')->check()){
            return redirect()->route('adminMainPage');
        }



        return view('website.admin.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);



        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('adminMainPage');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


    public function index(){

        $model = new UserAdmin();
        $users = $model->all();

        return view('admin.user-admin.main', ['users' => $users]);
    }

    public function createPage(){

        return view('admin.user-admin.create');
    }


    public function save(Request $request)
    {

        $request->validate([
            'UserAdmin.firstname' => 'required',
            'UserAdmin.lastname' => 'required',
            'UserAdmin.phone' => 'required',
            'UserAdmin.role' => 'required',
            'UserAdmin.status' => 'required',
            'email'     => 'required|email|unique:user_admins',
            'UserAdmin.password'  => 'required',
            'UserAdmin.password2'  => 'required|same:UserAdmin.password'


        ], [
            'UserAdmin.firstname.required' => 'Необходимо заполнить «Имя».!',
            'UserAdmin.lastname.required' => 'Необходимо заполнить «Фамилия».!',
            'UserAdmin.phone.required' => 'Необходимо заполнить «Телефон».!',
            'UserAdmin.role.required' => 'Необходимо заполнить «Роль».!',
            'UserAdmin.status.required' => 'Необходимо заполнить «Статус».!',
            'email.unique' => 'Email (логин) должен бить уникальним.!',
            'email.email' => 'Email (логин) должен иметь @.!',
            'UserAdmin.password.required' => 'Необходимо заполнить «Пароль».',
            'UserAdmin.password2.required' => 'Необходимо заполнить «Повторить пароль».',
            'UserAdmin.password2.same' => 'Пароль не совпадает',
        ]);

        $data = $request->all();

        $modelUser = new UserAdmin();
        $modelUser->creates($data);



        return redirect()->back()->withSuccess('Успешно!');

    }

    public function edit(int $id){

        $model = new UserAdmin();
        $user = $model->find($id);

        return view('admin.user-admin.edit', ['user' => $user]);
    }


    public function update(Request $request, int $id)
    {

        $request->validate([
            'UserAdmin.firstname' => 'required',
            'UserAdmin.lastname' => 'required',
            'UserAdmin.phone' => 'required',
            'UserAdmin.role' => 'required',
            'UserAdmin.status' => 'required',
            'email'     => 'required|email|unique:user_admins,email, '. $id,



        ], [
            'UserAdmin.firstname.required' => 'Необходимо заполнить «Имя».!',
            'UserAdmin.lastname.required' => 'Необходимо заполнить «Фамилия».!',
            'UserAdmin.phone.required' => 'Необходимо заполнить «Телефон».!',
            'UserAdmin.role.required' => 'Необходимо заполнить «Роль».!',
            'UserAdmin.status.required' => 'Необходимо заполнить «Статус».!',
            'email.unique' => 'Email (логин) должен бить уникальним.!',
            'email.email' => 'Email (логин) должен иметь @.!',

        ]);

        $data = $request->all();

        $modelUser = new UserAdmin();
        $modelUser->updates($data, $id);



        return redirect()->back()->withSuccess('Успешно!');

    }

    public function delete(int $id){

        $model = new UserAdmin();
        $user = $model->find($id);

        $user->delete();

        return redirect()->back()->withSuccess('Успешно!');    }


}
