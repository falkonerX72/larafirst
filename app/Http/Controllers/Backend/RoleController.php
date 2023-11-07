<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use App\Exports\PermissionExport;
use App\Models\User as ModelsUser;
use Illuminate\Foundation\Auth\User as AuthUser;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    //

    public function AllPermission()
    {
        $permissions = Permission::get();

        return view('backend.pages.permission.all_permission', compact('permissions'));
    } //end method
    public function AddPermission()
    {
        return view('backend.pages.permission.add_permission');
    }

    public function StorePermission(Request $request)
    {

        $permission = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
            'guard_name' => 'web'
        ]);

        $notification = array(
            'message' => 'Permission Create Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('add.permission')->with($notification);
    } // End Method 
    public function EditPermission($id)
    {

        $permission = Permission::findOrFail($id);
        return view('backend.pages.permission.edit_permission', compact('permission'));
    } // End Method 


    public function UpdatePermission(Request $request)
    {

        $per_id = $request->id;

        Permission::findOrFail($per_id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.permission')->with($notification);
    } // End Method 


    public function DeletePermission($id)
    {

        Permission::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Permission Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method 
    public function ImportPermission()
    {
        return view('backend.pages.permission.import_permission');
    }

    public function export()
    {
        return Excel::download(new PermissionExport, 'permissions.xlsx');
    }


    ///// roles all methods


    public function AllRoles()
    {
        $roles = Role::get();
        return view('backend.pages.roles.all_roles', compact('roles'));
    }
    public function AddRoles()
    {
        return view('backend.pages.roles.add_roles');
    }

    public function StoreRoles(Request $request)
    {

        $roles = Role::create([
            'name' => $request->name,
             'guard_name' => "web"
        ]);
        $notification = array(
            'message' => 'Roles Create Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles')->with($notification);
    }
    public function DeleteRoles($id)
    {

        Role::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Roles Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles')->with($notification);
    }
    public function EditRoles($id)
    {
        $Eroles = Role::findOrFail($id);
        return view('backend.pages.roles.edit_roles', compact('Eroles'));
    }
    public function UpdateRoles(Request $request)
    {
        $role_id = $request->id;
        $roles = Role::findOrFail($role_id)->update([
            'name' => $request->name,
        ]);
        $notification = array(
            'message' => 'Roles Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles')->with($notification);
    }
    //add role permissions
    public function AddRolesPermission()
    {

        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('backend.pages.rolesetup.add_roles_permission', compact('roles', 'permissions', 'permission_groups'));
    } // End Method 



    public function StoreRolesPermission(Request $request)
    {

        $data = array();
        $permissions = $request->permission;

        foreach ($permissions as $key => $item) {
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;

            DB::table('role_has_permissions')->insert($data);
        } // end foreach 

        $notification = array(
            'message' => 'Role Permission Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles.permission')->with($notification);
    }



    public function AllRolesPermission()
    {

        $roles = Role::all();
        return view('backend.pages.rolesetup.all_roles_permission', compact('roles'));
    }




    public function AdminEditRoles($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('backend.pages.rolesetup.edit_roles_permission', compact('role', 'permissions', 'permission_groups'));
    } // End Method 


    public function AdminRolesUpdate(Request $request, $id)
    {

        $role = Role::findOrFail($id);
        $permissions = $request->permission;

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }

        $notification = array(
            'message' => 'Role Permission Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles.permission')->with($notification);
    } // End Method 



    public function AdminDeleteRoles($id)
    {

        $role = Role::findOrFail($id);
        if (!is_null($role)) {
            $role->delete();
        }

        $notification = array(
            'message' => 'Role Permission Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
