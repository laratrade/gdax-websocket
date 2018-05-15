<?php

namespace Laratrade\GDAX\WebSocket\Commands\WebSocket;

use Illuminate\Config\Repository as RepositoryContract;
use Illuminate\Console\Command;
use Laratrade\GDAX\WebSocket\Contracts\WebSocket\Subscriber as SubscriberContract;
use Ratchet\Client\Connector;

class Process extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gdax:websocket:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process the WebSocket data';

    /**
     * The connector instance.
     *
     * @var Connector
     */
    protected $connector;

    /**
     * The config repository instance.
     *
     * @var RepositoryContract
     */
    protected $config;

    /**
     * The subscriber instance.
     *
     * @var SubscriberContract
     */
    protected $subscriber;

    /**
     * Create a new command instance.
     *
     * @param Connector          $connector
     * @param RepositoryContract $config
     * @param SubscriberContract $subscriber
     */
    public function __construct(Connector $connector, RepositoryContract $config, SubscriberContract $subscriber)
    {
        parent::__construct();

        $this->connector  = $connector;
        $this->config     = $config;
        $this->subscriber = $subscriber;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $connector  = $this->connector;
        $connection = $connector($this->config->get('websocket.url'));

        $this->subscriber->subscribe($connection);
    }
}
