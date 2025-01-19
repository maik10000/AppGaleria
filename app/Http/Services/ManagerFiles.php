<?php
namespace App\Http\Services;

use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ManagerFiles{
    
    private $ruta = "images/" ;
    private $disk = 'local';
    public function Guardar($imagen, $nombre){

      $pathfolder = $this->ruta.$nombre.'_folder';
      $uuid = Str::uuid()->toString(); 
      $extension = $imagen->getClientOriginalExtension();
      $uuid_name  = $uuid;
      $nombreArchivo = $uuid_name.'.'.$extension;

      try{

       $path =  Storage::disk($this->disk)->putFileAs($pathfolder,$imagen,$nombreArchivo);
       $url = Storage::url($path);
        return ['link' => $url, 'path' => $path, 'name' => $uuid_name];
        
      }catch(Exception $e){

          throw new HttpResponseException( response()->json(['message' => 'A ocurrido un error al guardar el archivo intente mas tarde'],400));
         
      }

    }

    public function ExtractName($filename){
        return explode('.',$filename)[0];
    }

    public function RenameDirectory($path){

    }

    public function Exist($path){

       return Storage::disk($this->disk)->exists($path);
    }

    public function Actualizar($imagen,$nombre,$uuid_name,$oldPath){

      try{

          $pathfolder = $this->ruta.$nombre.'_folder';
          $extension = $imagen->getClientOriginalExtension();
          $nombreArchivo = $uuid_name.'.'.$extension;
       
          if (Storage::disk($this->disk)->exists($oldPath)) {
            
              Storage::disk($this->disk)->delete($oldPath);
          }
          
        $new_path =  Storage::disk('local')->putFileAs($pathfolder,$imagen,$nombreArchivo);
        $url = Storage::url($new_path);
        return ['new' => $new_path, 'link' => $url];

        }catch(Exception $e){
          throw new HttpResponseException( response()->json(['message' => 'A ocurrido un error al guardar el archivo intente mas tarde'],400));
        }
    } 
}