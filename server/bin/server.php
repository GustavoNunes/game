<?php
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Jogo\Connection;
use Jogo\GameLoop;
use Jogo\GameWorld;

function now() {
    return round(microtime(true) * 1000);
}

require dirname(__DIR__) . '/vendor/autoload.php';

$connection = new Connection();
$eventLoop = React\EventLoop\Factory::create();

new GameWorld($connection, $eventLoop);

$socket = new React\Socket\Server($eventLoop);
$socket->listen(8080, '0.0.0.0');

$server = new IoServer(new HttpServer(new WsServer($connection)), $socket, $eventLoop);
$server->run();