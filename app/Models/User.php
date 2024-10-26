<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'points_balance',
        'phone_number',
        'membership_tier_id',
        'role'
    ];
    protected $keyType = 'uuid';
    public $incrementing = false;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function membershipTier()
    {
        return $this->belongsTo(MembershipTier::class);
    }

    public function rewards()
    {
        return $this->hasMany(Reward::class);
    }

    public function pointsLedger()
    {
        return $this->hasMany(PointsLedger::class);
    }

    public function totalPoints()
    {
        return $this->pointsLedger()->sum('points');
    }

    public function redemptions()
    {
        return $this->hasMany(Redemption::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
