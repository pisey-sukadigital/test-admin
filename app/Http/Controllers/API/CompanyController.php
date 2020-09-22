<?php

namespace App\Http\Controllers\API;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;

class CompanyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth:api');
    }
    
     public function index(Request $request){
        $page = 10;
        if($request->get('limit') != ''){
        $page = $request->get('limit');
        }

        $data = Company::latest('id')->paginate($page);
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'secret' => ['required', 'string', 'max:255'],
            'url' => ['required', 'string', 'max:255'],
            'callback' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
        ]);

        $company = Company::create([
            'name' => $request['name'],
            'secret' => $request['secret'],
            'url' => $request['url'],
            'callback' => $request['callback'],
            'status' => $request['status'],
        ]);

        return response()->json($company);
    }

    public function destroy($id)
    {
        Company::destroy($id);
        return response()->json("ok");
    }
}
