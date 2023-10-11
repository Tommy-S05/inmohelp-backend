<?php

namespace App\Services\MediaLibrary;

use App\Models\Property;
use App\Models\User;
use \Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator as BasePathGenerator;

class CustomPathGenerator implements BasePathGenerator
{
    /**
     * Get the path for the given media, relative to the root storage path.
     *
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media $media
     *
     * @return string
     */
    public function getPath(Media $media): string
    {
        $base_path = match ($media->model_type) {
            Property::class => 'properties/',
            User::class => 'users/',
            default => ''
        };

        $collection_name = $media->collection_name ? $media->collection_name . '/' : '';
        return $base_path . $collection_name . $media->id . '/';
//        return md5($media->id . config('app.key')) . '/';
    }

    /**
     * Get the path for conversions of the given media, relative to the root storage path.
     *
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media $media
     *
     * @return string
     */
    public function getPathForConversions(Media $media): string
    {
        $base_path = match ($media->model_type) {
            Property::class => 'properties/',
            User::class => 'users/',
            default => ''
        };

        $collection_name = $media->collection_name ? $media->collection_name . '/' : '';
        return $base_path . $collection_name . $media->id . '/conversions/';
//        return md5($media->id . config('app.key')) . '/conversions/';
    }

    /**
     * Get the path for responsive images of the given media, relative to the root storage path.
     *
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media $media
     *
     * @return string
     */
    public function getPathForResponsiveImages(Media $media): string
    {
        $base_path = match ($media->model_type) {
            Property::class => 'properties/',
            User::class => 'users/',
            default => ''
        };

        $collection_name = $media->collection_name ? $media->collection_name . '/' : '';
        return $base_path . $collection_name . $media->id . '/responsive-images/';
//        return md5($media->id . config('app.key')) . '/responsive-images/';
    }
}
