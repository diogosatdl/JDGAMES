<?php
include 'conexao.php';
function cadastraProduto()
{
    $nome = $_POST['nome'];
    $marca = $_POST['marca'];
    $descricao = $_POST['descricao'];
    $precoVenda = str_replace(",",".", $_POST['pVenda']);
    $precoCusto =  str_replace(",",".", $_POST['pCusto']);
    $quantidade = $_POST['quantidade'];
    $categoria = $_POST['categoria'];
    $plataforma = $_POST['plataforma'];

    $conexao = conecta();
    $sql = "INSERT INTO produto (nome, marca_produtora,  descricao, preco_venda, quantidade, categoria, plataforma, custo)"
        . "VALUES ('$nome', '$marca', '$descricao', '$precoVenda', '$quantidade', '$categoria', '$plataforma', '$precoCusto')";
    mysqli_query($conexao, $sql) or die("Erro: " . mysqli_error($conexao));
    fechaConexao($conexao);
    session_start();
    $_SESSION['sucesso'] = "Cadastro efetuado com sucesso. Produto: $nome";
    header("location: ../cadastroProduto.php");

}

if (isset($_POST['cadastrar'])) {
    cadastraProduto();
}

function montaTabelaProd($produtos)
{
    $conexao = conecta();
    while ($c = mysqli_fetch_array($produtos)) {
        $codigo = $c['idproduto'];
        $nome = $c['nome'];
        $marca = $c['marca_produtora'];
        $descricao = $c['descricao'];
        $pVenda = $c['preco_venda'];
        $pCusto = $c['custo'];
        $quantidade = $c['quantidade'];
        $plataforma = $c['plataforma'];
        $categoria = $c['categoria'];
        $categorias = listaCategoria($conexao);
        $plataformas = listaPlataforma($conexao);
        echo "<tr>";
        echo "<td>";
        echo $codigo;
        echo "</td>";
        echo "<td>";
        echo $nome;
        echo "</td>";
        echo "<td>";
        echo $marca;
        echo "</td>";
        echo "<td>";
        echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#myModal";
        echo $codigo;
        echo "'>";
        echo "Descrição  ";
        echo "<span class='glyphicon glyphicon-info-sign'></span>";
        echo "</button>";
        echo "<div class='modal fade' id='myModal";
        echo $codigo;
        echo "' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
        echo "<div class='modal-dialog'>";
        echo "<div class='modal-content'>";
        echo "<div class='modal-header'>";
        echo "<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>";
        echo "<h4 class='modal-title' id='myModalLabel'>";
        echo $nome;
        echo "</h4>";
        echo "</div>";
        echo "<div class='modal-body'>";
        echo $descricao;
        echo "</div>";
        echo "<div class='modal-footer'>";
        echo "<button type='button' class='btn btn-default' data-dismiss='modal'>Fechar</button>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</td>";
        echo "<td>";
        echo $pVenda;
        echo "</td>";
        echo "<td>";
        echo $pCusto;
        echo "</td>";
        echo "<td>";
        echo $quantidade;
        echo "</td>";
        echo "<td>";
        echo $plataforma;
        echo "</td>";
        echo "<td>";
        echo $categoria;
        echo "</td>";
        echo "<td>";
        echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#myModal";
        echo $codigo * 2;
        echo "'>";
        echo "Foto  ";
        echo "<span class='glyphicon glyphicon-picture'></span>";
        echo "</button>";
        echo "<div class='modal fade' id='myModal";
        echo $codigo * 2;
        echo "' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
        echo "<div class='modal-dialog'>";
        echo "<div class='modal-content'>";
        echo "<div class='modal-header'>";
        echo "<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>";
        echo "<h4 class='modal-title' id='myModalLabel'>";
        echo $nome;
        echo "</h4>";
        echo "</div>";
        echo "<div class='modal-body'>";
        echo "<img src='img/";
        echo $codigo;
        echo ".jpg' class='foto-table'></img>";
        echo "</div>";
        echo "<div class='modal-footer'>";
        echo "<button type='button' class='btn btn-default' data-dismiss='modal'>Fechar</button>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</td>";
        ?>
        <td>
        <form method="post" action="functions/produto.php" style="display: inline-block">
            <input type="hidden" value="<?php echo $codigo ?>" name="codigo">
            <button type="submit" class="btn btn-danger" value="Deletar" name="deletar">Deletar
                <span class="glyphicon glyphicon-minus"></span></button>
        </form>
        <?php
        echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#myModal";
        echo $codigo * 3;
        echo "'>";
        echo "Editar  ";
        echo "<span class='glyphicon glyphicon-edit'></span>";
        echo "</button>";
        echo "<div class='modal fade' id='myModal";
        echo $codigo * 3;
        echo "' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
        echo "<div class='modal-dialog'>";
        echo "<div class='modal-content'>";
        echo "<div class='modal-header'>";
        echo "<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>";
        echo "<h4 class='modal-title' id='myModalLabel'>";
        echo $nome;
        echo "</h4>";
        echo "</div>";
        echo "<div class='modal-body'>";
        echo "<div class='main-Cad'>";
        echo "<form method='post' action='functions/produto.php'>";
        echo "<div class='form-group'>";
        echo "<label for='codigo'>Codigo</label>";
        echo "<input type='text' class='form-control' id='codigo' value='$codigo' disabled>";
        echo "<input type='hidden' class='form-control' id='codigo' value='$codigo' name='codigo' value='$codigo'>";
        echo "<label for='nome'>Nome</label>";
        echo "<input type='text' class='form-control' id='nome' placeholder='Nome' name='nome' value='$nome'>";
        echo "<label for='marca'>Marca / Produtora</label>";
        echo "<input type='text' class='form-control' id='marca' placeholder='Nome' name='marca' value='$marca'>";
        echo "<label for='descricao'>Descrição</label>";
        echo "<textarea class='form-control' id='descricao' name='descricao' >$descricao</textarea>";
        echo "<label for='preco'>Preço de Venda</label>";
        echo "<input type='text' class='form-control' id='preco' placeholder='R$:' style='width: 150px;' name='pVenda' value='$pVenda'>";
        echo "<label for='custo'>Preço de Custo</label>";
        echo "<input type='text' class='form-control' id='custo' placeholder='R$:' style='width: 150px;' name='pCusto' value='$pCusto'>";
        echo "<label for='quantidade'>Quantidade</label>";
        echo "<input type='number' class='form-control' id='preco' style='width: 150px;' name='quantidade' value='$quantidade'>";
        echo "<label for='categoria'>Categoria</label>";
        echo "<select id='categoria' class='form-control' name='categoria'>";
        while ($c = mysqli_fetch_array($categorias)) {
            $codigo = $c['idcategoria'];
            $categoria = $c['categoria'];
            echo "<option value='$codigo'>$categoria</option>";
        }
        echo "</select>";
        echo "<label for='plataforma'>Plataforma</label>";
        echo "<select id='plataforma' class='form-control' name='plataforma'>";
        while ($c = mysqli_fetch_array($plataformas)) {
            $codigoP = $c['idplataforma'];
            $plataforma = $c['plataforma'];
            echo "<option value='$codigoP'>$plataforma</option>";
                            }
        echo "</select>";
        echo "</div>";
        echo "<button type='submit' class='btn btn-lg btn-success ' value='Editar' name='editar'>Editar  ";
        echo "<span class='glyphicon glyphicon-plus'></button>";
        echo "<button type='reset' class='btn btn-lg btn-warning' value='Limpar'>Limpar  <span class='glyphicon glyphicon-arrow-";
        echo "left'></span></button>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
        echo "<div class='modal-footer'>";
        echo "<button type='button' class='btn btn-danger' data-dismiss='modal'>Fechar <span class='glyphicon glyphicon-remove'></span></button>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</tr>";
    }
}

