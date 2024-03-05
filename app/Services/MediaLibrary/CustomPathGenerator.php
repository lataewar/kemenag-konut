<?php

namespace App\Services\MediaLibrary;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class CustomPathGenerator implements PathGenerator
{
  public function getPath(Media $media): string
  {
    return $media->uuid . '/';
  }

  /*
   * Get the path for conversions of the given media, relative to the root storage path.
   */
  public function getPathForConversions(Media $media): string
  {
    return $media->uuid . '/conversions/';
  }

  /*
   * Get the path for responsive images of the given media, relative to the root storage path.
   */
  public function getPathForResponsiveImages(Media $media): string
  {
    return $media->uuid . '/responsive-images/';
  }
}
