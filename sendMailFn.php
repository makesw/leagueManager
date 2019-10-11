<?php 

function sendMailUser( $emailUser ){	
	require 'conexion.php';	
	require 'constants.php';	
	$usuario = mysqli_fetch_array( $connect->query("SELECT u.correo, u.password, u.nombres, u.apellidos FROM usuario u WHERE u.correo = '".$emailUser."'") );	
	if($usuario != NULL && isset($usuario['correo'])){
		$subject = 'Datos de Usuario';
		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html" . "\r\n";
		$headers .= "From: ".$correoUsuarios." \r\n";
		$message = '
		<!doctype html>
		<html>
		<head>
		<meta charset="utf-8">
		<title>Datos de Acceso</title>
		</head>
		<body style="background-color: white; font-family: Helvetica Neue,Helvetica,Arial,sans-serif">
			<center>
			<div id="body" style="text-align: left;border-radius: 3px;color: black;
			font-size: 16px;max-width: 94%;margin-top: 40px; height: 400px; width: 420px; background-color: white;">
				<div style="margin-left: 10px;">
				<p style="margin-top: 20px;"><strong>
				<img src="https://www.copaemprendedores.com/wp-content/uploads/2013/01/logo-copa-emprendedores.png">
				<br/><br/>Datos de Usuario</strong>,<br/><br/>
				Estimado usuario: <strong>'.$usuario['nombres'].' '.$usuario['apellidos'].'</strong> estos son los nuevos datos para acceso a tu cuenta en: '.$RAIZ.'ligacp/
				<strong><br/><br/>Correo: '.$usuario['correo'].'<br/></strong>
				<strong><br/><br/>Contraseña: '.$usuario['password'].'<br/></strong>
				<br/>
				Cordialmente, 
				<br/>
				'.$RAIZ.'
				</p><br/>
				</div>				
			</div>
			</center>
		</body>
		</html>';
			
	mail($usuario['correo'],$subject,$message,$headers);	
	$connect->close();
	}
}
function sendMailProgram( $emailUser, $fnameUSer,$lNameUser, $team1, $team2, $hour, $date, $sede, $escena ){
	require 'constants.php';	
	if($emailUser != NULL){
		$subject = 'Próximo Juego';
		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html" . "\r\n";
		$headers .= "From: ".$correoProg." \r\n";
		$message = '
		<!doctype html>
		<html>
		<head>
		<meta charset="utf-8">
		<title>Programación Próximo Juego</title>
		</head>
		<body style="background-color: white; font-family: Helvetica Neue,Helvetica,Arial,sans-serif">
			<center>
			<div id="body" style="text-align: left;border-radius: 3px;color: darkgray;
			font-size: 16px;max-width: 94%;margin-top: 40px; height: 400px; width: 420px; background-color: white;">
				<div style="margin-left: 10px;">
				<p style="margin-top: 20px;    color: #504f4f;"><strong>
				<img src="https://www.copaemprendedores.com/wp-content/uploads/2013/01/logo-copa-emprendedores.png">
				<br/><br/>Programación Próxima Fecha</strong>,<br>
				<br/>Estimado usuario: <strong>'.$fnameUSer.' '.$lNameUser.'</strong> Se ha programado un nuevo juego, para validar la información ingresa a: '.$RAIZ.'.
				<strong><br/><br/>'.$team1.' Vs '.$team2.'<br/></strong>
				<strong><br/>Hora: '.$hour.'<br/></strong>
				<strong><br/>Fecha: '.$date.'<br/></strong>
				<strong><br/>Sede: '.$sede.'<br/></strong>
				<strong><br/>Escenario: '.$escena.'<br/></strong>
				<br/>
				Cordialmente, 
				<br/>
				'.$RAIZ.'
				</p><br/>
				</div>				
			</div>
			</center>
		</body>
		</html>';
			
	mail($emailUser,$subject,$message,$headers);	
	}
}
?>