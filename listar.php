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
  
  
	$follow 	= $_GET["follow"];
	$unfollow 	= $_GET["unfollow"];
  $like_post = $_GET["like_post"];
	$follow_user = $_GET["follow_user"];
	$like = $_GET["object"];
  $id_user 	= $_SESSION["id_user"];
  $id_profile 	= $_SESSION["id_profile"];

  // Conecta ao BD
  include_once "bd_connect.php";
  
  if($_POST["post_user"]){

      // Obtem dados do POST
      $post_image = addslashes(  $_POST["post_image"] );
      $post_text = addslashes(  $_POST["post_text"] );

      // Valida campos obrigatórios
      if ($post_image != "" && $post_text != "" ) {

        // Cria o comando SQL
        $sql = "INSERT INTO posts (id_user, post_image, post_text) VALUES ('$id_user', '$post_image', '$post_text')";
        // Executa no BD
        $retorno = $conexao->query($sql);

        if (!$retorno) {

          echo "<script>";
          echo "alert('Erro na inserção!')";
          echo "document.location.reload()";
          echo "</script>";
        }
        else{

          echo "<script>";
          echo "alert('Postagem concluida!'); ";
          echo "window.history.back(); ";
          echo "</script>";
        }
      }
      else{
        echo "<script>alert('Por favor, informe todos os campos!')</script>";
      }
  }


  // Follow user
	if ($follow) {
    
		$sql = "SELECT * 
				FROM invite 
				WHERE (id_sender='$id_user' AND id_receiver='$id_following') 
        OR (id_sender='$id_following' AND id_receiver='$id_user')
        AND NOT FIND_IN_SET(id_status, '1,2');";
        
		$retorno_follow = $conexao -> query($sql);
    $registro = $retorno_follow -> fetch_array();
    
		if (!$registro[0]) {

			$sql = "INSERT INTO invite (id_sender, id_receiver)
          VALUES ('$id_sender', '$id_receiver')";
          
      $retorno_invite = $conexao -> query( $sql );
      
			if (!$retorno_invite) {
				echo "<script>";
				echo "alert('Erro na inserção!');";
				echo "</script>";
			}
			else{
        echo "<script>";
				echo "alert('Convite enviado!');";
				echo "</script>";
			}
		}
		else{
			echo "<script>alert('Você já tem/solicitou a amizade desta pessoa')</script>";
		}	
  }
  
    // Unfollow user
	if ($unfollow) {
    
		$sql = "SELECT * 
				FROM invite 
				WHERE (id_sender='$id_sender' AND id_receiver='$id_receiver') 
        OR (id_sender='$id_receiver' AND id_receiver='$id_sender')
        AND NOT FIND_IN_SET(id_status, '1,2');";
        
		$retorno_follow = $conexao -> query($sql);
    $registro = $retorno_follow -> fetch_array();
    
		if ($registro[0]) {

			$sql = "INSERT INTO invite (id_sender, id_receiver)
          VALUES ('$id_s  ender', '$id_receiver')";
          
      $retorno_invite = $conexao -> query( $sql );
      
			if (!$retorno_invite) {
				echo "<script>";
				echo "alert('Erro na inserção!');";
				echo "</script>";
			}
			else{
        echo "<script>";
				echo "alert('Acabou a amizade!');";
				echo "</script>";
			}
		}
		else{
			echo "<script>alert('Você não segue esta pessoa')</script>";
		}	
  }
  
  // like post
	if ($like_post) {
    
		$sql = "SELECT * 
				FROM post_likes 
        WHERE (id_post = $like_post AND id_user = $id_user);";
        
        
		$retorno_follow = $conexao -> query($sql);
    $registro = $retorno_follow -> fetch_array();
    
		if (!$registro[0]) {

			$sql = "INSERT INTO post_likes (id_post, id_user)
          VALUES ('$like_post', '$id_user')";
          
      $retorno_like = $conexao -> query( $sql );
      
			if (!$retorno_like) {
				echo "<script>";
        echo "alert('Erro na inserção!');";
				echo "</script>";
			}
			else{
        echo "<script>";
				echo "alert('Liked!');";
        echo "window.history.back();";
				echo "</script>";
			}
		}
		else{
      $sql = "DELETE 
      FROM post_likes 
      WHERE id_post = $like_post AND id_user = $id_user;";
      
      $retorno_like = $conexao -> query( $sql );
      $registro = $retorno_like;

			if (!$retorno_like) {
				echo "<script>";
				echo "alert('Erro na inserção!');";
				echo "</script>";
			}
			else{
        echo "<script>";
        echo "alert('Unliked!');";
        echo "window.history.back();";
				echo "</script>";
			}
		}	
  }  
