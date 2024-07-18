<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
       'uuid',
       'title',
       'document',
       'comment',
       'uploader',
       'filesize',
       'filetype',           
    ];

    public function staff()
    {
        return $this->belongsTo(User::class, 'uploader', 'id');
    }
}
