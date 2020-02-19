<?php


namespace App\Http\Connections;
use React\Socket\ConnectionInterface;

class ConnectionsPool
{
    protected $connections;

    public function __construct()
    {
        $this->connections = new \SplObjectStorage();
    }

    public function add(ConnectionInterface $connection)
    {
        $this->connections->attach($connection);
        $connection->on('data', function ($data) use ($connection) {
            $connection->write("Hello ");
            foreach ($this->connections as $conn) {

            }
        });
    }
}
