<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';
    public function list(){
        return $this->belongsTo(AList::class);
    }
}
