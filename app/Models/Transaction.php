<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'transaction_amount',
        'transaction_type',
        'points_earned',
        'created_at',
        'updated_at',
    ];

    protected $keyType = 'uuid';
    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
