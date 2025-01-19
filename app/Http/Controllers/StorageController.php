<?php

namespace App\Http\Controllers;

use App\Http\Services\ManagerFiles;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StorageController extends Controller
{
    
    private $serv_file;
    private $path_base ="images/";
    public function __construct(ManagerFiles $serv_file)
    {
        $this->serv_file = $serv_file;
    }

    public function showAuth($folder,$filename){
         
        
        $path = $this->path_base.$folder.'/'.$filename;

        if (!$this->serv_file->Exist($path)){

            return response()->json(['error' => 'File not found'], Response::HTTP_NOT_FOUND);
        }
        
        $user = User::find(Auth::user()->id);
        $uuid = $this->serv_file->ExtractName($filename);

        if($user->getPhoto($uuid)===null){

            return response()->json(['error' => 'File not found'], Response::HTTP_NOT_FOUND);
        }

        $fileContent = Storage::get($path);
        $mimeType = Storage::mimeType($path);
        
        return response($fileContent, Response::HTTP_OK)->header('Content-Type', $mimeType);
        

    }


    public function showAuthTk($path,$filename,$tk){

        
        dd('Puedes ver la imagen',$path,$filename);

    }
}
