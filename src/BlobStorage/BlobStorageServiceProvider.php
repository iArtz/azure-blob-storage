<?php

namespace iArtz\BlobStorage;

use Illuminate\Support\ServiceProvider;

class BlobStorageServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('blobStorage', Blob::class);
    }
}
