<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{   
    // Define Table Name
    protected $table = 'posts';

    // Define input fields
    protected $fillable = [
        'title', 'body', 'views_count', 'admin_id'
    ];

    // Define Relationship
    public function admin(){
        return $this->belongsTo('App\Admin');
    }
}
