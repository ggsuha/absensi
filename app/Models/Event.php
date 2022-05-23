<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use Sluggable;

    /**
     * @var string
     */
    const IMAGE_FOLDER = 'upload/images/events/';

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'start' => 'datetime:Y-m-d',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'start'
    ];

    /**
     * morphMany relationship with \App\Models\Image
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    /**
     * manyToMany relationship with \App\Models\Participant
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function participants()
    {
        return $this->belongsToMany(Participant::class)->withPivot('check_in');
    }

    /**
     * get status attribute
     *
     * @return string
     */
    public function getStatusAttribute()
    {
        $today = Carbon::today();

        if ($this->start->lt($today)) {
            return 'Closed';
        } elseif ($this->start->gt($today)) {
            return 'Upcoming';
        }

        return 'Opened';
    }

    /**
     * get status attribute
     *
     * @return string
     */
    public function getStatusBadgeAttribute()
    {
        $status = $this->status;

        switch ($status) {
            case 'Upcoming':
                return 'info';
                break;

            case 'Opened':
                return 'success';
                break;

            default:
                return 'danger';
                break;
        }
    }
}
