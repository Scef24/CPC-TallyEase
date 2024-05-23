<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sports extends Model
{
    use HasFactory;
    protected $fillable = [
        'gameName',
        'category',
        'type',
        'created_at',
        'updated_at'
    ];

}
