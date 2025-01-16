<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class AuthController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function login(){

    }

    public function register(UserRegisterRequest $request){

        User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password' => Hash::make($request->password),
            'phone'=> $request->phone,
            'age' => $request->age

        ]);
        
        return response()->json(['message' => 'Datos se guardaro correctamente']);
    }

    public function logout(){
        
    }
}
