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

    public function protecao()
    {
        if (!isset($_SESSION['id'])){
            die("Faca login <p> <a href=\"../../portfolio/login.php\">Entrar</a></p>");
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

    public function updateBd($sql, $parametros)
    {
        $types = str_repeat('s', count($parametros));
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param($types, ...$parametros);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $stmt->close();
            return true;
        }

        $stmt->close();
        return false;
    }
    
}
?>
