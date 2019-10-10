<?php
namespace App\Service;

use App\InterfaceService\PermissionInterface;
use Spatie\Permission\Models\Permission;
use DB;

class PermissionService implements PermissionInterface
{
    public function getAllPermission()
    {
        $permissions = Permission::all();

        return $permissions;
    }

    public function createPermission($request)
    {
        # code...
    }

    public function rolePermissions($roleId)
    {
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$roleId)
            ->get();

        return $rolePermissions;
    }

    public function getAllRolePermissions($roleId)
    {
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$roleId)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return $rolePermissions;
    }

}
