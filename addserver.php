<?php
session_start();
include_once 'dbconnect.php';


if (!isset($_SESSION['userSession'])) {
	header("Location: addserver.php");
}

$query = $DBcon->query("SELECT * FROM usuarios WHERE idUsuario=".$_SESSION['userSession']);

$userRow=$query->fetch_array();

	if(isset($_POST['btn-add'])) {
 		
 		$hname = strip_tags($_POST['name']);
 		$haddr = strip_tags($_POST['host']);
 		$hport = strip_tags($_POST['port']);
 
 		$hname = $DBcon->real_escape_string($hname);
 		$haddr = $DBcon->real_escape_string($haddr);
 		$hport = $DBcon->real_escape_string($hport);
 		
 		$check_host = $DBcon->query("SELECT * FROM servers WHERE addrHost='$haddr'");
 		$count=$check_host->num_rows;
 
 		if ($count==0) {
  
  			$query2 = "INSERT INTO servers (nombreHost,addrHost,puertoHost) VALUES('$hname','$haddr','$hport')";

  			if ($DBcon->query($query2)) {
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
     		<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Servidor existente
    		</div>";
   		}
 
 		//$DBcon2->close();
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Olabide Ikastola - Server status</title>

<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 

<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<script src="bootstrap/js/jquery.js" type="text/javascript"></script>
<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="home.php">Inicio</a></li>
            <li class="active"> <a href="addserver.php">Añadir nuevo dispositivo</a></li>
            <li><a href="#">Eliminar dispositivo</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp; <?php echo $userRow['nombreUsuario']; ?></a></li>
            <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Salir</a></li>
          </ul>
        </div>
      </div>
    </nav>
    
<div class="container" style="margin-top:150px;text-align:center;font-family:Verdana, Geneva, sans-serif;font-size:35px;">

       <form class="form-signin" method="post" id="add-server-form">
      
        <h2 class="form-signin-heading">Añadir servidor</h2><hr />
	<?php
		if (isset($msg)) {
		echo $msg;
		}
	?>
       	<div class="form-group">
	<input type="text" class="form-control" name="name" placeholder="Nombre" required />
	</div>
        
        <div class="form-group">
	<input type="text" class="form-control" name="host" placeholder="Dominio / IP" required />
	</div>
        
        <div class="form-group">
	<input type="text" class="form-control" name="port" placeholder="Puerto" required />
	</div>
        
      <hr />
        
        <div class="form-group">
		<button type="submit" class="btn btn-default" name="btn-add">
      			<span class="glyphicon glyphicon-plus"></span> &nbsp; Añadir
   		</button> 
        </div> 
      
      </form>

    
</div>

</body>
</html>
