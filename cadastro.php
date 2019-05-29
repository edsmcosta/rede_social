<?php

function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
  }

  // Remove mensagem de alerta
  //error_reporting(1);

  // Clicou em enviar? O POST Existe?
    if ($_POST != NULL) {

        // Conecta ao BD
        include_once "bd_connect.php";

        // Obtem dados do POST
        $name = addslashes( $_POST["nome"] );
        $phone = addslashes( $_POST["telefone"] );
        $login = addslashes( $_POST["login"] );
        $password = addslashes( md5($_POST["password1"]) );
        if( strlen($_POST["foto"]) != 0) { 
            $picture = addslashes( $_POST["foto"] );
        } else {
            $picture = "https://images.vexels.com/media/users/3/147102/isolated/preview/082213cb0f9eabb7e6715f59ef7d322a---cone-do-perfil-do-instagram-by-vexels.png";
        }

        // Valida campos obrigatórios
        if ($name != "" && $login != "" && $password != "") {
            $sql = "SELECT * 
                            FROM users
                            WHERE login = '$login' ";
                    
            $retorno = $conexao->query( $sql );
            $registro = $retorno -> fetch_array();

            if (!$registro[0]) {
                
                    // Cria o comando SQL
                    $sql = "INSERT INTO users ( name, login, password, picture, phone ) VALUES ( '$name', '$login', '$password', '$picture' , '$phone')";

                    // Executa no BD
                    $retorno = $conexao->query( $sql );

                    // Executou?
                    if ($retorno == true) {

                        echo "<script>
                                alert('Cadastrado com Sucesso!');
                                location.href='index.php';
                            </script>"
                        ;
                        console_log( $retorno );

                    } else {
                        
                        echo "<script>
                                alert('Erro ao Cadastrar!');
                            </script>"
                        ;
                        // Exibe do erro que o banco retorna
                        console_log( $retorno );
                        console_log( $conexao->error );

                    }
            }else{
                echo "<script>
                        alert('Já existe um usuário com esses dados!');
                        location.href = 'cadastro.php'
                    </script>";
            }
        } else {    
                echo "<script>
                        alert('Preencha todos os campos!');
                    </script>"
                ;
            
        }

    }

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/cadastro.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Road Free</title>
  </head>
  <body>
 <fieldset>
    <h2 class='w3-center'>Cadastro</h2>
    <form class='w3-center' method="POST">

        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="nome" maxlength="100" required class="form-control">
        </div>

        <div class="form-group">
            <label>Login</label>
            <input type="text" name="login" maxlength="50" required class="form-control">
        </div>

        <div class="form-group">
            <label>Senha</label>
            <input type="password" name="password1" maxlength="50" required class="form-control">
        </div>

        <div class="form-group">
            <label>Telefone</label>
            <input type="text" name="telefone" maxlength="50" class="form-control">
        </div>


        <div class="form-group">
            <label>Foto</label>
            <input type="text" name="foto" class="form-control">
        </div>

        <button type="submit" class = "w3-btn w3-blue w3-border w3-border-blue w3-round-xlarge">Cadastrar</button>
        <a class ="w3-btn w3-red w3-border w3-border-red w3-round-xlarge" href="index.php">Voltar</a>    
    </form>  
</fieldset>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>