<?php

namespace Chack1172\Intervention\Image;

use Intervention\Image\ImageServiceProviderLaravelRecent;

class ImageServiceProviderLaravel extends ImageServiceProviderLaravelRecent
{
    /**
     * Bootstrap imagecache
     *
     * @return void
     */
    protected function bootstrapImageCache()
    {
        $app = $this->app;
        $config = __DIR__ . '/../../intervention-imagecache/src/config/config.php';

        $this->publishes([
            $config => config_path('imagecache.php')
        ]);

        // merge default config
        $this->mergeConfigFrom(
            $config,
            'imagecache'
        );

        // imagecache route
        if (is_string(config('imagecache.route'))) {

            $filename_pattern = '[ \w\\.\\/\\-\\@\(\)\=]+';

            // route to access template applied image file
            $app['router']->get(config('imagecache.route') . '/{template}/{filename}', [
                'uses' => 'Intervention\Image\ImageCacheController@getResponse',
                'as' => 'imagecache'
            ])->where(['filename' => $filename_pattern]);
        }
    }
}
