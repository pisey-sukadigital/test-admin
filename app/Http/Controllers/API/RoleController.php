<?php

namespace App\Http\Controllers\API;

use DB;
use App\Models\User;
use App\Models\System\LogActivity;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Role\RoleStoreRequest;
use App\Http\Requests\Role\RoleUpdateRequest;
class RoleController extends Controller
{
    public function __construct(){
        if(config('app.debug_api')){
            $this->middleware('auth:api');
        }
    }

    public function index(Request $request){
        $data = Role::latest()->paginate(10);
        return RoleResource::collection($data);
    }

    public function all(){
        $data = Role::all();
        return RoleResource::collection($data);
    }

    public function allPermission(){
         $permission = Permission::get();
        return response()->json($permission);
    }
    
    public function store(RoleStoreRequest $request){

        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permissions' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permissions'));
        if($role){
            LogActivity::addToLog('roles', 'Created', '', response()->json($role));
        }
        return response()->json($role);

    }

    public function edit($id){
        $role = Role::find($id);
        $rolePermissions =
        Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
        ->where("role_has_permissions.role_id",$id)
        ->pluck('name');
        $role = Role::find($id);
        return response()->json([$role,$rolePermissions]);
    }
    
    public function update(RoleUpdateRequest $request, $id){
        $role = Role::find($id);
        $before_update = response()->json($role);
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permissions'));
        $after_update = response()->json($role);
        if($role){
            LogActivity::addToLog('roles', 'Updated', $before_update, $after_update);
        }

        return response()->json($role);
    }
    
    public function destroy($id){
        DB::table("roles")->where('id',$id)->delete();
       return response()->json("ok");
    }
}