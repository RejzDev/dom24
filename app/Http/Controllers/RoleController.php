<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {

        $role = Role::with('permissions')->get();

        $permission = Permission::all();


        return view('admin.role.index', ['role' => $role, 'permission' => $permission]);

    }

    public function save(Request $request)
    {

        $data = $request->all();

        $roleAll = Role::all();
        $permissionAll = Permission::all();

        foreach ($roleAll as $item) {
            foreach ($permissionAll as $perm) {
                $item->revokePermissionTo($perm['name']);
            }

        }

        if (isset($data['permissions'])) {
            foreach ($data['permissions'] as $key => $permission) {
                foreach ($permission as $roleName => $check) {

                    $permis = Permission::findByName($key, 'admin');

                    $permis->assignRole($roleName);


                }


            }
        }

        return redirect()->back()->withSuccess('Успешно!');

    }
}
