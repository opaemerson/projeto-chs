<?php

class Config
{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbname = "gobinc";
    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Conexao Falhou: " . $this->conn->connect_error);
        }
    }

    public function pegaSessaoUsuario()
    {
        if (isset($_SESSION['id'])) {
            return [
                'usuarioSessao' => $_SESSION['id'],
                'permissaoSessao' => $_SESSION['permissao']
            ];
        }

        return null;
    }
}
?>
