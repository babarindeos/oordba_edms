<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'college_id',
        'department_id',
        'staff_no',
        'title',
        'surname',
        'firstname',
        'middlename'
    ];


    public function college(){
        return $this->belongsTo(College::class, 'college_id', 'id');
    }

    public function department(){
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
}
