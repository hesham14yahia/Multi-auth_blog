<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    // Tell Laravel I'm not using timestamps
    public $timestamps = false;
    
    // Define Table Name
    protected $table = 'likes';

    // Define input fields
    protected $fillable = [
        'status', 'post_id', 'user_id'
    ];

    // Define Relationships
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function post() {
        return $this->belongsTo('App\Post');
    }
}
