<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterValidation;
use App\Models\User;
class RegisterController extends Controller
{
    public function __invoke(RegisterValidation $request)
    {

        User::create($request->validated());
        return
            [

                "message"=>"Account created successfully",
            ];
    }

}
