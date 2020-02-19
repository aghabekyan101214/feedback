<?php

namespace App\Http\connections;

require "vendor/autoload.php";
use React\EventLoop\Factory;
use React\Socket\Server;
use React\Socket\ConnectionInterface;
use App\Http\Connections\ConnectionsPool;

class SocketConnection
{
    public function connect()
    {
        $loop = Factory::create();
        $socket = new Server('127.0.0.1:8080', $loop);
        $pool = new ConnectionsPool();
        $socket->on('connection', function (ConnectionInterface $connection) use ($pool) {
            $pool->add($connection);
        });

        $loop->run();
    }
}

$obj = new SocketConnection();
$obj->connect();
