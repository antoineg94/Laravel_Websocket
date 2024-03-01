<?php

declare(strict_types=1);

namespace App\Http\Controllers;

require __DIR__ . '/../../../vendor/autoload.php';
require __DIR__ . '/../../../shared/config.php';
require __DIR__ . '/../../../shared/SimpleLogger.php';

use Illuminate\Http\Request;
use PhpMqtt\Client\Examples\Shared\SimpleLogger;
use PhpMqtt\Client\Exceptions\MqttClientException;
use PhpMqtt\Client\MqttClient;
use Psr\Log\LogLevel;
use Session;

class HumiditeController extends Controller
{
    public function index()
    {
        
    $logger = new SimpleLogger(LogLevel::INFO);

    try {
        $client = new MqttClient(MQTT_BROKER_HOST, MQTT_BROKER_PORT, 'test-subscriber', MqttClient::MQTT_3_1, null, $logger);

        $client->connect(null, true);

        $client->subscribe('topicHumidite', function (string $topic, string $message, bool $retained) use ($logger, $client) {
            $logger->info('We received a {typeOfMessage} on topic [{topic}]: {message}', [
                'topic' => $topic,
                'message' => $message,
                'typeOfMessage' => $retained ? 'retained message' : 'message',
            ]);

            Session::put('humidite', $message);

            $client->interrupt();
        }, MqttClient::QOS_AT_LEAST_ONCE);

        $client->loop(true);

        $client->disconnect();
    } catch (MqttClientException $e) {
        $logger->error('Subscribing to a topic using QoS 1 failed. An exception occurred.', ['exception' => $e]);
    }

    return view('welcome');
    }
}
