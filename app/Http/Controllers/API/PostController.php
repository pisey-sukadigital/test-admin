<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function __construct()
    {
        if(config('app.debug_api')){
            $this->middleware('auth:api');
        }
    }

    public function index()
    {
        $data = Post::latest()->paginate(10);
        return PostResource::collection($data);
    }

    public function store(Request $request)
    {
        $post = Post::create($request->all());
        return response()->json($post);
    }

    public function show($id)
    {
        return new PostResource(Post::find($id));
    }

    public function update(Request $request, $id)
    {
        $edit = Post::find($id)->update($request->all());
        return response()->json($edit);
    }

    public function destroy($id)
    {
        Post::destroy($id);
        return response()->json("ok");
    }
}