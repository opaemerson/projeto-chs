<?php
require_once('C:/xampp/htdocs/portfolio/config.php');
require_once('repositorios/equipamento.php');
require_once('repositorios/marca.php');
require_once('repositorios/problema.php');
require_once('repositorios/principal.php');

class Servico {
    private $equipamento;
    private $marca;
    private $problema;
    private $principal;
    private $config;
    private $conn;

    public function __construct() {
        $this->config = new Config();
        $this->equipamento = new Equipamento();
        $this->marca = new Marca();
        $this->problema = new Problema();
        $this->principal = new Principal();
        $this->conn = $this->config->conn;
    }

    public function buscaEquipamento()
    {
        $equipamentos = $this->equipamento->buscaEquipamento($this->conn);

        return $equipamentos;
    }

    public function buscaMarca()
    {
        $marcas = $this->marca->buscaMarca($this->conn);

        return $marcas;
    }

    public function buscaProblema()
    {
        $problemas = $this->problema->buscaProblema($this->conn);

        return $problemas;
    }

    public function buscaDados()
    {
        $dados = $this->principal->buscaDados($this->conn);

        return $dados;
    }

    public function buscaGenerica($select, $from, $where)
    {
        $dados = $this->principal->buscaGenerica($this->conn, $select, $from, $where);

        return $dados;
    }

    public function limiteCinco($usuario, $tabela)
    {
        $dados = $this->principal->limiteCinco($this->conn, $usuario, $tabela);

        return $dados;
    }
}
?>
