<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipTier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'points_required',
        'discount_rate',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
