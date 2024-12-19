<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $table = 'user'; // Nama tabel di database
    protected $fillable = ['username', 'password', 'divisi'];

    public $timestamps = false; // Jika tabel tidak memiliki kolom created_at dan updated_at
}
