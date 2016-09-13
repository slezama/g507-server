<?php

$host = 'localhost';
$usuario = 'root';
$pass = 'enersaving';

try{
	
	$dbopts = parse_url(getenv('DATABASE_URL'));
	
	//$conn = new PDO('mysql:host='.$host.';dbname=enersaving', $usuario, $pass);
	
	 $conn = new PDO('pgsql:host='.$dbopts["host"].';port='.$dbopts["port"].';dbname='.ltrim($dbopts["path"],'/'), $dbopts["user"], $dbopts["pass"]);
	
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	$sentencia = $conn->prepare("INSERT INTO consumo (codigo_arduino, tipo, consumo) VALUES (:cod_arduino, :tipo, :consumo)");
	$sentencia->bindParam(':cod_arduino', $cod_arduino);
	$sentencia->bindParam(':tipo', $tipo);
	$sentencia->bindParam(':consumo', $consumo);

	//Obtener variables de la URL
	$cod_arduino = $_GET['cod_arduino'];
	$tipo = $_GET['tipo_consumo'];
	$consumo = $_GET['consumo'];
	
	//Ejecutar INSERT 
	$sentencia->execute();	
	
}catch(PDOException $e){
	echo "ERROR: " . $e->getMessage();
}
?>