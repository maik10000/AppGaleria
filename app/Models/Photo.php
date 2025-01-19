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

    protected $hidden = [
        'state',
        'user_id',
        'image_path'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
