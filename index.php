<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    include_once "functions/produto.php";
    include_once "cabecalhoAdmin.php";
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>JD Games</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/estilos.css">

    </head>
    <body style=" margin: 0 auto; background-color: white">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="width: 940px; margin: 0 auto;">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner " role="listbox" >

                <div class="item active" >

                    <img src="img/codbanner.jpg" class="img-responsive" >
                    <div class="carousel-caption">
                        <a href="#" style="text-decoration: none; color: white">
                        <h2>Por Apenas: R$: 199,99</h2></a>
                    </div>
                </div>

                <div class="item">
                    <img src="img/xboxbanner.jpg" class="img-responsive">
                    <div class="carousel-caption">
                        <a href="#" style="text-decoration: none; color: white">
                            <h2>Por Apenas: R$: 1499,99</h2></a>
                    </div>
                </div>

                <div class="item">
                    <img src="img/ps4banner.jpg" class="img-responsive">
                    <div class="carousel-caption">
                        <a href="#" style="text-decoration: none; color: white">
                            <h2>Por Apenas: R$: 1499,99</h2></a>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <?php
        $conexao = conecta();
        $produtos = listaProduto($conexao);
        fechaConexao($conexao);
        ?>
        <div class="row" style="width: 940px; margin: 0 auto; padding: 20px; border: 1px solid #cecece; background-color: #f5f5f5; border-radius: 10px;">
            <?php
            while ($c = mysqli_fetch_array($produtos)) {
                $codigo = $c['idproduto'];
                $nome = $c['nome'];
                $preco = $c['preco_venda'];
            ?>
            <a href="#" class="limpa">
                <div class="col-xs-6 col-sm-4 produto" >
                    <?php
                        echo "<img src='img/".$codigo.".jpg' class='img-responsive imgIndex' alt='$nome'>";
                    ?>
                    <h4><?php echo $nome ?></h4>
                    <h2><?php echo "R$: ".$preco ?></h2>
                    <h5>Ou em 10x de R$: <?php echo number_format(($preco / 10), 2) ?></h5>
                </div>
            </a>
            <?php
              }
            ?>
            </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>    
    </body>
</html>
