<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    protected $fillable = [
        'title',
        'description',
        'image_path',
        'image_link',
        'uuid_name',
        'user_id',
        'state'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
