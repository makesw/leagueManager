<?php
session_start();
if ( !isset( $_SESSION[ 'dataSession' ] ) ) {
    header( 'Location: ../../index.html' );
}else{
    if($_SESSION[ 'dataSession' ]['perfil'] != 'admin'){
        header( 'Location: ../../salir.php' );
    }
}
require '../../conexion.php';
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
$idgrupo = isset($_GET['idGrupo']);
$idfase = isset($_GET['idFase']);
$option = isset($_GET['option']);
$idComp = isset($_GET['idComp']);

if (! empty($option) && $option == 'toGroup') { // Pintar tabla con lista de equipos para agregar a grupo de fase
    $resultEquipos = $connect->query("select * from equipo e where e.id_competicion = " . $_GET['idComp'] . " and e.id not in (
    select id_equipo from grupo g join equipo_grupo eg on g.id = eg.id_grupo and g.id_fase = " . $idfase . ") order by e.nombre asc");
    ?>

<table
	class="table table-striped table-bordered table-hover dataTables-tableListEquipos">
	<thead>
		<tr>
			<th colspan="9"><strong>Listado Equipos</strong></th>
		</tr>
	</thead>
	<tbody>
			<?php  while($row = mysqli_fetch_array($resultEquipos)){ ?>
			<tr>
			<td><?php   echo $row['nombre']; ?></td>
			<td><input name="checkbox[]" type="checkbox" value="<?php   echo $row['id']; ?>"></td>
		</tr>
			<?php  } ?>
		</tbody>
</table>
<?php
}
?>