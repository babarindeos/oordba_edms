<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'title',
        'admin_category_id',
        'document',
        'comment',
        'uploader',
        'filesize',
        'filetype',           
     ];
}
