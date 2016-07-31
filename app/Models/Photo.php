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
    protected $appends = ['text_trimmed'];

    public function getTextTrimmedAttribute() {
        return str_replace('<br>', ' ', $this->text);
    }

}
