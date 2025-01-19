<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller{


    /**
     * Display a listing of the resource.
     */
    public function login(LoginRequest $request)
    {

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || $user->state !== 1) {

            return response()->json(['data' => ['mensaje' => ['El usuario y/o contraseña incorrectos']]], 400);
        }

        if (! $token = Auth::attempt($credentials)) {

            return response()->json(['data' => ['mensaje' => ['El usuario y/o contraseña incorrectos']]], 400);
        }

        return $this->respondWithToken($token, $user);
    }


    public function getProfile()
    {

        return response()->json(Auth::user());
    }


    public function register(UserRegisterRequest $request){
    

        $user = new User();
        
        $user->name = $request->name;
        $user->email =  $request->email;
        $user->password =  Hash::make($request->password);
        $user->phone = $request->phone;
        $user->age = $request->age;
        $user->state = 1;
        $user->save();
        
        Auth::login($user);
        $token = Auth::tokenById($user->id);
        return $this->respondWithToken($token, $user);
    }

    public function logout()
    {

        try {
            Auth::logout(true);
            return response()->json(['message' => 'Sesión cerrada correctamente.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'No se pudo cerrar sesión.'], 500);
        }
    }

    public function refresh()
    {
        try {

            return $this->respondWithToken(Auth::refresh(true), Auth::user());
        } catch (\Exception $e) {
            return response()->json(['error' => 'No se pudo refrescar el token'], 500);
        }
    }

    protected function respondWithToken($token, $user)
    {
        return response()->json([
            'name' => $user->name,
            'state' => $user->state,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' =>  Auth::factory()->getTTL() * 60
        ]);
    }

}