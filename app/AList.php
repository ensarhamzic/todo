<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class AList extends Model
{
    public $table = 'lists';
    public function user(){
        return $this->belongsTo(User::class);
    }

}
