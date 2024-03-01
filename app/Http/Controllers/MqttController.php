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


class MqttController extends Controller
{
    
    public function index()
    {
        //
    }


}
