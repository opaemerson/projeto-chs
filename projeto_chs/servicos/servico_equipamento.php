<?php
require_once('../config.php');

class servicoEquipamento
{
    private $repo;

    public function __construct(){
        $this->repo = new CategoriaRepo();
    }

    public function servico_excluir($id){
        return $this->repo->excluir($id);
    }
}
?>