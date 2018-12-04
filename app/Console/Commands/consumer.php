<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class consumer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consumer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $config = \Kafka\ConsumerConfig::getInstance();
        $config->setMetadataRefreshIntervalMs(10000);
        $config->setMetadataBrokerList('127.0.0.1:9092');
        $config->setGroupId('test');
        $config->setBrokerVersion('0.11.0.0');
        $config->setTopics(array('test1'));
//$config->setOffsetReset('earliest');
        $consumer = new \Kafka\Consumer();
//$consumer->setLogger($logger);
        $consumer->start(function($topic, $part, $message) {
            var_dump($message);
        });
    }
}
