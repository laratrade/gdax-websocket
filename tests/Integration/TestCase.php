<?php

namespace Laratrade\GDAX\WebSocket\Tests\Integration;

use Laratrade\GDAX\WebSocket\WebSocketServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * @inheritdoc
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('gdax-websocket.dns', '1.1.1.1');
        $app['config']->set('gdax-websocket.timeout', 5);
        $app['config']->set('gdax-websocket.events', []);
    }

    /**
     * @inheritdoc
     */
    protected function getPackageProviders($app)
    {
        return [
            WebSocketServiceProvider::class,
        ];
    }
}
