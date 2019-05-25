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
  
  function accept_invite( $id_invite ){
    // Conecta ao BD
    include_once "bd_connect.php";

    // Cria o comando SQL
    $sql = "UPDATE invites SET id_status = 1 WHERE id_invite = $id_invite";

    // Executa no BD
    $retorno = $conexao->query($sql);

    if (!$retorno) {
      echo "<script>";
      echo "alert('Erro na inserção!');";
      echo "</script>";
    }
    else{
      echo "<script>";
      echo "alert('Relacionamento atualizado!');";
      echo "</script>";
    }
    
  }



  function reject_invite( $id_invite ){
    // Conecta ao BD
    include_once "bd_connect.php";

    // Cria o comando SQL
    $sql = "UPDATE invites SET id_status = 3 WHERE id_invite = $id_invite";

    // Executa no BD
    $retorno = $conexao->query($sql);

    if (!$retorno) {
      echo "<script>";
      echo "alert('Erro na inserção!');";
      echo "</script>";
    }
    else{
      echo "<script>";
      echo "alert('Relacionamento atualizado!');";
      echo "</script>";
    }
    
  }
  
	$follow 	= $_GET["follow"];
	$unfollow 	= $_GET["unfollow"];
  $like_post = $_GET["like_post"];
	$follow_user = $_GET["follow_user"];
	$like = $_GET["object"];
  $id_user 	= $_SESSION["id_user"];

  // Conecta ao BD
  include_once "bd_connect.php";
  
  if($_POST["user_post"]){

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
          echo "alert('Erro na inserção!');";
          echo "</script>";
        }
        else{
          echo "<script>";
          echo "alert('Postagem concluida!');";
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
        
		$retorno_follow = $con -> query($sql);
    $registro = $retorno_follow -> fetch_array();
    
		if (!$registro[0]) {

			$sql = "INSERT INTO invite (id_sender, id_receiver)
          VALUES ('$id_sender', '$id_receiver')";
          
      $retorno_invite = $con -> query( $sql );
      
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
        
		$retorno_follow = $con -> query($sql);
    $registro = $retorno_follow -> fetch_array();
    
		if ($registro[0]) {

			$sql = "INSERT INTO invite (id_sender, id_receiver)
          VALUES ('$id_s  ender', '$id_receiver')";
          
      $retorno_invite = $con -> query( $sql );
      
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

    $post_tbl = $_GET["id_post"];
    
		$sql = "SELECT * 
				FROM post_likes 
				WHERE (id_post = $post_tbl AND id_user = $id_user);";
        
		$retorno_follow = $con -> query($sql);
    $registro = $retorno_follow -> fetch_array();
    
		if (!$registro[0]) {

			$sql = "INSERT INTO post_likes (id_post, id_user)
          VALUES ('$id_post', '$id_user')";
          
      $retorno_like = $con -> query( $sql );
      
			if (!$retorno_like) {
				echo "<script>";
				echo "alert('Erro na inserção!');";
				echo "</script>";
			}
			else{
        echo "<script>";
				echo "alert('Liked!');";
				echo "</script>";
			}
		}
		else{
      $sql = "DELETE 
      FROM post_likes 
      WHERE id_post = $post_tbl AND id_user = $id_user;";
      
      $retorno_like = $con -> query( $sql );
      $registro = $retorno_like -> fetch_array();

      
      
			if (!$retorno_like) {
				echo "<script>";
				echo "alert('Erro na inserção!');";
				echo "</script>";
			}
			else{
        echo "<script>";
				echo "alert('Unliked!');";
				echo "</script>";
			}
		}	
  }  
?>
<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
<link rel="stylesheet" href="css/home.css">
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
         <p class="w3-center"><img src='<?php echo $_SESSION["user_picture"] ;?>' class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
         <hr>
         <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i> <?php echo $_SESSION["user_phone"];?></p>
        </div>
      </div>
      <br>
      
      <!-- Accordion -->
      <div class="w3-card w3-round">
        <div class="w3-white">
          <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fas fa-search fa-fw w3-margin-right"></i> Search Friends</button>
          <div id="Demo1" class="w3-hide w3-container">
            <p>Some text..</p>
          </div>
          <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> My Friends</button>
          <div id="Demo2" class="w3-hide w3-container">
            <p>Some other text..</p>
          </div>
          <button onclick="myFunction('Demo3')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="far fa-images fa-fw w3-margin-right"></i> My Photos</button>
          <div id="Demo3" class="w3-hide w3-container">
         <div class="w3-row-padding">
         <br>
           <div class="w3-half">
             <img src="/w3images/lights.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="/w3images/nature.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="/w3images/mountains.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="/w3images/forest.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="/w3images/nature.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="/w3images/snow.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
         </div>
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
            <div class="w3-container w3-padding">
              <h6 class="w3-opacity">Write your post</h6>
              <p><input type="text" class="textpost w3-border w3-padding" placeholder="Write your msg"></p>
              <button type="button" class="w3-button w3-theme"><i class="fa fa-edit"></i>  Post</button> 
            </div>
          </div>
        </div>
      </div>

      <?php 
				if ($_SESSION['id_profile'] != $_SESSION["id_user"]) {
					$id_profile = $_SESSION['id_profile'];
					$sql = "SELECT * FROM posts WHERE id_user='$id_profile' ORDER BY created_at DESC";
				}
				else{
					$sql = "SELECT users.id_user, users.name, users.picture, posts.* 
                  FROM posts 
                  INNER JOIN users ON posts.id_user = users.id_user
                  WHERE posts.id_user = $id_user
                  UNION 
                  SELECT users.id_user, users.name, users.picture, posts.* 
                  FROM invites 
                  INNER JOIN posts ON invites.id_receiver = posts.id_user
                  INNER JOIN users ON posts.id_user = users.id_user
                  WHERE invites.id_sender = $id_user 
                  UNION 
                  SELECT users.id_user, users.name, users.picture, posts.* 
                  FROM invites 
                  INNER JOIN posts ON invites.id_sender = posts.id_user 
                  INNER JOIN users ON posts.id_user = users.id_user
                  WHERE invites.id_receiver = $id_user 
                  ORDER BY created_at DESC;";
        }
        $retorno_posts = $conexao -> query($sql);

				while ($registro = $retorno_posts -> fetch_array()) {
          
					$id_post 		        = $registro['id_post'];
          $post_user_id 		  = $registro['id_user'];
          $post_user_name     = $registro['name'];
          $post_user_img      = $registro['picture'];
					$post_img 		      = $registro['post_img'];
          $post_text 		      = $registro['post_text'];
          $post_data 		      = $registro['created_at'];

              $sql = "SELECT COUNT(id_like) as n_likes
                      FROM post_likes 
                      WHERE id_post=$id_post;";

              $return = $conexao -> query($sql);
              $return = $return -> fetch_array();

          $post_likes_n = $return["n_likes"];

              $sql = "SELECT COUNT(id_like) as n_likes
              FROM post_likes 
              WHERE id_post=$id_post AND id_user = $id_user;";

              $return = $conexao -> query($sql);
              $return = $return -> fetch_array();

          $user_like_post = $return["n_likes"];

            $sql = "SELECT c.* , u.name , u.picture 
            FROM comments c
            INNER JOIN users u ON c.id_user = u.id_user
            WHERE id_post = $id_post;";

            $return = $conexao -> query($sql);
            $return = $return -> fetch_array();
          
          $post_comments = $return["n_likes"];
          var_dump($post_likes_n."//");
          var_dump($post_comments."//");
          var_dump($user_like_post."//");
			?>

      <?php
				}
			?>
      
      <div class="w3-container postC  w3-card w3-white w3-round w3-margin"><br>
        <img src="/w3images/avatar2.png" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
        <span class="w3-right w3-opacity">1 min</span>
        <h4>John Doe</h4><br>
        <hr class="w3-clear">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
          <div class="w3-row-padding" style="margin:0 -16px">
            <div class="w3-half">
              <img src="/w3images/lights.jpg" style="width:100%" alt="Northern Lights" class="w3-margin-bottom">
            </div>
            <div class="w3-half">
              <img src="/w3images/nature.jpg" style="width:100%" alt="Nature" class="w3-margin-bottom">
          </div>
        </div>
        <button type="button" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i>  Like</button> 
        <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i>  Comment</button> 
      </div>
      
      <div class="w3-container postC w3-card w3-white w3-round w3-margin"><br>
        <img src="/w3images/avatar5.png" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
        <span class="w3-right w3-opacity">16 min</span>
        <h4>Jane Doe</h4><br>
        <hr class="w3-clear">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        <button type="button" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i>  Like</button> 
        <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i>  Comment</button> 
      </div>  

      <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
        <img src="/w3images/avatar6.png" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
        <span class="w3-right w3-opacity">32 min</span>
        <h4>Angie Jane</h4><br>
        <hr class="w3-clear">
        <p>Have you seen this?</p>
        <img src="/w3images/nature.jpg" style="width:100%" class="w3-margin-bottom">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        <button type="button" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i>  Like</button> 
        <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i>  Comment</button> 
      </div> 
      
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
                    <button class='w3-button w3-block w3-green w3-section' title='Accept'><i class='fa fa-check'></i></button>
                  </div>
                  <div class='w3-half'>
                    <button class='w3-button w3-block w3-red w3-section' title='Decline'><i class='fa fa-remove'></i></button>
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

<!-- Footer -->
<footer class="w3-container foot w3-theme-d3 w3-padding-16">
  <h5>Footer</h5>
</footer>

<footer class="w3-container foot2 w3-theme-d5">
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>
 
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