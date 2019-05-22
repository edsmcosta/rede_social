<?php 

//INICIALIZANDO A SESSÃO
session_start();

//APAGAR TODAS AS VARIÁVEIS DA SESSÃO
session_destroy();

//VOLTA PARA O LOGIN
header("Location: index.php");
?>