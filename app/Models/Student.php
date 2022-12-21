<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function pembimbing1Relation()
    {
        return $this->belongsTo(User::class, 'pembimbing1', 'id');
    }

    public function pembimbing2Relation()
    {
        return $this->belongsTo(User::class, 'pembimbing2', 'id');
    }

    public function pengujiRelation() {
        return $this->belongsTo(User::class, 'penguji', 'id');
    }
}
