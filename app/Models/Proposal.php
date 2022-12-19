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
        'pembimbing1',
        'pembimbing2',
        'penguji',
    ];

    public function authorRelation() {
        return $this->belongsTo(User::class, 'author');
    }

    public function pembimbing1Relation() {
        return $this->belongsTo(User::class, 'pembimbing1');
    }

    public function pembimbing2Relation() {
        return $this->belongsTo(User::class, 'pembimbing2');
    }

    public function pengujiRelation() {
        return $this->belongsTo(User::class, 'penguji');
    }
}
