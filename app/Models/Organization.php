<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "organizations";
    protected $guarded = false;

    /**
     * Get organization users
     */
    public function users(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class, 'organization_id', 'id');
    }

    /**
     * Get organization reports
     */
    public function reports(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Report::class, 'organization_id', 'id');
    }

    /**
     * Get organization reports
     */
    public function admin_reports(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(AdminReport::class, 'organization_id', 'id');
    }
}
