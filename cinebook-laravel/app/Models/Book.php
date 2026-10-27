<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model // Wait, make sure it extends Model properly: class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'image',
        'detailLabel',
        'detailVal',
        'price',
    ];
}