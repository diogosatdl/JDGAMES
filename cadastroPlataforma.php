<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include_once './functions/plataforma.php';
header('Content-Type: text/html; charset=utf-8');
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Plataformas</title>
    </head>
    <body>
        <?php
        include('cabecalhoAdmin.php');
        $conexao = conecta();
        $plataformas = listaPlataforma($conexao);
        fechaConexao($conexao);
        ?>
        <div class="main">
            <h1 class="header">Plataformas</h1>
            <?php
            if(isset($_SESSION['sucesso'])){
                $mensagem = $_SESSION['sucesso'];
                echo "<div class='alert alert-success alert-dismissible' role='alert'>";
                echo "<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>";
                echo $mensagem;
                echo "</div>";
                session_destroy();
            }
            if(isset($_SESSION['erro'])){
                $mensagem = $_SESSION['erro'];
                echo "<div class='alert alert-danger alert-dismissible' role='alert'>";
                echo "<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>";
                echo $mensagem;
                echo "</div>";
                session_destroy();
            }
            ?>
            <table class="table table-hover" >
                <th>Codigo</th>
                <th>Plataforma</th>
                <th>Ações</th>
                <?php
                montaTabela($plataformas)
                ?>
            </table>
            <form method="post" action="functions/plataforma.php">
                <label for="nome">Categoria</label>
                <input type="text" class="form-control" id="nome" placeholder="Categoria"
                       required="true" name="plataforma">
                <button type="submit" class="btn btn-lg btn-success " value="Cadastrar" name="cadastrar">Cadastrar
                    <span class="glyphicon glyphicon-plus"></button>
            </form>
        </div>

    </body>
</html>
