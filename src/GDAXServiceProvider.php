<?php

namespace Laratrade\GDAX;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Support\ServiceProvider;
use Laratrade\GDAX\Commands\WebSocket\Process;
use Laratrade\GDAX\Contracts\WebSocket\Subscriber as SubscriberContract;
use Laratrade\GDAX\WebSocket\Subscriber;
use Psr\Log\LoggerInterface as LoggerContract;
use Ratchet\Client\Connector as RatchetConnector;
use React\EventLoop\Factory;
use React\EventLoop\LoopInterface as LoopContract;
use React\Socket\Connector as ReactConnector;

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
        // React loop
        $this->app->bind(LoopContract::class, function () {
            return Factory::create();
        });

        // Ratchet connector
        $this->app->singleton(RatchetConnector::class, function ($app) {
            /** @var LoopContract $loop */
            $loop = $app->make(LoopContract::class);

            $connector = new RatchetConnector($loop, new ReactConnector($loop, [
                'dns'     => config('websocket.dns'),
                'timeout' => config('websocket.timeout'),
            ]));

            register_shutdown_function(function () use ($loop) {
                $loop->run();
            });

            return $connector;
        });

        // Websocket subscriber
        $this->app->bind(SubscriberContract::class, function ($app) {
            return new Subscriber(
                $app->make(LoggerContract::class),
                $app->make(DispatcherContract::class),
                config('websocket.events')
            );
        });

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
                Process::class,
            ]);
        }

        return $this;
    }
}
