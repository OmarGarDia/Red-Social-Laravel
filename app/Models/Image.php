<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';

    //Relación One To Many

    public function comments()
    {
        return $this->hasMany('App\Models\Comment')->orderBy('id', 'desc');
    }

    // Relacion One To Many

    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }

    // Relacion de Many to One

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
