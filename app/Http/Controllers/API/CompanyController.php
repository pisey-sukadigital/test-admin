<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        // $this->middleware('auth:api');
    }
    
    public function index(){
        return CompanyResource::collection(Company::all());
    }

    public function all(){
        return CompanyResource::collection(Company::all());
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

    public function destroy($id){
        Company::destroy($id);
        return response()->json("ok");
    }
}
