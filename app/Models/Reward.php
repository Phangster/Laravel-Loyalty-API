<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
        'points_required',
        'stock_quantity',
    ];

    protected $keyType = 'uuid';
    public $incrementing = false;

    public function redemptions()
    {
        return $this->hasMany(Redemption::class);
    }
}
