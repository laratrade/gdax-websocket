<?php

namespace Laratrade\GDAX\WebSocket\Tests\Integration;

use Illuminate\Support\Facades\Artisan;
use Laratrade\GDAX\WebSocket\Commands\WebSocket\Process;
use Laratrade\GDAX\WebSocket\Contracts\Subscriber as SubscriberContract;
use Ratchet\Client\Connector as RatchetConnector;
use React\EventLoop\LoopInterface as LoopContract;

class WebSocketServiceProviderTest extends TestCase
{
    /** @test */
    public function it_registers_the_services()
    {
        $this->assertTrue($this->app->bound(LoopContract::class));
        $this->assertTrue($this->app->bound(RatchetConnector::class));
        $this->assertTrue($this->app->bound(SubscriberContract::class));

        $this->assertInstanceOf(LoopContract::class, $this->app->make(LoopContract::class));
        $this->assertInstanceOf(RatchetConnector::class, $this->app->make(RatchetConnector::class));
        $this->assertInstanceOf(SubscriberContract::class, $this->app->make(SubscriberContract::class));
    }

    /** @test */
    public function it_registers_the_commands()
    {
        $this->assertInstanceOf(Process::class, Artisan::all()['gdax:websocket:process']);
    }
}
