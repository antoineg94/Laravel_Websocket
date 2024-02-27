<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MqttListener extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mqtt-listener';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $server = 'xxx.com';
        $port = 8883;
        $clientId = 'xxx';
        $username = 'xxx';
        $password = 'xxx';
        $clean_session = true;
        $mqtt_version = MqttClient::MQTT_3_1;
    
        $connectionSettings = (new ConnectionSettings)
            ->setConnectTimeout(10)
            ->setUsername($username)
            ->setPassword($password)
            ->setUseTls(true)
            ->setTlsSelfSignedAllowed(true)
            ->setKeepAliveInterval(60);
    
        $mqtt = new MqttClient($server, $port, $clientId, $mqtt_version);
    
        $mqtt->connect($connectionSettings, $clean_session);
        printf("client connected\n");
    
        $mqtt->subscribe('#', function ($topic, $message) {
            printf("Received message on topic [%s]: %s\n", $topic, $message);
            // Save the message to the database
        }, 0);
    
        $mqtt->loop(true);
    }
}
