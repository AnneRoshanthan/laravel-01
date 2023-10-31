<?php

namespace App\WebSocketHandlers;

use BeyondCode\LaravelWebSockets\Apps\App;
use BeyondCode\LaravelWebSockets\QueryParameters;
use BeyondCode\LaravelWebSockets\WebSockets\Exceptions\UnknownAppKey;
use Ratchet\WebSocket\MessageComponentInterface;
use Illuminate\Support\Facades\Log;
use Ratchet\ConnectionInterface;

abstract class BaseWebsocketHandler implements MessageComponentInterface
{

    protected function verifyAppKey(ConnectionInterface $connection) {
        $appKey = QueryParameters::create($connection->httpRequest)->get('appKey');

        if (!$app = App::findByKey($appKey)) {
            throw new UnknownAppKey($appKey);
        }
        $connection->app = $app;
        return $this;
    }

    protected function generateSocketId(ConnectionInterface $connection){
        $socketId = sprintf('%d.%d',random_int(1,1000000000),random_int(1,1000000000));
        $connection->socketId = $socketId;
        return $this;
    }

    public function onOpen(ConnectionInterface $connection)
    {
        Log::info("on open is working");
        $this->verifyAppKey($connection)->generateSocketId($connection);
        // Implement your logic for handling WebSocket connections.
    }

    public function onClose(ConnectionInterface $connection)
    {
        Log::info("Closed");
        // Implement your logic for handling WebSocket disconnections.
    }

    public function onError(ConnectionInterface $connection, \Exception $e)
    {
        Log::info($e);
    }

}
