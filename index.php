<?php
  // Remove mensagem de alerta
  error_reporting(1);

  session_start();

  function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
  }

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

    // Valida campos obrigatórios
    if ($login != "" && $password != "" ) {

      // Cria o comando SQL
        $sql = "SELECT * FROM users WHERE login = '$login' AND password = '$password'";
        // Executa no BD
        $retorno1 = $conexao->query($sql);

        // Executou?
        if ($registro = $retorno1->fetch_array()) {

          $user_name 		= $registro["name"];
          $id_user 		= $registro["id_user"];
          $user_picture 		= $registro["picture"];
          $user_phone 	= $registro["phone"];

        // Cria o comando SQL
        $sql = "SELECT * FROM invites iv LEFT JOIN user u ON iv.id_sender = $id_user WHERE  AND password = '$password'";
        // Executa no BD
        $retorno2 = $conexao->query($sql);

          //logged user details
          $_SESSION["logado"]   = "ok";
          $_SESSION["user_name"]  = $user_name;
          $_SESSION["id_user"]  = $id_user;
          $_SESSION["user_picture"] = $user_picture;
          $_SESSION["user_phone"] = $user_phone;
          $_SESSION["id_profile"] = $id_user;
          $_SESSION['profile_name'] = $user_name;
          $_SESSION['profile_picture'] = $user_picture;
          $_SESSION['profile_phone'] =  $user_phone;
          if($retorno2){
          $_SESSION["user_friends"] = "";
          }
          //page load information
          echo "<script>
                    location.href='home.php?id_profile=$id_user';
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
      
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mostserrat" rel="stylesheet">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/login.css">
    
  
</head>
<body>
  <img src="http://image.cccdddd.com/big/271/lifestyle-background-couple-riding-motorbike-icon-cartoon-design-245795.jpg" class="img"><br>
  <h2>Bem Vindo! Faça seu login</h2>
  <form action="" method="POST">
    <div class="input-fields">
        <input type="login" name="login" placeholder="Login de Acesso" required>
        <input type="password" name="password" placeholder="Senha de Acesso" required>
    </div>
    <div class="login-submit">
      <button type="submit" class = "entrar w3-btn w3-blue w3-border w3-border-blue w3-round-xlarge">Entrar</button>
      <a class="w3-btn w3-green w3-border w3-border-green w3-round-xlarge" href="cadastro.php">Criar Conta</a>
    </div>
  </form>

</body>
</html>