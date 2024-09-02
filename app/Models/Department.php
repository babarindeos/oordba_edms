<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'ministry_id',
        'department_name',
        'department_code'
    ];

    public function ministry(){
        return $this->belongsTo(Ministry::class);
    }

    public function staff()
    {
        return $this->hasMany(Staff::class, 'department_id', 'id');
    }

   
}
