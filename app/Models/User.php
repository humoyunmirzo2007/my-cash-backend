<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $guarded = [];

    public function  cashBoxes(): HasMany
    {
        return $this->hasMany(CashBox::class);
    }

    public function  inputTypes(): HasMany
    {
        return $this->hasMany(InputType::class);
    }

    public function  outputTypes(): HasMany
    {
        return $this->hasMany(OutputType::class);
    }

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
