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
$resultEscena = $connect->query( "select e.*,s.nombre nombreSede from escenario e JOIN sede s ON e.id_sede = s.id" );
$resultSedesSelect = $connect->query( "select * from sede order by nombre asc" );
$resultSedesSelect2 = $connect->query( "select * from sede order by nombre asc" );
?>
<!--gx-wrapper-->
<div class="gx-wrapper">

	<div class="animated slideInUpTiny animation-duration-3">
		<div class="page-heading">
			<h2 class="title">Escenarios</h2>
		</div>
		<button class="jr-btn btn-primary btn btn-default" data-toggle="modal"
			data-target="#modal-create-escena">Crear</button>
		<div class="row">
			<div class="col-lg-12">
				<div class="gx-card">
					<div class="gx-card-body">
						<div class="table-responsive">

							<table class="table table-striped table-bordered table-hover dataTables-escena" >
									<thead>
											<tr>
												<th>Nombre</th>
												<th>Sede</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php
											while($escena = mysqli_fetch_array($resultEscena)){?>
											<tr>
												<td>
													<?php echo $escena['nombre']; ?>
												</td>
												<td>
													<?php echo $escena['nombreSede']; ?>
												</td>
												<td>
												<a href="javaScript:editEscena(<?php echo $escena['id']; ?>)">
												<i class="zmdi zmdi-edit zmdi-hc-2x"></i>
												</a>
												<a title="Borrar" href="javaScript:delEscena('<?php echo $escena['id']; ?>');">
												<i class="zmdi zmdi-close zmdi-hc-2x text-red"></i>
												</a>												
												</td>
											</tr>
											<?php } ?>
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
<div id="modal-create-escena" class="modal fade" tabindex="-1" 	role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header border-0">
				<h2 class="modal-title" id="mySmallModalLabel">Crear Escenario</h2>
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
				<div class="modal-body">
					<form id="formEscena" method="post">
						<div class="panel-body">
							<div class="form-group">
								<label for="nameSede">Sede</label>
								<select class="form-control" id="sedeSelectId" name="sedeSelectId" required>
									<?php									
									while($selectSedes = mysqli_fetch_array($resultSedesSelect)){?>	 
										<option value="<?php echo $selectSedes['id'];?>"><?php echo $selectSedes['nombre'];?></option>
									<?php } ?>	
								</select>
								<label for="nombre">Nombre</label>
								<input type="text" onblur="javascript:aMayusculas(this.value,this.id);" class="form-control" id="nombreSede" name="nombre" placeholder="nombre" required onblur="javascript:aMayusculas(this.value,this.id);">
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
	<div id="modal-edit-escena" class="modal fade" tabindex="-1" 	role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header border-0">
				<h2 class="modal-title" id="mySmallModalLabel">Editar Escenario</h2>
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
				<div class="modal-body">
					<form id="formEditEscena" method="post">
						<div class="panel-body">
							<div class="form-group" id="divEscena">
								<label for="nameSede">Sede</label>
								<div class="id_100">
								<select class="form-control" id="sedeSelectId" name="sedeSelectId" required>
									<?php
									while($xxx = mysqli_fetch_array($resultSedesSelect2)){?>	 
										<option value="<?php echo $xxx['id'];?>"><?php echo $xxx['nombre'];?></option>
									<?php } ?>	
									</select>
								</div>
								<label for="emailaddress">Nombre</label>
								<input type="text" class="form-control" id="nombreEscena" name="nombreEscena" placeholder="nombre" required onblur="javascript:aMayusculas(this.value,this.id);">
							</div>
							<button type="submit" class="btn btn-primary">Guardar</button>
						</div>
						<input type="hidden" id="btnhIdEscena" name="btnhIdEscena" value="" />
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
$( "#formEscena" ).submit(function( event ) {
	event.preventDefault();
	$.ajax( {
		url: 'server.php?action=addEscena',
		type: 'POST',
		data: new FormData( this ),
		success: function ( data ) {
			//console.log( data );
			$('#modal-create-escena').modal('hide');
			setTimeout(function(){
				loadPage( 'escenarios.php' );
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
function editEscena( id ) {
	$.ajax( {
			url: 'server.php?action=getDataEscena&id=' + id,
			type: 'POST',
			data: new FormData(  ),
			success: function ( data ) {
				//console.log(data);
				$("#nombreEscena").val(data.nombre);
				$("#btnhIdEscena").val(data.id);
				$("div.id_100 select").val(data.id_sede);
				$('#modal-edit-escena').modal('show');
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
$( "#formEditEscena" ).submit(function( event ) {
	event.preventDefault();
	$.ajax( {
		url: 'server.php?action=editEscena',
		type: 'POST',
		data: new FormData( this ),
		success: function ( data ) {
			//console.log( data );
			$('#modal-edit-escena').modal('hide');
			setTimeout(function(){
				loadPage( 'escenarios.php' );
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
function delEscena( id ) {
	if ( confirm( 'Confirma Eliminar?' ) ) {
		$.ajax( {
			url: 'server.php?action=delEscena&id=' + id,
			type: 'POST',
			data: new FormData(  ),
			success: function ( data ) {
				//console.log( data );
				loadPage( 'escenarios.php' );
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
	$('.dataTables-escena').DataTable({
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