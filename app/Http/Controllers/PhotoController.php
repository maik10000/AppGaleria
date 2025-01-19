<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDeleteRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\StoreUpdateRequest;
use App\Http\Services\ManagerFiles;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $serv_file;
    public function __construct(ManagerFiles $serv_file)
    {
        $this->serv_file = $serv_file;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {   
        $user = User::find(Auth::user()->id);
     
        $imagePath = $this->serv_file->Guardar( $request->file('image_path'),$user->id);

        Photo::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' =>$imagePath['path'],
            'image_link' => $imagePath['link'],
            'uuid_name' => $imagePath['name'],
            'user_id' => $user->id
        ]);

        return response()->json(["succes"=>"Se guardo la imagen correctamente"],200);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = User::find(Auth::user()->id);
        $photos = $user->photos()->where('state',1)->get();
        return response()->json(['images'=>$photos],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateRequest $request)
    {
        $user = User::find(Auth::user()->id);
        $img = $user->getPhoto($request->uuid_name);
        $new_path = $this->serv_file->Actualizar( $request->file('image_path'),$user->id,$img->uuid_name,$img->image_path);

         $img->update([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $new_path['new'],
            'image_link' => $new_path['link']
         ]);
        

         return response()->json(["succes"=>"Se actualizo con exito la imagen"],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StoreDeleteRequest $reques)
    {   
        
        $user = User::find(Auth::user()->id);
        $img = $user->getPhoto($reques->uuid_name);
        $img->update([ 'state' => false ]);

        return response()->json(["succes"=>"Se elimino correctamente"],200);
    }
}
