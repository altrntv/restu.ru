<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Corporation extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "corporations";
    protected $guarded = false;

    /**
     * Get the corporation companies
     */
    public function companies(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Company::class, 'corporation_id', 'id');
    }
}
