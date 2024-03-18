<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'department';

    use HasFactory;


    public function missions(){
        return $this->belongsToMany(Mission::class, 'mission_department', 'department_id', 'mission_id');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'department_users', 'department_id', 'user_id');
    }

}
