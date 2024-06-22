<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends BaseModel
{
    use HasFactory;
    protected $fillable = [
        'title',
        'price',
        'weight',
        'specification',
        'unit',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
