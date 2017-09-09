<?php
session_start();
include 'dbconnect.php';


if (!isset($_SESSION['userSession'])) {
	header("Location: home.php");
}

$query = $DBcon->query("SELECT * FROM usuarios WHERE idUsuario=".$_SESSION['userSession']);
$userRow=$query->fetch_array();


if(isset($_GET['idHost'])) {
 	$serverId = $_GET['idHost'];
 	
 	$query2 = "DELETE FROM servers WHERE idHost = '$serverId'";

  			if ($DBcon->query($query2)) {
   				$msg = "<div class='alert alert-success'>
      			<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Servidor borrado correctamente
     			</div>";
  			}else {
   				$msg = "<div class='alert alert-danger'>
      			<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Error al eliminar servidor 
     			</div>";
  			}
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
            <li><a href="addserver.php">Añadir nuevo dispositivo</a></li>
            <li class="active"><a href="removeserver.php">Eliminar dispositivo</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp; <?php echo $userRow['nombreUsuario']; ?></a></li>
            <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Salir</a></li>
          </ul>
        </div>
      </div>
    </nav>

<div class="container" style="margin-top:150px;text-align:center;font-family:Verdana, Geneva, sans-serif;font-size:35px;">
    
	<h1>Eliminar servidores</h1>
	<br/>
    	<table class="table table-bordered">
		<tr>
			<th class="text-center">Nombre</th>
			<th class="text-center">Puerto</th>
			<th class="text-center">Eliminar</th>
		</tr>
			<?php 
                listar(); 
            ?>
		</table>
</div>
</body>
</html>

<?php
function listar()
{
	include 'dbconnect.php';
	$sql = 'SELECT * FROM servers';
	$query = $DBcon->query($sql);
		while($server = mysqli_fetch_array($query)){
			echo "<tr>";
			echo "<td class='text-center'>".$server['nombreHost']."</td>";
			echo "<td class='text-center'>".$server['puertoHost']."</td>";
			echo "<td class='text-center'><a href='removeserver.php?idHost=".$server['idHost']."'' class='btn btn-danger'>Eliminar</a></td>";
			echo "</tr>";
		}	
}
?>