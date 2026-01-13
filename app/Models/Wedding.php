<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wedding extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'slug',
        'groom_name',
        'groom_father',
        'groom_mother',
        'bride_name',
        'bride_father',
        'bride_mother',
        'akad_date',
        'akad_start',
        'akad_end',
        'akad_location',
        'reception_date',
        'reception_start',
        'reception_end',
        'reception_location',
        'map_url',
        'map_embed_url',
        'theme',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'akad_date' => 'date',
        'reception_date' => 'date',
    ];

    /**
     * Get the route key for implicit model binding.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get all guests for this wedding.
     *
     * @return HasMany
     */
    public function guests(): HasMany
    {
        return $this->hasMany(Guest::class);
    }

    /**
     * Get gift information for this wedding.
     *
     * @return HasMany
     */
    public function gifts(): HasMany
    {
        return $this->hasMany(Gift::class);
    }

    /**
     * Get total guests who will attend (yes responses).
     *
     * @return int
     */
    public function totalAttendees(): int
    {
        return $this->guests()
            ->where('rsvp_status', 'yes')
            ->sum('total_guest');
    }

    /**
     * Get count of guests by RSVP status.
     *
     * @return array
     */
    public function rsvpSummary(): array
    {
        return [
            'yes' => $this->guests()->where('rsvp_status', 'yes')->count(),
            'no' => $this->guests()->where('rsvp_status', 'no')->count(),
            'maybe' => $this->guests()->where('rsvp_status', 'maybe')->count(),
        ];
    }
}
