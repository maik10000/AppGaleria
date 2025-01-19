<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswReques;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request)
    {
        $user = User::find(Auth::user()->id);

        $user->update([
            'name' => $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'age' => $request->age
        ]);

        return response()->json(["data"=>$user],200);
    }


    public function resetPassw(PasswReques $request){

        if(!Hash::check($request->oldpassword,Auth::User()->password)){

            return response()->json(['erro'=> 'Contraseña incorrecta'],400);
        }

        $user = User::find(Auth::user()->id);
         $user ->forceFill([
            'password' => Hash::make($request->password)
        ]);
        
        $user->save();
        return response()->json(['Succes'=> 'Contraseña se cambio'],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        $user = User::find(Auth::user()->id);

       $user->update([
        'state'=>false
       ]);
       
       return response()->json(["succes"=>"Su cuenta elimino correctamente"],200);

    }
}
