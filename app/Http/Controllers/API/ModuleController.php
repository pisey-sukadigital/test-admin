<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\System\Module;
use App\Models\System\LogActivity;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\ModuleResource;
use App\Http\Requests\Module\ModuleStoreRequest;
use App\Http\Requests\Module\ModuleUpdateRequest;

class ModuleController extends Controller
{
    public function __construct(){
       if(config('app.debug_api')){
            $this->middleware('auth:api');
       }
    }

    public function index(){
        $data = Module::parent()->orderBy('id','ASC')->paginate(100);
        return ModuleResource::collection($data);
    }

    public function all(Request $request){
        $module = Module::parent()->get();
        return ModuleResource::collection($module);
    }

    public function store(ModuleStoreRequest $request){
        $input = $request->all();
        $module = Module::create($input);
        return response()->json($module);
    }

    public function edit($id){
        $module = Module::where('id',$id)->first();
        return response()->json($module);
    }

    public function update(ModuleUpdateRequest $request, $id){
        $input = $request->all();
        $module = Module::find($id);
        $module->update($input);
        return response()->json($module);
    }

    public function destroy($id){
        $module = Module::find($id);
        $module = $module->delete($id);
        return response()->json("ok");
    }
}