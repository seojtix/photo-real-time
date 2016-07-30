<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Photo extends Eloquent {

    protected $table = 'photos';
    protected $fillable = [
        'object_id',
        'name',
        'type',
        'text'
    ];

}
