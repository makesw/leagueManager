<?php
session_start();
if ( !isset( $_SESSION[ 'dataSession' ] ) ) {
    header( 'Location: ../index.html' );
}else{
    if($_SESSION[ 'dataSession' ]['perfil'] != 'admin'){
        header( 'Location: ../salir.php' );
    }
}
require '../conexion.php';
$resultTSuspencion = $connect->query( "select * from tipo_sancion order by nombre asc" );
?>
<!--gx-wrapper-->
<div class="gx-wrapper">

	<div class="animated slideInUpTiny animation-duration-3">
		<div class="page-heading">
			<h2 class="title">Tipos de Sanción</h2>
		</div>
		<button class="jr-btn btn-primary btn btn-default" data-toggle="modal"
			data-target="#modal-create-tsanc">Crear</button>
		<div class="row">
			<div class="col-lg-12">
				<div class="gx-card">
					<div class="gx-card-body">
						<div class="table-responsive">

							<table class="table table-striped table-bordered table-hover dataTables-tpsancion" >
									<thead>
											<tr>
												<th>#</th>
												<th>Nombre</th>
												<th>Puntos</th>
												<th>Fechas</th>
												<th>Valor</th>
												<th>Veta Jugador</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php $iter = 1;
									while($tSusp = mysqli_fetch_array($resultTSuspencion)){?>
											<tr>
												<td>
													<?php echo $iter; ?>
												</td>
												<td>
													<?php echo $tSusp['nombre']; ?>
												</td>
												<td>
													<?php echo $tSusp['puntos']; ?>
												</td>
												<td>
													<?php echo $tSusp['fechas_suspencion']; ?>
												</td>
												<td>
													<?php echo $tSusp['valor']; ?>
												</td>
												<td>
													<?php echo $tSusp['veta_jugador']==1?'SI':'NO'; ?>
												</td>
												<td>
												<a href="javaScript:editTsancion(<?php echo $tSusp['id']; ?>)">
												<i class="zmdi zmdi-edit"></i>
												</a>
												<a title="Borrar" href="javaScript:delTsanc('<?php echo $tSusp['id']; ?>');">
												<i class="zmdi zmdi-delete"></i>
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
		</div>
	</div>
</div>
<!--/gx-wrapper-->
<div id="modal-create-tsanc" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header border-0">
				<h2 class="modal-title" id="mySmallModalLabel">Crear Tipo de Sanción</h2>
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="formTsancion" method="post">
					<div class="panel-body">
						<div class="form-group">
							<label for="nombre">Nombre</label>
							<input type="text" class="form-control" name="nombre" placeholder="nombre" required id="tpSancionName" onblur="javascript:aMayusculas(this.value,this.id);">
							<label for="puntos">Puntos Negativos</label>
							<input type="number" max="0" class="form-control" value="0" name="puntos" placeholder="puntos" required>
							<label for="fechas">Fechas Suspención</label>
							<input type="number" min="0" class="form-control" value="0" name="fechas" placeholder="fechas" required>
							<label for="fechas">Valor $</label>
							<input type="number" min="0" class="form-control" name="valor" value="0" placeholder="valor" required>
							<label for="veta">Veta Jugador</label><br/>								
							<input type="checkbox" id="veta" name="veta">
						</div>
						<button type="submit" class="btn btn-primary">Guardar</button>
					</div>
				</form>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<div id="modal-edit-tsanc" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header border-0">
				<h2 class="modal-title" id="mySmallModalLabel">Editar Tipo de Sanción</h2>
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="formEditTsancion" method="post">
					<div class="panel-body">
						<div class="form-group">
							<label for="nombreEts">Nombre</label>
							<input type="text" class="form-control" name="nombreEts" id="nombreEts" placeholder="nombre" required onblur="javascript:aMayusculas(this.value,this.id);">
							<label for="puntosEts">Puntos Negativos</label>
							<input type="number" max="0" class="form-control" name="puntosEts" id="puntosEts" placeholder="puntos" required>
							<label for="fechasEts">Fechas Suspención</label>
							<input type="number" class="form-control" name="fechasEts" id="fechasEts"  placeholder="fechas" required>
							<label for="valorEts">Valor $</label>
							<input type="number" class="form-control" name="valorEts" id="valorEts" value="0" placeholder="valor" required>
							<label for="vetaEdit">Veta Jugador</label><br/>						
							<input type="checkbox" id="vetaEdit" name="vetaEdit">
						</div>
						<button type="submit" class="btn btn-primary">Guardar</button>
					</div>
					<input type="hidden" id="btnhIdEts" name="btnhIdEts" value="" />
				</form>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>		


<!--Datatables JQuery-->
<script src="../node_modules/datatables.net/js/jquery.dataTables.js"></script>
<script
	src="../node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>
<script src="../js/custom/data-tables.js"></script>
<script>
$( "#formTsancion" ).submit(function( event ) {
    event.preventDefault();
	$.ajax( {
		url: 'server.php?action=addTSancion',
		type: 'POST',
		data: new FormData( this ),
		success: function ( data ) {
			//console.log( data );
			$('#modal-create-tsanc').modal('hide');
			setTimeout(function(){
				loadPage( 'tipoSanciones.php' );
			},200);
		},
		error: function ( data ) {
			//console.log( data );
		},
		cache: false,
		contentType: false,
		processData: false
	} );
	return false;
} );
function editTsancion( id ) {
	$.ajax( {
			url: 'server.php?action=getDataTsancion&id=' + id,
			type: 'POST',
			data: new FormData(  ),
			success: function ( data ) {
				//console.log(data);
				$("#nombreEts").val(data.nombre);
				$("#puntosEts").val(data.puntos);
				$("#fechasEts").val(data.fechas_suspencion);
				$("#valorEts").val(data.valor);
				$("#btnhIdEts").val(data.id);
				if(data.beta_jugador==1){
					$("#vetaEdit").prop("checked", true);
				}else{
					$("#vetaEdit").prop("checked", false);
				}
				$('#modal-edit-tsanc').modal('show');
			},
			error: function ( data ) {
				//console.log( data );
			},
			cache: false,
			contentType: false,
			processData: false
		} );
	return false;
}
$( "#formEditTsancion" ).submit(function( event ) {
	event.preventDefault();
	$.ajax( {
		url: 'server.php?action=editTSancion',
		type: 'POST',
		data: new FormData( this ),
		success: function ( data ) {
			console.log( data );
			$('#modal-edit-tsanc').modal('hide');
			setTimeout(function(){
				loadPage( 'tipoSanciones.php' );
			},200);
		},
		error: function ( data ) {
			console.log( data );
		},
		cache: false,
		contentType: false,
		processData: false
	} );
	return false;
} );
	
function delTsanc( id ) {
	if ( confirm( 'Confirma Eliminar?' ) ) {
		$.ajax( {
			url: 'server.php?action=delTsanc&id=' + id,
			type: 'POST',
			data: new FormData(  ),
			success: function ( data ) {
				//console.log( data );
				loadPage( 'tipoSanciones.php' );
			},
			error: function ( data ) {
				//console.log( data );
			},
			cache: false,
			contentType: false,
			processData: false
		} );
	}
	return false;
}		
	
$(document).ready(function () {
	$('.dataTables-tpsancion').DataTable({
		"searching": true,
		"bLengthChange": false,
		"bInfo": false,
		"pageLength": 10
	});
});
	
function aMayusculas(obj,id){
	obj = obj.toUpperCase();
	document.getElementById(id).value = obj;
}
</script>
<?php $connect->close(); ?>