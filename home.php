<?php
session_start();
include_once 'dbconnect.php';


if (!isset($_SESSION['userSession'])) {
	header("Location: index.php");
}

$query = $DBcon->query("SELECT * FROM usuarios WHERE idUsuario=".$_SESSION['userSession']);
$userRow=$query->fetch_array();
$DBcon->close();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Olabide Ikastola - WiFi status</title>

<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 

<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="home.php">Inicio</a></li>
            <li><a href="#">Añadir nuevo dispositivo</a></li>
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
    <p>Cuerpo de la página</p>
    <?php
	$system_name = snmp2_get("192.168.1.1", "public", "system.SysName.0");
	print ($system_name);	

	$snmp_values = snmp2_walk("192.168.1.1", "public", "");
	print ($snmp_values[0]);		
	print_r($snmp_values);
	
	//$snmpHost = new /OSS_SNMP/SNMP("192.168.0.250", "public");
	//print_r ($snmpHost->usesystem()->contact());	
	
	
	$snmphost = new \OSS_SNMP\SNMP("192.168.0.250", "public");
	echo $snmpHost->get('.1.3.6.1.2.1.1.4.0');
?>
</div>

</body>
</html>
