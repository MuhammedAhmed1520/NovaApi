<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;

trait ApiResponseTrait {
    /*
     * [
     *  'data' =>
     *  'status' => true ,false
     *  'error' => 'message'
     * ]
     * */

    public  function apiResponse($data , $error = null ,$code = 200){
        $array = [
            'data' => $data,
            'status' => in_array($code,$this->successCode()) ? true : false,
            'error' => $error,
            'user' => auth()->user()
        ];
        return response($array ,$code);
    }

    public function successCode(){
        return [
            200,201,202
        ];
    }

    public function createdResponse($data){
        return $this->apiResponse($data,null,201);
    }

    public function deletedResponse(){
        return $this->apiResponse(true,null,200);
    }

    public function notFound(){
        return $this->apiResponse(null ,"not found",404);
    }

    public function apiValidation($request,$array){
        $validate = Validator::make($request->all(),$array);
        if($validate->fails()){
            return $this->apiResponse(null ,$validate->errors(),422);

        }
    }

    public function unKnownError(){
        return $this->apiResponse(null ,"Unknown Error",404);
    }


}