<?php
session_start();
include 'dbconnect.php';


if (!isset($_SESSION['userSession'])) {
	header("Location: home.php");
}

$query = $DBcon->query("SELECT * FROM usuarios WHERE idUsuario=".$_SESSION['userSession']);
$userRow=$query->fetch_array();
//$DBcon->close();

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
            <li class="active"><a href="home.php">Inicio</a></li>
            <li><a href="addserver.php">Añadir nuevo dispositivo</a></li>
            <li><a href="removeserver.php">Eliminar dispositivo</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp; <?php echo $userRow['nombreUsuario']; ?></a></li>
            <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Salir</a></li>
          </ul>
        </div>
      </div>
    </nav>

<div class="container" style="margin-top:150px;text-align:center;font-family:Verdana, Geneva, sans-serif;font-size:35px;">
    
	<h1>Estado de los servidores</h1>
	<br/>
    	<table class="table table-bordered">
		<tr>
			<th class="text-center">Nombre</th>
			<th class="text-center">Dominio</th>
			<th class="text-center">IP</th>
			<th class="text-center">Puerto</th>
			<th class="text-center">Estado</th>
		</tr>
                <?php 
                	listar(); 
                ?>
	</table>
</div>
</body>
</html>
<?php

function getStatus($ip, $port)
{
	$socket = @fsockopen($ip, $port, $errorNo, $errorStr, 2);
	if (!$socket) return false;
	else return true;
}


function listar()
{
	include 'dbconnect.php';
	$sql = 'SELECT * FROM servers';
	$query = $DBcon->query($sql);
		while($server = mysqli_fetch_array($query)){
			echo "<tr>";
			echo "<td class='text-center'>".$server['nombreHost']."</td>";
			
			if(filter_var($server->host, FILTER_VALIDATE_IP))
			{
				echo "<td class='text-center'>N/A</td><td class='text-center'>".$server['addrHost']."</td>";	
			}
			else
			{
				echo "<td class='text-center'>".$server['addrHost']."</td><td class='text-center'>".gethostbyname($server['addrHost'])."</td>";
			}
			
			echo "<td class='text-center'>".$server['puertoHost']."</td>";
			
			if (getStatus((string)$server['addrHost'], (string)$server['puertoHost']))
			{
				echo "<td class='text-center'><span class='label label-success'>Online</span></td>";
			}
			else 
			{
				echo "<td class='text-center'><span class='label label-danger'>Offline</span></td>";
			}
			echo "</tr>";
		}
	echo "</table>";
}