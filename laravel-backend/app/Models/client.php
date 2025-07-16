<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    protected $fillable = ['nom', 'email', 'telephone', 'adresse'];
}
