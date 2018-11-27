<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class producer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'producer';

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
        $config = \Kafka\ProducerConfig::getInstance();
        $config->setMetadataRefreshIntervalMs(10000);
        $config->setMetadataBrokerList('127.0.0.1:9092');
        $config->setBrokerVersion('0.11.0.0');
        $config->setRequiredAck(1);
        $config->setIsAsyn(false);
        $config->setProduceInterval(500);
        $producer = new \Kafka\Producer();
// $producer->setLogger($logger);
        for ($i = 0; $i < 2; $i++) {
            $result = $producer->send(array(
                array(
                    'topic' => 'test1',
                    'value' => 'test1....message.' . date('Ymd H:i:s'),
                    'key' => 'key' . $i,
                ),
            ));
            var_dump($result);
        }
    }
}
