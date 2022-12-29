<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'kaprodi_id'
    ];

    public function kaprodi()
    {
        return $this->belongsTo(User::class, 'kaprodi_id', 'id');
    }
}
