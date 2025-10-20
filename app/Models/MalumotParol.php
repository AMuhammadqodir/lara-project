<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MalumotParol extends Model
{
    protected $table = 'malumot_parol';
    public $timestamps = false;
    protected $fillable = ['uid', 'login', 'parol'];
}
