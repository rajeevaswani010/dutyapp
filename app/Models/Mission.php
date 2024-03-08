<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    protected $table = 'mission';

    public $timestamps = false;

    use HasFactory;
    
}
