<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    /**
     * @var string
     */
    const IMAGE_FOLDER = 'upload/images/participants/';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone_code',
        'phone',
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
     * manyToMany relationship with \App\Models\Event
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    /**
     * Get phone number with prefix
     *
     * @return string
     */
    public function getPhoneWithPrefixAttribute()
    {
        return $this->phone_code . $this->phone;
    }
}
