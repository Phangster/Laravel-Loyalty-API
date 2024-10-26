<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointsLedger extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'points',
        'description',
    ];

    protected $keyType = 'uuid';
    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
