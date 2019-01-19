<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {

        $validatedData = $request->validate([
           'email' => 'required',
           'name' => 'required',
           'password' => 'required'
        ]);

        $user = User::firstOrNew(['email'=>$request->email]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $success['token'] =  $user->createToken('Api')->accessToken;
        $success['status'] =  true;
        $success['user'] =  $user;

        return ['status' => true,
            'messages'=>$success,
        ];
    }

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('email',$request->email)->first();
        if(!$user){
            return response(['status' => 'Error','Message' => 'User Not Found']);
        }
        if(Hash::check($request->password,$user->password)){
            $success['token'] =  $user->createToken('Api')->accessToken;
            $success['user'] =  $user;
            return ['status' => true,
                'messages'=>$success,
            ];
        }

    }
    public function logout(){

    }
}
