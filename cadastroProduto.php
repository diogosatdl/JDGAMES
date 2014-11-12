<!DOCTYPE html>
<?php
include_once './functions/produto.php';
header('Content-Type: text/html; charset=utf-8');
session_start();
?>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Produtos</title>
</head>
<body>
<?php
include('cabecalhoAdmin.php');
$conexao = conecta();
$produtos = listaProduto($conexao);
$categorias = listaCategoria($conexao);
$plataformas = listaPlataforma($conexao);
fechaConexao($conexao);
?>
<div class="main">
    <h1 class="header">Produtos</h1>
    <?php
    if(isset($_SESSION['sucesso'])){
        $mensagem = $_SESSION['sucesso'];
        echo "<div class='alert alert-success' role='alert'>";
        echo "<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>";
        echo $mensagem;
        echo "</div>";
        session_destroy();
    }
    ?>

    <button type='button' class='btn btn-success btn-lg' data-toggle='modal' data-target='#myModal'>Cadastrar
        <span class="glyphicon glyphicon-plus"></button>
    <br><br>
    <table class="table table-hover">
        <th>Codigo</th>
        <th>Nome</th>
        <th>Marca / Produtora</th>
        <th>Descriçao</th>
        <th>Preço de Venda</th>
        <th>Custo</th>
        <th>Quantidade</th>
        <th>Categoria</th>
        <th>Plataforma</th>
        <th>Foto</th>
        <th>Ações</th>
        <?php
        montaTabelaProd($produtos);
        ?>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Cadastrar Produto</h4>
            </div>
            <div class="modal-body">
                <div class="main-Cad">
                <form method="post" action="functions/produto.php">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome">
                        <label for="marca">Marca / Produtora</label>
                        <input type="text" class="form-control" id="marca" placeholder="Nome" name="marca">
                        <label for="descricao">Descrição</label>
                        <textarea class="form-control" id="descricao" name="descricao"></textarea>
                        <label for="preco">Preço de Venda</label>
                        <input type="text" class="form-control" id="preco" placeholder="R$:" style="width: 150px;"
                               name="pVenda">
                        <label for="custo">Preço de Custo</label>
                        <input type="text" class="form-control" id="custo" placeholder="R$:" style="width: 150px;"
                               name="pCusto">
                        <label for="quantidade">Quantidade</label>
                        <input type="number" class="form-control" id="preco" style="width: 150px;" name="quantidade">
                        <label for="categoria">Categoria</label>
                        <select id="categoria" class="form-control" name="categoria">
                            <?php
                            while ($c = mysqli_fetch_array($categorias)) {
                                $codigo = $c['idcategoria'];
                                $categoria = $c['categoria'];
                                echo "<option value='$codigo'>$categoria</option>";
                            }
                            ?>
                        </select>
                        <label for="plataforma">Plataforma</label>
                        <select id="plataforma" class="form-control" name="plataforma">
                            <?php
                            while ($c = mysqli_fetch_array($plataformas)) {
                                $codigoP = $c['idplataforma'];
                                $plataforma = $c['plataforma'];
                                echo "<option value='$codigoP'>$plataforma</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-lg btn-success " value="Cadastrar" name="cadastrar">Cadastrar
                        <span class="glyphicon glyphicon-plus"></button>
                    <button type="reset" class="btn btn-lg btn-warning" value="Limpar">Limpar  <span class="glyphicon glyphicon-arrow-left"></span></button>
                    </form>
            </div>

            <div class="modal-footer">
                <button type='button' class='btn btn-danger' data-dismiss='modal'>Fechar <span
                        class='glyphicon glyphicon-remove'></span></button>
            </div>
        </div>
    </div>
</div>
</body>
</html>