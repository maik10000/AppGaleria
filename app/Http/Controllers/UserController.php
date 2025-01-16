<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request)
    {
        $user = User::find($request->id_user);
        $user->update([
            'name' => $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'age' => $request->age
        ]);

        return response()->json(["succes"=>"Se actualizo correctamente"],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
       $user = User::find($request->id_user);

       $user->update([
        'state'=>false
       ]);
       
       return response()->json(["succes"=>"Su cuenta elimino correctamente"],200);

    }
}
