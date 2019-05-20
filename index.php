<?php

function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
  }

  // Remove mensagem de alerta
  error_reporting(1);

  session_start("rede_social");

  // Clicou em enviar? O POST Existe?
  if ($_POST != NULL) {

    // Conecta ao BD
    $conexao = new mysqli("127.0.0.1", "root", NULL, "rede_social");

    // Deu erro ao conectar?
    if ($conexao->connect_error) {
      echo "Erro de Conexão!<br>".$conexao->connect_error;
    }

    // Obtem dados do POST
    $login = addslashes(  $_POST["login"] );
    $password = addslashes(  md5($_POST["password"]) );

    //addslashes() <- evita SQL Injection quado for fazer um SELECT

    // Valida campos obrigatórios
    if ($login != "" && $password != "" ) {

      // Cria o comando SQL
        $sql = "SELECT * FROM users WHERE login = '$login' AND password = '$password'";
        // Executa no BD
        $retorno = $conexao->query($sql);

        // Executou?
        if ($retorno = $retorno->fetch_array()) {
          
          $_SESSION["logado"] 			= "ok";
          $_SESSION["nome_usuario"] 		= $registro["name"];
          $_SESSION["id_usuario"] 		= $registro["id_user"];
          $_SESSION["curso_usuario"] 		= $registro["picture"];
          $_SESSION["semestre_usuario"] 	= $registro["phone"];

          echo "<script>
                    location.href='home.php';
                </script>"
          ;

      } else {

        echo "<script>
                alert('Usuário não encontrado, registre-se e faça parte da nossa comunidade!');
            </script>"
        ;

      }
    } else {
        echo "<script>
                alert('Preencha todos os campos!');
              </script>"
        ;
    }

  }

?>
<!DOCTYPE html>
<html>
<head>
  <title>Bem vindo ao Road Free!</title>
      <!-- Bootstrap CSS -->
      <link href="css/login.css" rel="stylesheet">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mostserrat" rel="stylesheet">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
</head>
<body>
  <img src="https://image.freepik.com/vetores-gratis/desenho-lindo-casal-em-uma-moto_23-2147549779.jpg"><br>
  <h2>Bem Vindo! Faça seu login</h2>
  <form action="" method="POST">
    <input type="login" name="login" placeholder="Login de Acesso" required>
    <input type="password" name="password" placeholder="Senha de Acesso" required>
    <button type="submit" class = "w3-btn w3-blue w3-border w3-border-blue w3-round-xlarge">Entrar</button>
    <a class="w3-btn w3-green w3-border w3-border-green w3-round-xlarge" href="cadastro.php">Criar Conta</a>
  </form>

</body>
</html>