?>
<!DOCTYPE html>
<html>
<title>Road Free</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
<link rel="stylesheet" href="css/listar.css">
<style>
html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
</style>
<body class="w3-theme-l5">

<?php include_once "topo.php";?>

<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      <div class="w3-card w3-round">
        <div class="w3-container">
         <h4 class="w3-center"><?php echo $_SESSION["user_name"];?></h4>
         <p class="w3-center"><img src='<?php echo $_SESSION["user_picture"];?>' class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
         <hr>
         <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i> <?php echo $_SESSION["user_phone"];?></p>
        </div>
      </div>
      <br>
      
      <!-- Accordion -->
      <div class="w3-card w3-round">
        <div class="w3-white">
        <a href="buscar.php" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> Search Friends</a>          <div id="Demo1" class="w3-hide w3-container">
          </div>
          <a href="listar.php" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> My Friends</a>          <div id="Demo2" class="w3-hide w3-container">
          </div>
        </div>      
      </div>
      <br>
      
      
    <!-- End Left Column -->
    </div>
    
    <!-- Middle Column -->
    <div class="w3-col m7">
    
      <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">

          </div>
        </div>
      </div>

      <?php 

          $sql = "SELECT inv.id_invite, us.id_user , us.name, us.picture, us.phone 
                  FROM users AS us 
                  LEFT OUTER JOIN invites as inv ON us.id_user = inv.id_sender
                  WHERE inv.id_receiver = $id_profile AND inv.id_status = 1
                  UNION
                  SELECT inv.id_invite, us.id_user , us.name, us.picture, us.phone 
                  FROM users AS us 
                  LEFT OUTER JOIN invites as inv ON us.id_user = inv.id_receiver
                  WHERE inv.id_sender = $id_profile AND inv.id_status = 1;"
          ;

        $retorno = $conexao -> query($sql);

          if($retorno == false){
              echo $conexao->error;
          }else{
          
            while ($registro = $retorno -> fetch_array()) {
              
              $friend_user_id 		  = $registro['id_user'];
              $friend_user_name     = $registro['name'];
              $friend_user_image      = $registro['picture'];

			?>

        <div id="<?php echo $friend_user_id; ?>" class="w3-container postC  w3-card w3-white w3-round w3-margin"><br>
          <img src="<?php echo $friend_user_image; ?>" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
          <h4><a href="home.php?id_profile=<?php echo $friend_user_id; ?>"><?php echo $friend_user_name; ?></a><br></h4> 
          <a id="bt" href=# class="w3-button w3-block w3-red w3-section" title="Dismiss"><i class="fa fa-remove"></i></a>
        </div>
        
      <?php
            }
          }
			?>
      
    
      
    <!-- End Middle Column -->
    </div>
    
    <!-- Right Column -->
    <div class="w3-col m2">
      
      <?php

        $sql = "SELECT inv.id_invite as id_invite, us.id_user as id_user , us.name as user_name, us.picture as user_picture, us.phone as user_phone FROM invites AS inv INNER JOIN invite_status as inv_st ON inv.id_status = inv_st.id_status INNER JOIN users as us ON inv.id_sender = us.id_user WHERE inv.id_receiver = $id_user AND inv.id_status = 2";

        $retorno = $conexao -> query($sql);

        if($retorno == false){
            echo $conexao->error;
        }else{
          $_SESSION["invites_received"] = $retorno;
        }

        while($registro = $_SESSION["invites_received"] -> fetch_array()){

          if($registro["id_status"] = 2){

            $id_invite = $registro["id_invite"];
            $nome = $registro["user_name"];
            $phone = $registro["user_phone"];
            $picture = $registro["user_picture"];

            echo  "      
            <br>

            <div class='w3-card w3-round w3-white w3-center'>
                
              <div class='w3-container'>
      
                <p>Friend Request</p>
                <img src='$picture' alt='Avatar' style='width:50%'><br>
                <span>$nome</span>
                <div class='w3-row w3-opacity'>
                  <div class='w3-half'>
                    <a href='accept.php?id_invite=$id_invite' class='w3-button w3-block w3-green w3-section' title='Accept'><i class='fa fa-check'></i></a>
                  </div>
                  <div class='w3-half'>
                    <a href='reject.php?id_invite=$id_invite' class='w3-button w3-block w3-red w3-section' title='Decline'><i class='fa fa-remove'></i></a>
                  </div>
                </div>
              </div>
            </div>
            <br>
            <br>";
          }
        }
      ?>
      
      
    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
<br>

<?php include_once "rodape.php";?>
 
<script>
// Accordion
function myFunction(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-theme-d1";
  } else { 
    x.className = x.className.replace("w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-theme-d1", "");
  }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>

</body>
</html> 