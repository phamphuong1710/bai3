<?php
namespace App\Service;

use App\InterfaceService\RoleInterface;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Str;

class RoleService implements RoleInterface
{
    public function getAllRole()
    {
        $roles = Role::orderBy('created_at','DESC')->paginate(10);

        return $roles;
    }

    public function createRole($request)
    {
        $role = new Role();
        $role->name = $request->name;
        $role->save();

        return $role;
    }

    public function getRole($id)
    {
        $role = Role::findOrFail($id);

        return $role;
    }

    public function updateRole($request, $id)
    {
        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $slug = Str::slug($request->name, '-');
        $role->guard_name = $slug;
        $role->save();

        return $role;
    }

    public function deleteRole($id)
    {
        $role = Role::findOrFail($id);
        Role::destroy($id);

        return $role;
    }

    public function getListRole()
    {
        $roles = Role::pluck('name','name')->all();

        return $roles;
    }
}

