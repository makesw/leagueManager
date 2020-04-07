<?php
$connect = new mysqli( 'localhost:3308', 'root', '', 'leaguemanager' );
if ( $connect->connect_errno ) {
	echo "Fallo al conectar a MySQL: (" . $connect->connect_errno . ") " . $connect->connect_error;
}
$connect->query( "SET NAMES 'utf8'" );
?>