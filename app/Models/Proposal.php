<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'title',
        'abstract_indonesian',
        'abstract_english',
        'status'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function revisions()
    {
        return $this->hasMany(Revision::class, 'proposal_id', 'id');
    }
}
