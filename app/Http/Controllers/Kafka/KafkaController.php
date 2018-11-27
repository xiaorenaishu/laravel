<?php
/**
 *
 * Date: 2018/11/27
 * Time: 15:02
 */

namespace App\Http\Controllers\Kafka;

use App\Http\Controllers\Controller;

class KafkaController extends Controller
{
    //
    public function producer()
    {
        $message = $_GET;
        if (empty($message['msg'])) {
            $message = 'test1....message.' . date('Ymd H:i:s');
        } else {
            $message = $message['msg'];
        }
        $config = \Kafka\ProducerConfig::getInstance();
        $config->setMetadataRefreshIntervalMs(10000);
        $config->setMetadataBrokerList('127.0.0.1:9092');
        $config->setBrokerVersion('0.11.0.0');
        $config->setRequiredAck(1);
        $config->setIsAsyn(false);
        $config->setProduceInterval(500);
        $producer = new \Kafka\Producer();
        $result = $producer->send(array(
            array(
                'topic' => 'test1',
                'value' => $message,
                'key' => 'key' . time(),
            ),
        ));
        echo '<pre/>';
        var_dump($result);
    }


}