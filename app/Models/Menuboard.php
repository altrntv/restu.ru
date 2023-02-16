<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menuboard extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "menuboards";
    protected $guarded = false;

    /**
     * Get the organization's menuboards
     */
    public function organization(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }
}
