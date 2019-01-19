<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    use ApiResponseTrait;


    function __construct()
    {
//        return $this->middleware('auth:api');
    }


    public function index(){

        $posts = PostResource::collection(Post::paginate(10));
//        $posts = PostResource::collection(Post::limit(10)->offset(0)->get());
        return $this->apiResponse($posts);
    }


    public function show($id){
        $post = Post::find($id);
        if($post){
            return $this->apiResponse(new PostResource($post));
        }
        return $this->notFound();
    }

    public function delete($id){
        $post = Post::find($id);
        if($post){
            $post->delete();
            return $this->deletedResponse();
        }
        return $this->notFound();
    }


    public function store(Request $request){

        $validation = $this->validation($request);
        if($validation instanceof Response){
            return$validation;
        }

        $post = Post::create($request->all());
        if($post){
            return $this->createdResponse(new PostResource($post));
        }
        return $this->unKnownError();
    }

    public function update(Request $request,$id){

        $validation = $this->validation($request);
        if($validation instanceof Response){
            return $validation;
        }
        $post = Post::find($id);
        if(!$post){
            return $this->notFound();
        }
        $post->update($request->all());
        if($post){
            return $this->apiResponse(new PostResource($post) ,null,201);
        }
        return $this->unKnownError();
    }


    public function validation($request){
        return $this->apiValidation($request,[
            'title' => 'required',
            'body' => 'required'
        ]);
    }


}
