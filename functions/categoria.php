<?php
include 'conexao.php';

function listaCategoria($con)
{
    $resultado = mysqli_query($con, "select * from categoria") or die("Erro: " . mysqli_error($con));
    return $resultado;
}

function cadastraCategoria()
{
    $categoria = $_POST['categoria'];
    $conexao = conecta();
    mysqli_query($conexao, "INSERT INTO categoria (categoria)
    values ('$categoria')") or die("Erro: " . mysqli_error($conexao));
    fechaConexao($conexao);
    session_start();
    $_SESSION['sucesso'] = "Cadastro efetuado com sucesso. Categoria: $categoria";
    header("location: ../cadastroCategoria.php");
}

if (isset($_POST['cadastrar'])) {
    cadastraCategoria();
}

if (isset($_POST['deletar'])) {
    $codigo = $_POST['codigo'];
    deletaCategoria($codigo);
    header("location: ../cadastroCategoria.php");
}

if (isset($_POST['editar'])) {
    $idCategoria = $_POST['codigo'];
    $categoria = $_POST['categoria'];
    alterarCategoria($idCategoria, $categoria);
    session_start();
    $_SESSION['sucesso'] = "Cadastro alterado com sucesso. Categoria alterada para: $categoria";
    header("location: ../cadastroCategoria.php");
}

function deletaCategoria($idCategoria)
{
    $con = conecta();
    $comando = mysqli_query($con, "delete from categoria where idcategoria = '$idCategoria'");
    if($comando == false){
        session_start();
        $_SESSION['erro'] = "Categoria ". $idCategoria. " nao pode ser excluida, pois esta ligada a um ou mais itens.";
    }else{
        session_start();
        $_SESSION['sucesso'] = "Cadastro excluido com sucesso. Categoria excluida: $idCategoria";
    }
    fechaConexao($con);
}

function alterarCategoria($idCategoria, $categoria)
{
    $con = conecta();
    mysqli_query($con, "update categoria set categoria = '$categoria' where idcategoria = '$idCategoria'")
    or die("Erro: " . mysqli_error($con));
    fechaConexao($con);
}

function montaTabela($categorias)
{
    while ($c = mysqli_fetch_array($categorias)) {
        $codigo = $c['idcategoria'];
        $categoria = $c['categoria'];

        echo "<tr>";
        echo "<td>";
        echo $codigo;
        echo "</td>";
        echo "<td>";
        echo $categoria;
        echo "</td>";
        ?>
        <td>
            <form method="post" action="functions/categoria.php" style="display: inline-block">
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
            echo $categoria;
            echo "</h4>";
            echo "</div>";
            echo "<div class='modal-body'>";
            echo "<div class='form-group form-edicao'>";
            echo "<form method='post' action='functions/categoria.php'>";
            echo "<input type='hidden' value='$codigo' name='codigo' id='codigo' class='form-control'>";
            echo "<label for='codigo'>Codigo</label>";
            echo "<input type='text' value='$codigo' id='codigo' class='form-control' disabled><br>";
            echo "<label for='categoria'>Categoria</label>";
            echo "<input type='text' value='$categoria' name='categoria' id='categoria' class='form-control' style='size: 600px;'><br>";
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
