<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date_time',
        'location',
        'capacity',
        'organiser_id',
        'image_path',
    ];

    // relation: each event belongs to an organiser
    public function organiser()
    {
        return $this->belongsTo(User::class, 'organiser_id');
    }
}