function listaProduto($con)
{
    $sql = "SELECT produto.idproduto, produto.nome, produto.marca_produtora, produto.descricao, produto.preco_venda,
    produto.custo,produto.quantidade, plataforma.plataforma, categoria.categoria
    from produto
    inner join plataforma on
    produto.plataforma = plataforma.idplataforma
    inner join categoria on
    produto.categoria = categoria.idcategoria";
    $resultado = mysqli_query($con, $sql) or die("Erro: " . mysqli_error($con));
    return $resultado;
}

function listaCategoria($con)
{
    $resultado = mysqli_query($con, "select * from categoria") or die("Erro: " . mysqli_error($con));
    return $resultado;
}

function listaPlataforma($con)
{
    $resultado = mysqli_query($con, "select * from plataforma") or die("Erro: " . mysqli_error($con));
    return $resultado;
}

function deletaProduto($idProduto)
{
    $con = conecta();
    $comando = mysqli_query($con, "delete from produto where idproduto = '$idProduto'");
    if ($comando == false) {
        session_start();
        $_SESSION['erro'] = "Produto " . $idProduto . " nao pode ser excluida, pois esta ligada a um ou mais itens.";
    } else {
        session_start();
        $_SESSION['sucesso'] = "Cadastro excluido com sucesso. Produto excluido: $idProduto";
    }
    fechaConexao($con);
}

if (isset($_POST['deletar'])) {
    $codigo = $_POST['codigo'];
    deletaProduto($codigo);
    header("location: ../cadastroProduto.php");
}


function alteraProduto($idProduto)
{
    $nome = $_POST['nome'];
    $marca = $_POST['marca'];
    $descricao = $_POST['descricao'];
    $pVenda = str_replace(",",".", $_POST['pVenda']);
    $pCusto =  str_replace(",",".", $_POST['pCusto']);
    $quantidade = $_POST['quantidade'];
    $plataforma = $_POST['plataforma'];
    $categoria = $_POST['categoria'];
    $con = conecta();
    $comando = mysqli_query($con, "update produto set nome = '$nome', marca_produtora = '$marca', descricao = '$descricao', preco_venda = '$pVenda', quantidade = '$quantidade', categoria = '$categoria', plataforma = '$plataforma', custo = '$pCusto'  where idproduto = '$idProduto'");
    if ($comando == false) {
        session_start();
        $_SESSION['erro'] = "Produto " . $idProduto . " nao pode ser alterado.";
    } else {
        session_start();
        $_SESSION['sucesso'] = "Cadastro alterado com sucesso. Produto alterado: $idProduto";
    }
    fechaConexao($con);
}

if(isset($_POST['editar'])){
    $codigo = $_POST['codigo'];
    alteraProduto($codigo);
    header("location: ../cadastroProduto.php");
    echo $codigo;
}