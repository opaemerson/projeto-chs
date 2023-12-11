<?php

namespace Api\Websocket;

use Exception;
use Ratchet\ConnectionInterface;
use Ratchet\WebSocket\MessageComponentInterface;

class SistemaChat implements MessageComponentInterface{

    protected $cliente;

    public function __construct()
    {
        $this->cliente = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->cliente->attach($conn);

        echo "Nova conexao {$conn->resourceId} \n\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        foreach ($this->cliente as $key){
            if ($from !== $key){
                $key->send($msg);
            }
        }

        echo "Usuario {$from->resourceId} enviou uma mensagem \n\n";
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->cliente->detach($conn);
        
        echo "Usuario {$conn->resourceId} desconectou. \n\n"; 
    }

    public function onError(ConnectionInterface $conn, Exception $e)
    {
        $conn->close();

        echo "Ocorreu um erro: {$e->getMessage()}";
    }
    
}