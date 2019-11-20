<?php
session_start();
if (! isset($_SESSION['dataSession'])) {
    header('Location: ../../index.html');
} else {
    if ($_SESSION['dataSession']['perfil'] != 'admin') {
        header('Location: ../../salir.php');
    }
}
require '../../conexion.php';
$idFase = $_GET['idFase'];
$idComp = isset($_GET['idComp']) ? $_GET['idComp'] : null;
$totalGen = null;
$jornada = isset($_GET['jornada']) ? $_GET['jornada'] : 0;
$resultGrupos = $connect->query("select g.* from grupo g JOIN fase f ON g.id_fase = f.id AND f.id = " . $idFase . " order by id asc");
setlocale(LC_TIME, "spanish");
date_default_timezone_set('America/Bogota');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');

?>
<?php
?>
<div class="form-group">
<label for="cmbAcciones">Acciones:</label>
<select class="form-control" required id="cmbAcciones" name="cmbAcciones">
	<option value="" onClick="javascript:genGames(<?php echo $idFase;?>,'ida');">Generar Juegos - Solo Ida</option>
	<option value="" onClick="javascript:genGames(<?php echo $idFase;?>,'idaVuelta');">Generar Juegos - Ida y Vuelta</option>
	<option value="" onClick="javascript:fnAddJuego(<?php echo $idComp;?>);">Agragar Juego Manual</option>
	<option value="" onClick="javascript:delJuegos(<?php echo $idFase;?>);">Borrar Todos los Juegos</option>
</select>
<div class="form-group">
<div class="table-responsive">
	<table
		class="table table-striped table-bordered table-hover dataTables-juegos">
		<thead>
			<tr>
				<th>#</th>
				<th>GRUPO</th>
				<th>JORNADA</th>
				<th>LOCAL</th>
				<th></th>
				<th>VISITANTE</th>
				<th>HORA INICIO</th>
				<th>HORA FIN</th>
				<th>ESCENARIO</th>
				<th>FECHA</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
<?php
$iter = 1;
while ($row = mysqli_fetch_array($resultGrupos)) {
    ?>
	<?php
    $resultJuegos;
    if ($jornada == 0) {
        $resultJuegos = $connect->query("select j.*, e.nombre nombreEscena from juego j JOIN equipo_grupo eg ON eg.id_equipo =  j.id_equipo_1 and j.id_fase = " . $idFase . " AND j.tipo='OFICIAL' JOIN grupo g ON eg.id_grupo = g.id AND g.id = " . $row['id'] . " LEFT JOIN escenario e ON j.id_escenario = e.id order by g.nombre asc, j.jornada asc");
    } else {
        $resultJuegos = $connect->query("select j.*, e.nombre nombreEscena from juego j JOIN equipo_grupo eg ON eg.id_equipo =  j.id_equipo_1 and j.id_fase = " . $idFase . " AND j.tipo='OFICIAL' and j.jornada =" . $jornada . " JOIN grupo g ON eg.id_grupo = g.id AND g.id = " . $row['id'] . " LEFT JOIN escenario e ON j.id_escenario = e.id order by g.nombre asc, j.jornada asc");
    }
    while ($rowJuego = mysqli_fetch_array($resultJuegos)) {
        $date_a = "";
        if (! empty($rowJuego['fecha'])) {
            $date_a = new DateTime($rowJuego['fecha']);
            $date_a = $date_a->format('Y-m-d');
        }
        ?>
		<tr>
				<td>
				<?php echo $iter; ?>
			</td>
				<td>
				<?php echo $row['nombre']; ?>
			</td>
				<td>
				<?php echo $rowJuego['jornada']; ?>
			</td>
				<td>
				<?php echo $rowJuego['nombre1']; ?>
			</td>
				<td>Vs</td>
				<td>
				<?php echo $rowJuego['nombre2']; ?>
			</td>
				<td>
				<?php
        echo $rowJuego['aplazado'] == 1 ? 'APLAZADO' : $rowJuego['hora_inicio'];
        ?>				  
			</td>
				<td>
				<?php echo $rowJuego['hora_fin']; ?>
			</td>
				<td>
				<?php echo $rowJuego['nombreEscena']; ?>
			</td>
				<td>
				<?php echo $date_a; ?>
			</td>
				<!--td>
				<button class="btn btn-success btn-outline" type="button" onClick="javascript:fnProgramar(<?php echo $rowJuego['id']; ?>,'<?php echo $rowJuego['nombre1']; ?>','<?php echo $rowJuego['nombre2']; ?>');">Programar</button>
				<button class="btn btn-warning btn-outline" type="button" onClick="javascript:fnClearProg(<?php echo $rowJuego['id']; ?>);">Limpiar</button>
				<a title="Borrar" href="javaScript:delGame('<?php echo $rowJuego['id']; ?>');">
					<i class="icon-cancel icon-larger red-color"></i>
				</a>
			</td -->
				<td>
					<div class="btn-group">
						<button type="button" class="btn btn-default dropdown-toggle"
							data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Acciones <span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li><a
								href="javascript:fnProgramar(<?php echo $rowJuego['id']; ?>,'<?php echo $rowJuego['nombre1']; ?>','<?php echo $rowJuego['nombre2']; ?>');">Programar</a></li>
							<li><a
								href="javascript:fnAplazar(<?php echo $rowJuego['id']; ?>);">Aplazar</a></li>
							<li><a
								href="javascript:fnClearProg(<?php echo $rowJuego['id']; ?>);">Limpiar
									Progrmación</a></li>
							<li><a
								href="javaScript:delGame('<?php echo $rowJuego['id']; ?>');">Eliminar
									Juego</a></li>
						</ul>
					</div>
				</td>
			</tr>
<?php $iter++; } } ?>
</tbody>
	</table>
</div>
<script>
$(document).ready(function () {
$('.dataTables-juegos').DataTable({
	"searching": true,
	"bSort" : false,
	"bLengthChange": false,
	"bInfo": false,
	"pageLength": 20,
	"oLanguage": {
	   "sSearch": "Buscar: "
	 },
	 "language": {
	      "emptyTable": "No hay datos"
	    }
});
});
</script>
<?php $connect->close(); ?>