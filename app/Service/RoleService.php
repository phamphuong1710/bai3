<?php
namespace App\Service;

use App\InterfaceService\RoleInterface;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Str;

class RoleService implements RoleInterface
{
    protected $roleModel;

    public function __construct( Role $roleModel )
    {
        $this->roleModel = $roleModel;
    }

    public function getAllRole()
    {
        $roles = $this->roleModel->orderBy('created_at','DESC')->paginate(10);

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
        $role = $this->roleModel->findOrFail($id);

        return $role;
    }

    public function updateRole($request, $id)
    {
        $role = $this->roleModel->findOrFail($id);
        $role->name = $request->name;
        $role->save();

        return $role;
    }

    public function deleteRole($id)
    {
        $role = $this->roleModel->findOrFail($id);
        $this->roleModel->destroy($id);

        return $role;
    }

    public function getListRole()
    {
        $roles = $this->roleModel->pluck('name','name')->all();

        return $roles;
    }
}

