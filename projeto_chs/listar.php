<?php
session_start();
include_once "../config.php";

if(isset($_SESSION['id'])){
    $usuarioSessao = $_SESSION['id'];
    $permissaoSessao = $_SESSION['permissao'];
}

$pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_NUMBER_INT);

if (!empty($pagina)) {

    // Calcular o início da visualização
    $qnt_result_pg = 15;
    $inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;
    

    $query_registros = "SELECT a.*,
    (SELECT u.nome FROM chs_historico h INNER JOIN usuarios u ON u.id = h.usuario_id WHERE h.tag_id = a.id order by h.id DESC limit 1) as usuario,
    (SELECT u.id FROM chs_historico h INNER JOIN usuarios u ON u.id = h.usuario_id WHERE h.tag_id = a.id order by h.id DESC limit 1) as idUsuario,
    e.nome as equipamento
    FROM chs_controle a
    LEFT JOIN chs_equipamento e
    ON e.id = a.equipamento_id
    ORDER BY a.id ASC LIMIT $inicio, $qnt_result_pg";
    $result_registros = mysqli_query($conn, $query_registros);

    $dados = "<div class='table-responsive'>
            <table class='table table-striped table-bordered amarelo-papel borda-preta'>
                <thead>
                    <tr>
                        <th>Equipamento</th>
                        <th>TAG</th>
                        <th>Marca</th>
                        <th>Problema</th>
                        <th>Data de Envio</th>
                        <th>Situacao</th>
                        <th>Previsao de Retorno</th>
                        <th>Data_Retorno</th>
                        <th>Garantia</th>
                        <th>Manutencao</th>
                        <th>Usuario</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>";
    while ($row_usuario = mysqli_fetch_assoc($result_registros)) {
        extract($row_usuario);
        $situacaoTd = $situacao;

        if ($situacao === 'Enviado') {
            $situacaoTd = "$situacao ".'<img src="../Images/CHS/enviadow.png" class="img-enviado" alt="Enviado" width="30" height="30">';
        } elseif ($situacao === 'Pendente') {
            $situacaoTd = "$situacao ".'<img src="../Images/CHS/pendente.png" class="img-enviado" alt="Pendente" width="30" height="30">';
        } elseif ($situacao === 'Concluido') {
            $situacaoTd = "$situacao ".'<img src="../Images/CHS/concluido.png" class="img-enviado" alt="Concluido" width="30" height="30">';
        }
        $dados .= "<tr>
                    <td>$equipamento</td>
                    <td>$tag</td>
                    <td>$modelo</td>
                    <td>$problema</td>
                    <td>$data_envio</td>
                    <td>$situacaoTd</td>
                    <td>$previsao</td>
                    <td>$retorno</td>
                    <td>$garantia</td>
                    <td>$manutencao</td>
                    <td>$usuario</td>
                    <td class='td-center'>
                        <div class='btn-center'>
                            <button type='button' class='btn btn-link' data-bs-toggle='modal' data-bs-target='#editModal' onclick=\"lerUsuario(" . $row_usuario["id"] . ")\">
                            <img src='../Images/CHS/editar.png' width='30' height='30'>
                            </button>
                            <button type='button' class='btn btn-link' onclick=\"remove(" . $row_usuario["id"] . ", '" . $idUsuario .  "', '" . $usuarioSessao . "', '" . $permissaoSessao . "')\">
                            <img src='../Images/CHS/excluir.png' width='30' height='30'>
                            </button>
                        </div>
                    </td>
                </tr>";
    }

    $dados .= "</tbody>
        </table>
    </div>";

    // Paginação - Somar a quantidade de usuários
    $query_pg = "SELECT COUNT(id) AS num_result FROM chs_controle";
    $result_pg = mysqli_query($conn, $query_pg);
    $row_pg = mysqli_fetch_assoc($result_pg);

    // Quantidade de páginas
    $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

    $max_links = 2;

    $dados .= '<nav aria-label="Page navigation example"><ul class="pagination pagination-sm justify-content-center">';

    $dados .= "<li class='page-item'><a href='#' class='btn-navegar' onclick='listarUsuarios(1)'>Primeira</a></li>";

    for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
        if ($pag_ant >= 1) {
            $dados .= "<li class='page-item'><a class='btn-navegar' href='#' onclick='listarUsuarios($pag_ant)'>$pag_ant</a></li>";
        }
    }

    $dados .= "<li class='page-item active'><a class='btn-navegar' href='#'>$pagina</a></li>";

    for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
        if ($pag_dep <= $quantidade_pg) {
            $dados .= "<li class='page-item'><a class='btn-navegar' href='#' onclick='listarUsuarios($pag_dep)'>$pag_dep</a></li>";
        }
    }

    $dados .= "<li class='page-item'><a class='btn-navegar' href='#' onclick='listarUsuarios($quantidade_pg)'>Última</a></li>";
    $dados .=   '</ul></nav>';
    
    echo $dados;
} else {
    echo "<div class='alert alert-danger' role='alert'>Erro: Nenhum usuário encontrado!</div>";
}
?>
