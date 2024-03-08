<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    protected $table = 'mission';

    public $timestamps = false;

    use HasFactory;

    public function users(){
        return $this->belongsToMany(User::class, 'mission_users', 'mission_id', 'user_id');
    }    
}
