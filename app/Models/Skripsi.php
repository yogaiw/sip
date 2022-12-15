<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skripsi extends Model
{
    use HasFactory;

    protected $fillable = [
        'author',
        'title'
    ];

    public function author() {
        return $this->belongsTo(User::class, 'author');
    }
}
