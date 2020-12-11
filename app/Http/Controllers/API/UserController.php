<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\System\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;

class UserController extends Controller
{
    public function __construct(){
        if(config('app.debug_api')){
            $this->middleware('auth:api');
        }
    }

    public function index(Request $request){
        $per_page = $request->get("per_page") ?? 20;
        $data = User::with('roles')->orderBy('id','DESC')->paginate($per_page);
        return UserResource::collection($data);
    }

    public function all(){
        $data = User::with('roles')->orderBy('id','DESC')->all();
        return UserResource::collection($data);
    }

    public function store(UserStoreRequest $request){

        $input = $request->all();
        $input['name'] = $request->input('username');
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        return response()->json($user);
    }

    public function show($id){
        $data = User::with('roles')->find($id);
        return response()->json($data);
    }

    public function update(UserUpdateRequest $request,$id){
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = $request->except(['password']);
        }
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));
        return response()->json($user);
    }

    public function destroy($id){
        User::find($id)->delete();
        return response()->json("ok");
    }
}