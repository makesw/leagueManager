<?php
session_start();
if (! isset($_SESSION['dataSession'])) {
    header('Location: ../index.html');
} else {
    if ($_SESSION['dataSession']['perfil'] != 'admin') {
        header('Location: ../salir.php');
    }
}
require '../conexion.php';
$resultSedes = $connect->query("select * from sede order by nombre asc");
?>
<!--gx-wrapper-->
<div class="gx-wrapper">

	<div class="animated slideInUpTiny animation-duration-3">
		<div class="page-heading">
			<h2 class="title">Sedes</h2>
		</div>
		<button class="jr-btn btn-primary btn btn-default" data-toggle="modal"
			data-target="#modal-create-sede">Crear</button>
		<div class="row">
			<div class="col-lg-12">
				<div class="gx-card">
					<div class="gx-card-body">
						<div class="table-responsive">

							<table
								class="table table-striped table-bordered table-hover dataTables-sedes" id="tableSedes">
								<thead>
									<tr>
										<th>Nombre</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody>
									<?php

        
        while ($sede = mysqli_fetch_array($resultSedes)) {
            ?>
											<tr>										
										<td>
													<?php echo $sede['nombre']; ?>
												</td>
										<td><a title="Modificar"
											href="javaScript:editSede(<?php echo $sede['id']; ?>)"> <i
												class="zmdi zmdi-edit"></i>
										</a>  <a title="Borrar"
											href="javaScript:delSede('<?php echo $sede['id']; ?>');"> <i
												class="zmdi zmdi-delete"></i>
										</a></td>
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
<div id="modal-create-sede" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header border-0">
				<h2 class="modal-title" id="mySmallModalLabel">Crear Sede</h2>
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="formSede" method="post">
					<div class="panel-body">
						<div class="form-group">
							<label for="nombre">Nombre</label> <input type="text"
								id="nameSede"
								onblur="javascript:aMayusculas(this.value,this.id);"
								class="form-control" name="nombre" placeholder="nombre" required>
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
<div id="modal-edit-sede" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header border-0">
				<h2 class="modal-title" id="mySmallModalLabel">Editar Sede</h2>
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="formEditSede" method="post">
					<div class="panel-body">
						<div class="form-group">
							<label for="emailaddress">Nombre</label> <input type="text"
								class="form-control" id="nombreSede" name="nombreSede"
								placeholder="nombre" required
								onblur="javascript:aMayusculas(this.value,this.id);">
						</div>
						<button type="submit" class="btn btn-primary">Guardar</button>
					</div>
					<input type="hidden" id="btnhIdsede" name="btnhIdsede" value="" />
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
$( "#formSede" ).submit(function( event ) {
    event.preventDefault();
	$.ajax( {
		url: 'server.php?action=addSede',
		type: 'POST',
		data: new FormData( this ),
		success: function ( data ) {
			//console.log( data );
			$('#modal-create-sede').modal('hide');
			setTimeout(function(){											
				loadPage( 'sedes.php' );				
			},150);		
		},
		error: function ( data ) {
			//console.log( data );
		},
		cache: false,
		contentType: false,
		processData: false
	} );    
    return false;
});
function delSede( id ) {
	if ( confirm( 'Confirma Eliminar?' ) ) {
		$.ajax( {
			url: 'server.php?action=delSede&idSede=' + id,
			type: 'POST',
			data: new FormData(  ),
			success: function ( data ) {
				//console.log( data );						
				setTimeout(function(){
					loadPage( 'sedes.php' );
				},150);
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
function editSede( id ) {
	$.ajax( {
			url: 'server.php?action=getDataSede&idSede=' + id,
			type: 'POST',
			data: new FormData(  ),
			success: function ( data ) {
				//console.log(data);
				$("#nombreSede").val(data.nombre);
				$("#btnhIdsede").val(data.id);						
				$('#modal-edit-sede').modal('show');
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
$( "#formEditSede" ).submit(function( event ) {
	 event.preventDefault();	
	 $.ajax( {
		url: 'server.php?action=editSede',
		type: 'POST',
		data: new FormData( this ),
		success: function ( data ) {
			//console.log( data );
			$('#modal-edit-sede').modal('hide');
			setTimeout(function(){
				loadPage( 'sedes.php' );
			},150);
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
	
$(document).ready(function () {
	$('.dataTables-sedes').DataTable({
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
