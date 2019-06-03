<?php 
    error_reporting(1);
    session_start();
    
    if ($_SESSION["logado"] != 'ok') {
        header("Location: index.php");
    }

    function console_log( $data ){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
      } 

    $id_user = $_SESSION["id_user"];

    if($_POST != NULL){
        
        include_once "bd_connect.php";

        $new_name = addslashes( $_POST["nome"] );
        $new_login = addslashes( $_POST["login"] );
        $new_phone = addslashes( $_POST["telefone"] );
        $new_image = addslashes( $_POST["foto"] );
        $password_change = false;
        if($_POST["password3"] != "" && $_POST["password3"] = $_POST["password2"]){

            $new_password = addslashes( md5($_POST["password3"]) );
            $password_change = true;

        }else{

            $new_password = addslashes( md5($_POST["password1"]) );
            
        }

        // Valida campos obrigatórios
        if ($new_name != "" && $new_login != "" && $new_password != "" && $new_phone != "" ) {

                if($password_change){ $cond1 = ", password = '$new_password'";}else{ $cond1 = "";}
                if($new_picture != ""){ $cond2 = ", picture = '$new_picture'";}else{ $cond2 = "";}

                $sql = "UPDATE users 
                        SET 
                              name = '$new_name'
                            , login = '$new_login'"
                            .$cond1
                            .$cond2
                            .", phone = '$new_phone'
                        WHERE id_user = $id_user"
                ;
                
            $retorno_edit = $conexao -> query($sql);

            var_dump($retorno_edit);
        
            if ($retorno_edit == true) {

                $_SESSION["user_name"]  = $new_name;
                $_SESSION["user_picture"] = $new_picture;
                $_SESSION["user_phone"] = $new_phone;
                $_SESSION["id_profile"] = $id_user;
                $_SESSION['profile_name'] = $new_name;
                $_SESSION['profile_picture'] = $new_picture;
                $_SESSION['profile_phone'] =  $new_phone;

                echo "<script>
                        alert('Editado com sucesso!!')
                        location.href = 'home.php'
                      </script>";

            }else{
                echo "<script>alert('Não foi possível editar o contato ')</script>";
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
    <link rel="stylesheet" href="css/editar.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Road Free</title>
  </head>
  <body>

  <?php include_once "topo.php";
        var_dump($id_user);    
    ?>
    <h2 class='w3-center'>Change Settings</h2>
    <?php
      include_once "bd_connect.php";
        $sql = "SELECT * 
                FROM users 
                WHERE id_user='$id_user';";
        
        $retorno_follow = $conexao -> query($sql);
        $registro = $retorno_follow -> fetch_array();
    
        if ($registro[0]) {

            $name = $registro["name"];
            $login = $registro["login"];
            $phone = $registro["phone"];
            $image = $registro["picture"];

        
      ?>
        <form class='w3-center' method="POST">
            <div class="form-group">
                <label>Nome</label>
                <input type="text" value="<?php echo $name ;?>" name="nome" maxlength="100" required class="form-control" placeholder="Nome">
            </div>

            <div class="form-group">
                <label>Login</label>
                <input type="text" value="<?php echo $login ;?>" name="login" maxlength="50" required class="form-control" placeholder="Login">
            </div>

            <div class="form-group">
                <label>Senha Atual</label>
                <input type="password" value="<?php echo "" ;?>" name="password1" maxlength="50" class="form-control" placeholder="Senha Antiga">
            </div>

            <div class="form-group">
                <label>Senha Nova</label>
                <input type="password" value="<?php echo "" ;?>" name="password2" maxlength="50"  class="form-control" placeholder="Nova Senha">
            </div>

            <div class="form-group">
                <label>Confirmar Senha Nova</label>
                <input type="password" value="<?php echo "" ;?>" name="password3" maxlength="50"  class="form-control" placeholder="Confirmar Senha">
            </div>

            <div class="form-group">
                <label>Telefone</label>
                <input type="text" value="<?php echo $phone ;?>" name="telefone" maxlength="50" class="form-control" placeholder="Telefone">
            </div>
            <div class="form-group">
                <label>Foto</label>
                <input type="text" value="<?php echo $image ;?>" name="foto" class="form-control">
            </div>

            <button type="submit" name="edit_user_button" class="w3-btn w3-blue w3-border w3-border-blue w3-round-xlarge">Salvar</button>
            <a class ="w3-btn w3-red w3-border w3-border-red w3-round-xlarge" href="home.php">Voltar</a>    
        </form>  
    
    <?php
                      }
                      else{
                          echo "<script>alert('Seu usuário sumiu! hehe')</script>";
                      }	
        ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <?php include_once "rodape.php";?>  
  </body>
  
</html>