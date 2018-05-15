<?php

namespace Laratrade\GDAX\WebSocket;

use Exception;
use Laratrade\GDAX\Contracts\WebSocket\Subscriber as SubscriberContract;
use Psr\Log\LoggerInterface as LoggerContract;
use Ratchet\Client\WebSocket;
use Ratchet\RFC6455\Messaging\MessageInterface as MessageContract;
use React\Promise\PromiseInterface as PromiseContract;

class Subscriber implements SubscriberContract
{
    /**
     * The logger instance.
     *
     * @var LoggerContract
     */
    protected $logger;

    /**
     * The event mappings.
     *
     * @var array
     */
    protected $events;

    /**
     * Create a new subscriber instance.
     *
     * @param LoggerContract $logger
     * @param array          $events
     */
    public function __construct(LoggerContract $logger, array $events)
    {
        $this->logger = $logger;
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
        $this->logger->info('websocket connect');

        $webSocket->on('message', [$this, 'onMessage']);
        $webSocket->on('close', [$this, 'onDisconnect']);

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

        $this->logger->info('websocket message', compact('payload'));

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
        $this->logger->warning('websocket disconnect', compact('code', 'reason'));
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
        $this->logger->error('websocket error', compact('exception'));
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param PromiseContract $connection
     */
    public function subscribe(PromiseContract $connection): void
    {
        $connection->then([$this, 'onConnect'], [$this, 'onError']);
    }
}
