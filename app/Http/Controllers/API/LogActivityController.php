<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\System\Module;
use App\Models\System\LogActivity;
use App\Http\Controllers\Controller;
use App\Http\Resources\ModuleResource;

class LogActivityController extends Controller
{
    public function index(){
        $logActivity = LogActivity::with('user')->orderBy('id','DESC')->paginate(20);
        return response()->json($logActivity);
    }
}