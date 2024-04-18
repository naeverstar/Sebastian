<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relation
    public function court_type() {
        return $this->belongsTo(CourtType::class);
    }

    public function transaction() {
        return $this->hasMany(Transaction::class);
    }
}
