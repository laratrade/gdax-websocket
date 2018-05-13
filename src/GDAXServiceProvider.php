<?php

namespace Laratrade\GDAX;

use Illuminate\Support\ServiceProvider;

class GDAXServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->configure()
             ->offerPublishing()
             ->registerServices()
             ->registerCommands();
    }

    /**
     * Setup the configuration.
     *
     * @return $this
     */
    protected function configure(): self
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/gdax.php',
            'gdax'
        );

        return $this;
    }

    /**
     * Setup the resource publishing groups.
     *
     * @return $this
     */
    protected function offerPublishing(): self
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/gdax.php' => config_path('gdax.php'),
            ], 'gdax');
        }

        return $this;
    }

    /**
     * Register the services.
     *
     * @return $this
     */
    protected function registerServices(): self
    {
        //

        return $this;
    }

    /**
     * Register the commands.
     *
     * @return $this
     */
    protected function registerCommands(): self
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                //
            ]);
        }

        return $this;
    }
}
