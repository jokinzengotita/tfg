<?php
	ob_start();
	session_start();
	if( isset($_SESSION['user'])!="" ){
		header("Location: home.php");
	}
	include_once('dbconnect.php');

	if(isset($_POST['btn-registro'])) {
 
 		$uname = strip_tags($_POST['nombreUsuario']);
 		$email = strip_tags($_POST['emailUsuario']);
 		$upass = strip_tags($_POST['passUsuario']);
 
 		$uname = $DBcon->real_escape_string($uname);
 		$email = $DBcon->real_escape_string($email);
 		$upass = $DBcon->real_escape_string($upass);
 
 		$hashed_password = password_hash($upass, PASSWORD_DEFAULT);
 
 		$check_email = $DBcon->query("SELECT email FROM usuarios WHERE emailUsuario='$email'");
 		$count=$check_email->num_rows;
 
 		if ($count==0) {
  
  			$query = "INSERT INTO usuarios(nombreUsuario,emailUsuario,passUsuario) VALUES('$uname','$email','$hashed_password')";

  			if ($DBcon->query($query)) {
   				$msg = "<div class='alert alert-success'>
      			<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Registro realizado correctamente
     			</div>";
  			}else {
   				$msg = "<div class='alert alert-danger'>
      			<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Error en el registro 
     			</div>";
  			}
  
 		} else {
  
  			$msg = "<div class='alert alert-danger'>
     		<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Email en uso
    		</div>";
   		}
 
 		$DBcon->close();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Olabide Ikastola - WiFi Status</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
<link rel="stylesheet" href="style.css" type="text/css" />

</head>
<body>

<div class="signin-form">

 <div class="container">
     
       <form class="form-signin" method="post" id="register-form">
      
        <h2 class="form-signin-heading">OLABIDE IKASTOLA - Registro</h2><hr />
        
        <?php
  if (isset($msg)) {
   echo $msg;
  }
  ?>
          
        <div class="form-group">
        <input type="text" class="form-control" placeholder="Nombre" name="nombreUsuario" required  />
        </div>
        
        <div class="form-group">
        <input type="email" class="form-control" placeholder="Email" name="emailUsuario" required  />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" placeholder="Password" name="passUsuario" required  />
        </div>
        
      <hr />
        
        <div class="form-group">
        	<button type="submit" class="btn btn-default" name="btn-registro">
      			<span class="glyphicon glyphicon-log-in"></span> &nbsp; Registro
   		</button> 
            <a href="index.php" class="btn btn-default" style="float:right;">Volver a inicio</a>
        </div> 
      
      </form>

    </div>
    
</div>

</body>
</html>
