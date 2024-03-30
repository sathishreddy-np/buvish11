<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory;

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }
}
