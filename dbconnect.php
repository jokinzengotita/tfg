<?php
	
	$DBhost = "localhost";
	$DBuser = "root";
	$DBpass = "U08123419";
	$DBname = "dbtfg";
	
	$DBcon = new mysqli($DBhost,$DBuser,$DBpass,$DBname);

	if ($DBcon->connect_errno) {
    	printf("Falló la conexión: %s\n", $mysqli->connect_error);
    	exit();
	} else {
	printf("Conexión establecida - \n");
	}
	echo $DBcon->host_info . "\n";
