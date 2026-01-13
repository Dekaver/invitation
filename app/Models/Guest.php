<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Guest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'wedding_id',
        'name',
        'rsvp_status',
        'message',
    ];

    /**
     * Get the route key for implicit model binding.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    /**
     * Get the wedding this guest belongs to.
     *
     * @return BelongsTo
     */
    public function wedding(): BelongsTo
    {
        return $this->belongsTo(Wedding::class);
    }

    /**
     * Check if guest has responded to RSVP.
     *
     * @return bool
     */
    public function hasResponded(): bool
    {
        return in_array($this->rsvp_status, ['Hadir', 'Tidak Hadir']);
    }

    /**
     * Check if guest is attending.
     *
     * @return bool
     */
    public function isAttending(): bool
    {
        return $this->rsvp_status === 'yes';
    }
}
