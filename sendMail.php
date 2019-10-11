<?php
header( 'Content-Type: application/json' );
$action = '';
if( isset($_GET['action']) ){
	$action = $_GET['action'];
}
if( $action!= null && $action=='recordar' ){
	require 'conexion.php';	
	require 'constants.php';	
	$usuario = mysqli_fetch_array( $connect->query("SELECT u.correo, u.password, u.nombres, u.apellidos FROM usuario u WHERE u.correo = '".$_POST['correo']."'") );
	if($usuario != NULL && isset($usuario['correo'])){
		require 'constants.php';
		$subject = 'Recordar Contraseña';
		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html" . "\r\n";
		$headers .= "From: ".$correoUsuarios." \r\n";
		$message = '
		<!doctype html>
		<html>
		<head>
		<meta charset="utf-8">
		<title>Recordar contraseña</title>
		</head>
		<body style="background-color: white; font-family: Helvetica Neue,Helvetica,Arial,sans-serif">
			<center>
			<div id="body" style="text-align: left;border-radius: 3px;color: darkgray;
			font-size: 16px;max-width: 94%;margin-top: 40px; height: 400px; width: 420px; background-color: white;">
				<div style="margin-left: 10px;">
				<p style="margin-top: 20px;"><strong>
				<img src="http://demoflm.makesw.com/images/logo.png">
				<br/><br/>Recordar contraseña</strong>,<br>
				Estimado usuario: <strong>'.$usuario['nombres'].' '.$usuario['apellidos'].'</strong> Solicitaste recordar los datos para acceso a tu cuenta en: '.$DOMINIOCLIENTE.'
				<strong><br/><br/>Correo: '.$usuario['correo'].'<br/></strong>
				<strong><br/>Contraseña: '.$usuario['password'].'<br/></strong>
				<br/>
				Cordialmente, 
				<br/>
				'.$CORREOCLIENTE.'
				</p><br/>
				</div>				
			</div>
			</center>
		</body>
		</html>';
			
	if(mail($usuario['correo'],$subject,$message,$headers)){
		echo json_encode(array('error'=>false,'description'=>'OK'));
	}else{
		echo json_encode(array('error'=>true,'description'=>'FAIL'));
	}	
	}else{			
		echo json_encode(array('error'=>true,'recordar'=>'FAIL','noData'=>'NO_DATA'));
	}
$connect->close();
}