<?php

namespace Chack1172\Intervention\Image;

use Intervention\Image\ImageServiceProvider as InterventionImageServiceProvider;
use Intervention\Image\ImageServiceProviderLaravelRecent;

class ImageServiceProvider extends InterventionImageServiceProvider
{
    public function __construct($app)
    {
        parent::__construct($app);

        if ($this->provider instanceof ImageServiceProviderLaravelRecent) {
            $this->provider = new ImageServiceProviderLaravel($this->app);
        }
    }
}
