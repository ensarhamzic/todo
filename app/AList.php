<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class AList extends Model
{
    protected $table = 'lists';
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function tasks(){
        return $this->hasMany(Task::class);
    }

}
