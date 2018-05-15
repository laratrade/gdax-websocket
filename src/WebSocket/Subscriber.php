<?php

namespace Laratrade\GDAX\WebSocket;

use Exception;
use Illuminate\Support\Facades\Log;
use Laratrade\GDAX\Contracts\WebSocket\Subscriber as SubscriberContract;
use Ratchet\Client\WebSocket;
use Ratchet\RFC6455\Messaging\MessageInterface as MessageContract;
use React\Promise\PromiseInterface as PromiseContract;

class Subscriber implements SubscriberContract
{
    /**
     * The event mappings.
     *
     * @var array
     */
    protected $events;

    /**
     * Create a new subscriber instance.
     *
     * @param array $events
     */
    public function __construct(array $events)
    {
        $this->events = $events;
    }

    /**
     * Handle the connect event.
     *
     * @param WebSocket $webSocket
     *
     * @return void
     */
    public function onConnect(WebSocket $webSocket): void
    {
        Log::info('websocket connect');

        $webSocket->on('message', function (MessageContract $message) {
            $this->onMessage($message);
        });

        $webSocket->on('close', function (int $code = null, string $reason = null) {
            $this->onDisconnect($code, $reason);
        });

        $webSocket->send(json_encode([
            'type'        => 'subscribe',
            'product_ids' => [],
            'channels'    => [
                'ticker',
            ],
        ]));
    }

    /**
     * Handle the message event.
     *
     * @param MessageContract $message
     *
     * @return void
     */
    public function onMessage(MessageContract $message): void
    {
        $payload = json_decode($message);

        Log::info('websocket message', compact('payload'));

        if (!isset($payload->type) || !isset($this->events[$payload->type])) {
            return;
        }

        event(new $this->events[$payload->type]($payload));
    }

    /**
     * Handle the disconnect event.
     *
     * @param int|null    $code
     * @param string|null $reason
     *
     * @return void
     */
    public function onDisconnect(int $code = null, string $reason = null): void
    {
        Log::warning('websocket disconnect', compact('code', 'reason'));
    }

    /**
     * Handle the error event.
     *
     * @param Exception $exception
     *
     * @return void
     */
    public function onError(Exception $exception): void
    {
        Log::error('websocket error', compact('exception'));
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param PromiseContract $connection
     */
    public function subscribe(PromiseContract $connection): void
    {
        $connection->then(function (WebSocket $webSocket) {
            $this->onConnect($webSocket);
        }, function (Exception $exception) {
            $this->onError($exception);
        });
    }
}
