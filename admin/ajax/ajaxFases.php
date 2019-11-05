<?php
session_start();
if ( !isset( $_SESSION[ 'dataSession' ] ) ) {
    header( 'Location: ../index.html' );
}else{
    if($_SESSION[ 'dataSession' ]['perfil'] != 'admin'){
        header( 'Location: ../salir.php' );
    }
}
$arrayFases = array();
require '../conexion.php';
$resultFases = $connect->query( "select * from fase where activa =1 and id_competicion=".$_POST["elegido"] );
$options='<option value="-1">Seleccione una fase</option>';
while($row = mysqli_fetch_array($resultFases)){
	 $options .= '<option value="'.$row['id'].'">'.$row["nombre"].'</option>';
}
echo $options;
?>