<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    function role(){
        $permissions = Permission::all();
        $roles = Role::all();
        $users = User::all();
        return view('admin.role.role',[
            'permissions'=>$permissions,
            'roles'=>$roles,
            'users'=>$users,
        ]);
    }
    function permission_store(Request $request){
        Permission::create([
            'name' => $request->permission_name,
        ]);
        return back();

    }
    function permission_edit($id){
        $permission_edit = Permission::find($id);
        return view('admin.role.permission_edit',[
            'permission_edit'=>$permission_edit,
        ]);
    }
    function permission_update(Request $request,$id){
        
        Permission::where('id',$id)->update([
              'name'=>$request->permission_name,
        ]);
        return redirect('/role')->with('success','Permission Updated  Successfully');
    }
    function permission_delete($id){
        Permission::find($id)->delete();
        return back()->with('success','Permission Deleted Successfully');

    }
    
    function role_store(Request $request){
       
        
        $role = Role::create(['name' =>$request->role_name]);

        $role->givePermissionTo($request->permission);
        return back()->with('success','Roll Added Successfully');
    }
    function assign_role(Request $request){
        $user = User::find($request->user_id);
        $user->assignRole($request->role_id);
        return back()->with('success','Roll Added Successfully');
    }
    function role_with_permission_edit($id,$name){
        $name;
        $role =  Role::find($id);
        $dds =  $role->getAllPermissions();
        $asd = DB::table('role_has_permissions')->where('role_id',$id)->get();
        
        return view('admin.role.role_edit',[
            'asd'=>$asd,
            'dds'=>$dds,
            'name'=>$name,
        ]);
        
           
       }
       function remove_role($id){
        $user = User::find($id);
        $user->syncRoles([]);
        $user->syncPermissions([]);
        return back();

        
       }
       function edit_user_role_permission($id){
        $users = User::find($id);
        $permissions = Permission::all();
        return view('admin.role.user_role_permission_edit',[
            'users'=>$users,
            'permissions'=>$permissions,
            
        ]);
       }
       function update_permission(Request $request){
       
        $user = User::find($request->user_id);
        // $user->revokePermissionTo($request->permission);
        $user->syncPermissions($request->permission);
        return back();
       }
       
}
