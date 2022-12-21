<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'author',
        'title',
        'abstract_indonesian',
        'abstract_english',
        'status'
    ];

    public function authorRelation()
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }
}
