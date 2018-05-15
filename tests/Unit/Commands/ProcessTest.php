<?php

namespace Laratrade\GDAX\WebSocket\Tests\Unit\Commands;

use Illuminate\Config\Repository as RepositoryContract;
use Laratrade\GDAX\WebSocket\Commands\WebSocket\Process;
use Laratrade\GDAX\WebSocket\Contracts\WebSocket\Subscriber as SubscriberContract;
use Laratrade\GDAX\WebSocket\Tests\Unit\TestCase;
use Mockery as m;
use Ratchet\Client\Connector;
use React\Promise\PromiseInterface as PromiseContract;

class ProcessTest extends TestCase
{
    /** @test */
    public function it_executes_the_command()
    {
        $promise = m::mock(PromiseContract::class);

        $connector = m::mock(Connector::class);
        $connector->shouldReceive('__invoke')->once()->andReturn($promise);

        $config = m::mock(RepositoryContract::class);
        $config->shouldReceive('get')->once()->with('websocket.url')->andReturn('');

        $subscriber = m::mock(SubscriberContract::class);
        $subscriber->shouldReceive('subscribe')->with($promise);

        (new Process($connector, $config, $subscriber))->handle();
    }
}
