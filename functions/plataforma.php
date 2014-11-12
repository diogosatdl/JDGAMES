<?php
include 'conexao.php';
function cadastraPlataforma() {
    $plataforma = $_POST['plataforma'];
    $conexao = conecta();
    mysqli_query($conexao, "INSERT INTO plataforma (plataforma)
    values ('$plataforma')") or die("Erro: " . mysqli_error($conexao));
    fechaConexao($conexao);
    session_start();
    $_SESSION['sucesso'] = "Cadastro efetuado com sucesso. Plataforma: $plataforma";
    header("location: ../cadastroPlataforma.php");
}

if (isset($_POST['cadastrar'])) {
    cadastraPlataforma();
}

if (isset($_POST['deletar'])) {
    $codigo = $_POST['codigo'];
    deletaPlataforma($codigo);
    header("location: ../cadastroPlataforma.php");
}

if (isset($_POST['editar'])) {
    $idPlataforma = $_POST['codigo'];
    $plataforma = $_POST['plataforma'];
    alterarPlataforma($idPlataforma, $plataforma);
    session_start();
    $_SESSION['sucesso'] = "Cadastro alterado com sucesso. Plataforma alterada: $plataforma";
    header("location: ../cadastroPlataforma.php");
}

function deletaPlataforma($idPlataforma){
    $con = conecta();
    $comando = mysqli_query($con, "delete from plataforma where idplataforma = '$idPlataforma'");
    if($comando == false){
        session_start();
        $_SESSION['erro'] = "Categoria ". $idPlataforma. " nao pode ser excluida, pois esta ligada a um ou mais itens.";
    }else{
        session_start();
        $_SESSION['sucesso'] = "Cadastro excluido com sucesso. Categoria excluida: $idPlataforma";
    }
    fechaConexao($con);
}

function alterarPlataforma($idPlataforma, $plataforma){
    $con = conecta();
    mysqli_query($con, "update plataforma set plataforma = '$plataforma' where idplataforma = '$idPlataforma'")
    or die("Erro: " . mysqli_error($con));
    fechaConexao($con);
}

function listaPlataforma($con) {
    $resultado = mysqli_query($con, "select * from plataforma") or die("Erro: " . mysqli_error($con));
    return $resultado;
}

function montaTabela($plataformas)
{
    while ($c = mysqli_fetch_array($plataformas)) {
        $codigo = $c['idplataforma'];
        $plataforma = $c['plataforma'];

        echo "<tr>";
        echo "<td>";
        echo $codigo;
        echo "</td>";
        echo "<td>";
        echo $plataforma;
        echo "</td>";
        ?>
        <td>
            <form method="post" action="functions/plataforma.php" style="display: inline-block">
                <input type="hidden" value="<?php echo $codigo ?>" name="codigo">
                <button type="submit" class="btn btn-danger" value="Deletar" name="deletar">Deletar
                    <span class="glyphicon glyphicon-minus"></span></button>
            </form>
            <?php
            echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#myModal";
            echo $codigo;
            echo "'>";
            echo "Editar  ";
            echo "<span class='glyphicon glyphicon-edit'></span>";
            echo "</button>";
            echo "<div class='modal fade' id='myModal";
            echo $codigo;
            echo "' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
            echo "<div class='modal-dialog'>";
            echo "<div class='modal-content'>";
            echo "<div class='modal-header'>";
            echo "<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>";
            echo "<h4 class='modal-title' id='myModalLabel'>";
            echo $plataforma;
            echo "</h4>";
            echo "</div>";
            echo "<div class='modal-body'>";
            echo "<div class='form-group form-edicao'>";
            echo "<form method='post' action='functions/plataforma.php'>";
            echo "<input type='hidden' value='$codigo' name='codigo' id='codigo' class='form-control'>";
            echo "<label for='codigo'>Codigo</label>";
            echo "<input type='text' value='$codigo' id='codigo' class='form-control' disabled><br>";
            echo "<label for='plataforma'>Categoria</label>";
            echo "<input type='text' value='$plataforma' name='plataforma' id='plataforma' class='form-control' style='size: 600px;'><br>";
            echo "<button type='submit' class='btn btn-lg btn-success' value='Editar' name='editar'>Editar  <span class='glyphicon glyphicon-check'></span></button>";
            echo "</form>";
            echo "</div>";
            echo "</div>";
            echo "<div class='modal-footer'>";
            echo "<button type='button' class='btn btn-danger' data-dismiss='modal'>Fechar  <span class='glyphicon glyphicon-remove'></span></button>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            ?>
        </td>
        <?php
        echo "</tr>";
    }
}

