<?php

namespace App\WebSocketHandlers;

use Illuminate\Support\Facades\Log;
use Ratchet\ConnectionInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;
use Ratchet\WebSocket\MessageComponentInterface;

class CustomWebSocketHandler extends BaseWebsocketHandler implements MessageComponentInterface
{
   
    public function onMessage(ConnectionInterface $connection, MessageInterface $msg)
    {
        Log::info("WORKING");
        Log::info($msg->getPayload());
        $payload = $msg->getPayload();
        $connection->send = "shdfgsdfghd";
        // Implement your logic for handling WebSocket messages.
    }
}
