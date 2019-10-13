<?php
namespace App\Service;

use App\InterfaceService\PermissionInterface;
use Spatie\Permission\Models\Permission;
use DB;

class PermissionService implements PermissionInterface
{
    protected $permissionModel;
    protected $db;

    public function __construct(Permission $permissionModel, DB $db)
    {
        $this->permissionModel = $permissionModel;
        $this->db = $db;
    }

    public function getAllPermission()
    {
        $permissions = $this->permissionModel->all();

        return $permissions;
    }

    public function rolePermissions($roleId)
    {
        $rolePermissions = $this->permissionModel->join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$roleId)
            ->get();

        return $rolePermissions;
    }

    public function getAllRolePermissions($roleId)
    {
        $rolePermissions = $this->db->table("role_has_permissions")->where("role_has_permissions.role_id",$roleId)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return $rolePermissions;
    }

}
