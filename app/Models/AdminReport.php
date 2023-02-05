<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminReport extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "admin_reports";
    protected $guarded = false;

    /**
     * Get the organization's dashboard
     */
    public function organization(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }
}
