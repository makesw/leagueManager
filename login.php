<?php 
session_start();
require 'conexion.php';
$usuario = $connect->query("SELECT u.*, up.perfil FROM usuario u
JOIN usuario_perfil up ON u.id = up.id_usuario and u.correo = '".$_POST['correo']."' AND u.password = '".$_POST['password']."' AND activo = 1");

if($usuario->num_rows == 1){
	$datos  =$usuario->fetch_assoc();
	$_SESSION['dataSession'] = $datos;
	echo json_encode(array('error'=>false,'correo'=>$datos['correo'],'perfil'=>$datos['perfil']));		
}else{	
	echo json_encode(array('error'=>true));
}
$connect->close();

?>