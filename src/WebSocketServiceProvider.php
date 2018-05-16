<?php

namespace Laratrade\GDAX\WebSocket;

use Illuminate\Support\ServiceProvider;
use Laratrade\GDAX\WebSocket\Console\ProcessCommand;
use Laratrade\GDAX\WebSocket\Contracts\Subscriber as SubscriberContract;
use Ratchet\Client\Connector as RatchetConnector;
use React\EventLoop\Factory;
use React\EventLoop\LoopInterface as LoopContract;
use React\Socket\Connector as ReactConnector;

class WebSocketServiceProvider extends ServiceProvider
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
            __DIR__ . '/../config/gdax-websocket.php',
            'gdax-websocket'
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
                __DIR__ . '/../config/gdax-websocket.php' => config_path('gdax-websocket.php'),
            ], 'gdax-websocket');
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
        $this->app->bind(LoopContract::class, function () {
            return Factory::create();
        });

        $this->app->singleton(RatchetConnector::class, function ($app) {
            /** @var LoopContract $loop */
            $loop = $app->make(LoopContract::class);

            $connector = new RatchetConnector($loop, new ReactConnector($loop, [
                'dns'     => config('gdax-websocket.dns'),
                'timeout' => config('gdax-websocket.timeout'),
            ]));

            register_shutdown_function(function () use ($loop) {
                $loop->run();
            });

            return $connector;
        });

        $this->app->bind(SubscriberContract::class, Subscriber::class);

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
                ProcessCommand::class,
            ]);
        }

        return $this;
    }
}
