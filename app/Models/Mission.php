<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    protected $table = 'mission';

    public $timestamps = true;

    use HasFactory;

    protected $fillable = [
        'type',
        'purpose',
        'allowance_percentage'
    ];

    public function users(){
        return $this->belongsToMany(User::class, 'mission_users', 'mission_id', 'user_id')->withPivot('start_date','end_date','allowance','allowance_percent');
    }    

    public function departments(){
        return $this->belongsToMany(Department::class, 'mission_department', 'mission_id', 'department_id');
    }    

}
