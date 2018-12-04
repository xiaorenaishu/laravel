<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class demo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo';

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
        logger(date('Y-m-d H:i:s'), [1, 3, 4]);
//        (date('Y-m-d H:i:s'));
        //
//        $this->consumer();
    }

    protected function producer()
    {

    }

    protected function consumer()
    {
        $config = \Kafka\ConsumerConfig::getInstance();
        $config->setMetadataRefreshIntervalMs(10000);
        $config->setMetadataBrokerList('127.0.0.1:9092');
        $config->setGroupId('test1');
        $config->setBrokerVersion('0.11.0.0');
        $config->setTopics(array('test1'));
        var_dump($config->getConsumeMode());
//$config->setOffsetReset('earliest');
        $consumer = new \Kafka\Consumer();
//$consumer->setLogger($logger);
        $consumer->start(function ($topic, $part, $message) {
            var_dump($topic);
            var_dump($part);
            var_dump($message);
        });

    }
}
