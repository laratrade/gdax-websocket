<?php

namespace Laratrade\GDAX\WebSocket\Tests\Unit;

use Exception;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Laratrade\GDAX\WebSocket\WebSocket\Subscriber;
use Mockery as m;
use Psr\Log\LoggerInterface as LoggerContract;
use Ratchet\Client\WebSocket;
use Ratchet\RFC6455\Messaging\MessageInterface as MessageContract;
use React\Promise\PromiseInterface as PromiseContract;
use stdClass;

class SubscriberTest extends TestCase
{
    /** @test */
    public function it_handles_the_connect_event()
    {
        $logger = m::mock(LoggerContract::class);
        $logger->shouldReceive('info')->once()->with('websocket connect');

        $dispatcher = m::mock(DispatcherContract::class);

        $webSocket = m::mock(WebSocket::class);
        $webSocket->shouldReceive('on')->once()->with('message', m::on(function ($value) {
            return is_callable($value);
        }));
        $webSocket->shouldReceive('on')->once()->with('close', m::on(function ($value) {
            return is_callable($value);
        }));
        $webSocket->shouldReceive('send')->once()->with(json_encode([
            'type'        => 'subscribe',
            'product_ids' => [],
            'channels'    => [
                'ticker',
            ],
        ]));

        (new Subscriber($logger, $dispatcher, []))->onConnect($webSocket);
    }

    /** @test */
    public function it_handles_the_message_event()
    {
        $logger = m::mock(LoggerContract::class);
        $logger->shouldReceive('info')->once()->with('websocket message', m::on(function ($value) {
            return is_a($value['payload'], stdClass::class);
        }));

        $dispatcher = m::mock(DispatcherContract::class);
        $dispatcher->shouldReceive('dispatch')->once()->with(m::on(function ($value) {
            return is_a($value, stdClass::class);
        }));

        $message = m::mock(MessageContract::class);
        $message->shouldReceive('getPayload')->once()->andReturn('{"type":"ticker"}');

        (new Subscriber($logger, $dispatcher, ['ticker' => stdClass::class]))->onMessage($message);
    }

    /** @test */
    public function it_handles_the_disconnect_event()
    {
        $code   = 500;
        $reason = 'Internal Server Error';

        $logger = m::mock(LoggerContract::class);
        $logger->shouldReceive('warning')->once()->with('websocket disconnect', compact('code', 'reason'));

        $dispatcher = m::mock(DispatcherContract::class);

        (new Subscriber($logger, $dispatcher, []))->onDisconnect($code, $reason);
    }

    /** @test */
    public function it_handles_the_error_event()
    {
        $exception = new Exception;

        $logger = m::mock(LoggerContract::class);
        $logger->shouldReceive('error')->once()->with('websocket error', compact('exception'));

        $dispatcher = m::mock(DispatcherContract::class);

        (new Subscriber($logger, $dispatcher, []))->onError($exception);
    }

    /** @test */
    public function it_registers_the_listeners()
    {
        $logger = m::mock(LoggerContract::class);

        $dispatcher = m::mock(DispatcherContract::class);

        $connection = m::mock(PromiseContract::class);
        $connection->shouldReceive('then')->once()->with(m::on(function ($value) {
            return is_callable($value);
        }), m::on(function ($value) {
            return is_callable($value);
        }));

        (new Subscriber($logger, $dispatcher, []))->subscribe($connection);
    }
}
