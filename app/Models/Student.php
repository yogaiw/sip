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

    public function pembimbing1()
    {
        return $this->belongsTo(User::class, 'pembimbing1_id', 'id');
    }

    public function pembimbing2()
    {
        return $this->belongsTo(User::class, 'pembimbing2_id', 'id');
    }

    public function penguji() {
        return $this->belongsTo(User::class, 'penguji_id', 'id');
    }
}
