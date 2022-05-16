<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'url' ];

    /**
     * Bootstrap the model and its traits.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        self::deleted(function (Image $item) {
            $item->deleteImage();

            return true;
        });
    }

    /**
     * Return thumbnail url
     *
     * @return string
     */
    public function getThumbnailUrlAttribute()
    {
       return asset('storage/' . $this->imageable_type_class::IMAGE_FOLDER . 'thumbnail/' . $this->url);
    }

    /**
     * Return thumbnail url
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->imageable_type_class::IMAGE_FOLDER . $this->url);
    }

    /**
     * Convert morph alias to real class
     *
     * @return string|null
     */
    public function getImageableTypeClassAttribute()
    {
        if (is_subclass_of($this->imageable_type, Model::class)) {
            return $this->imageable_type;
        }

        return Relation::getMorphedModel($this->imageable_type);
    }

    /**
     * Relation morphTo
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function imageable()
    {
        return $this->morphTo();
    }

    /**
     * Delete image on storage
     *
     * @return void
     */
    public function deleteImage()
    {
        Storage::delete("public/" . $this->imageable_type_class::IMAGE_FOLDER . 'thumbnail/' . $this->url);

        return Storage::delete("public/" . $this->imageable_type_class::IMAGE_FOLDER . $this->url);
    }
}
