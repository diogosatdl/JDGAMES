<?php

function conecta() {
    $con = mysqli_connect("localhost", "root", "", "mydb") or die("Erro: " . mysqli_connect_error());
    mysqli_set_charset($con, 'UTF8');
    return $con;
}

function fechaConexao($con) {
    mysqli_close($con);
}




