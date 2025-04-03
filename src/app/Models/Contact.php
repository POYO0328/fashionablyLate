<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
use HasFactory;
    protected $fillable = [
    'first_name',
    'last_name', 
    'gender', 
    'email', 
    'tell', 
    'address', 
    'building', 
    'category_id', 
    'detail'
    ];

    // gender を整数として扱う
    protected $casts = [
        'gender' => 'integer',
    ];

     public function category()
    {
        return $this->belongsTo(Category::class); // Category と 1対多の関係
    }
}
