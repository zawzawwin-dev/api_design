<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginValidator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Request\Login;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __invoke(LoginValidator $request)
    {

        $user = User::where("email",$request->email)->first();

        if(!$user || !Hash::check($request->password,$user->password))
        {
            return [
                "message"=>"give creditial is invalid",
            ];
        }

        return [
            'token'=> $user->createToken("login")->plainTextToken,
        ];
    }
}
