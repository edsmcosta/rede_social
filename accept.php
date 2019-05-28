<?php

  // Remove mensagem de alerta
  error_reporting(1);

  include_once "bd_connect.php";

  // Obtém ID via GET
  $id = $_GET["id_invite"];

  // Esqueceu de passar o ID?
  if ($id == NULL) {
    echo "O ID não foi passado! <br>";
  }

    // Cria o comando SQL
    $sql = "UPDATE invites SET id_status = 1 WHERE id_invite = $id";

    // Executa no BD
    $retorno = $conexao->query($sql);

    if (!$retorno) {
      echo "<script>";
      echo "alert('Erro na inserção!');";
      echo "window.history.back()";
      echo "</script>";
    }
    else{
      echo "<script>";
      echo "alert('Relacionamento atualizado!');";
      echo "window.history.back()";
      echo "</script>";
    }

?> 