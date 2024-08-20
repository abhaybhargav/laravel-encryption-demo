<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensitiveData extends Model
{
    use HasFactory;

    protected $fillable = ['encrypted_data', 'mode'];
}
