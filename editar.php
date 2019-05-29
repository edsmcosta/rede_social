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
  <?php include_once "topo.php";?>
    <h2 class='w3-center'>Change Settings</h2>
    <form class='w3-center' method="POST">

        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="nome" maxlength="100" required class="form-control" placeholder="Nome">
        </div>

        <div class="form-group">
            <label>Login</label>
            <input type="text" name="login" maxlength="50" required class="form-control" placeholder="Login">
        </div>

        <div class="form-group">
            <label>Senha Nova</label>
            <input type="password" name="password2" maxlength="50" required class="form-control" placeholder="Nova Senha">
        </div>

        <div class="form-group">
            <label>Telefone</label>
            <input type="text" name="telefone" maxlength="50" class="form-control" placeholder="Telefone">
        </div>


        <div class="form-group">
            <label>Foto</label>
            <input type="text" name="foto" class="form-control">
        </div>

        <button type="submit" class = "w3-btn w3-blue w3-border w3-border-blue w3-round-xlarge">Cadastrar</button>
        <a class ="w3-btn w3-red w3-border w3-border-red w3-round-xlarge" href="index.php">Voltar</a>    
    </form>  

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <?php include_once "rodape.php";?>  
  </body>
  
</html>