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
$id = $_GET['idFase'];
$resultGrupos = $connect->query("select g.* from grupo g JOIN fase f ON g.id_fase = f.id AND f.id = " . $id . " order by nombre asc");
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
?>
<?php
$iter = 1;
while ($row = mysqli_fetch_array($resultGrupos)) {
    ?>

<div class="col-sm-6 col-12">
	<div class="card">
		<div class="card-header bg-primary text-white"><?php echo($row['nombre']) ?></div>
		<div class="card-body">			
			<button class="jr-btn btn-primary btn btn-default" onClick="javascript:addEquToGru('<?php echo $row['id']; ?>')">Agregar Equipos</button>
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover dataTables-grupos-<?php echo $row['id']; ?>" >
					<thead>
						<tr>
							<th>#</th>
							<th>Nombre</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php $iter = 1;
						$resultEquipoGrupo = $connect->query('select eg.*, e.nombre from equipo_grupo eg JOIN equipo e ON eg.id_equipo = e.id and eg.id_grupo = '.$row['id'].' order by e.nombre asc');
						while($rowEquiGru = mysqli_fetch_array($resultEquipoGrupo)){?>
								<tr>
									<td>
										<?php echo $iter; ?>
									</td>
									<td>
										<?php echo $rowEquiGru['nombre']; ?>
									</td>									
									<td>									
									<a title="Borrar" href="javaScript:delEquiGru('<?php echo $rowEquiGru['id']; ?>');">
									<i class="zmdi zmdi-close zmdi-hc-2x text-red"></i>
									</a>												
									</td>
								</tr>
								<?php $iter++; } ?>
					</tbody>
				</table>
			</div>		
		</div>		
	</div>
</div>
<script type="text/javascript">
$(document).ready(function () {
	$('.dataTables-grupos-<?php echo $row['id']; ?>').DataTable({
		"searching": false,
		"bLengthChange": false,
		"ordering": false,
		"bInfo": false,
		"pageLength": 10
	});
});
</script>
<?php $iter++; } ?>
<?php $connect->close(); ?>