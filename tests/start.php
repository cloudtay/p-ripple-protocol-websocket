<?php

use Cclilshy\PRipple\PRipple;
use Cclilshy\PRipple\Worker\Socket\TCPConnection;
use Cclilshy\PRipple\Worker\WorkerNet;
use Cclilshy\PRippleProtocolWebsocket\WebSocket;

include __DIR__ . '/../vendor/autoload.php';

$kernel = PRipple::configure([]);

$ws = new WorkerNet('ws');
$ws->protocol(WebSocket::class);
$ws->bind('tcp://127.0.0.1:8001');
$ws->hook(WorkerNet::HOOK_ON_MESSAGE, function (string $content, TCPConnection $TCPConnection) {
    $TCPConnection->send('you say: ' . $content);
});
$kernel->push($ws);
$kernel->run();
