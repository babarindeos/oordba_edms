<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [        
        'department_id',
        'fileno',
        'title',
        'surname',
        'firstname',
        'middlename'
    ];


    public function ministry(){
        return $this->belongsTo(Ministry::class, 'ministry_id', 'id');
    }

    public function department(){
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
}
