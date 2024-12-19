<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    

    protected $table = 'task';

    protected $fillable = [
        'judul',
        'deskripsi',
        'attachment',
        'due_date',
        'divisi_id',
        'status',
    ];
}
