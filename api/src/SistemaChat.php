<?php

namespace Api\Websocket;

use Exception;
use Ratchet\ConnectionInterface;
use Ratchet\WebSocket\MessageComponentInterface;
require __DIR__ . '/../vendor/autoload.php';

class SistemaChat implements MessageComponentInterface{

    protected $clientes;

    public function __construct()
    {
        $this->clientes = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clientes->attach($conn);
        echo "Nova conexao {$conn->resourceId}\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {

        if ($this->contemSubString($msg, 'recarregar')) {
            $this->enviarParaTodos("recarregar");
            echo "Mensagem 'recarregar' enviada para todos\n";
            return;
        }

        foreach ($this->clientes as $cliente) {
            if ($from !== $cliente) {
                $this->enviar($cliente, $msg);
            }
        }

        echo "Usuario {$from->resourceId} enviou uma mensagem\n";
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clientes->detach($conn);
        echo "Usuario {$conn->resourceId} desconectou.\n";
    }

    public function onError(ConnectionInterface $conn, Exception $e)
    {
        $conn->close();
        echo "Ocorreu um erro: {$e->getMessage()}\n";
    }

    private function enviarParaTodos($mensagem)
    {
        foreach ($this->clientes as $cliente) {
            $this->enviar($cliente, $mensagem);
        }
    }

    private function enviar(ConnectionInterface $conn, $mensagem)
    {
        echo "1 passo - Enviando mensagem para \n";
        $conn->send($mensagem);
    }

    private function contemSubString($string, $substring)
    {
        return strpos($string, $substring) !== false;
    }
}
