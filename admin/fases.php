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
$resultCompetencias = $connect->query( "select * from competicion WHERE activa=1  order by nombre asc" );
$resultFases = $connect->query( "select f.*,c.nombre nombreCompeticion from fase f JOIN competicion c ON f.id_competicion = c.id and c.activa=1 order by c.nombre asc, f.numero asc" );


header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
?>

<!--gx-wrapper-->
<div class="gx-wrapper">

	<div class="animated slideInUpTiny animation-duration-3">
		<div class="page-heading">
			<h2 class="title">Fases</h2>
		</div>
		<button class="jr-btn btn-primary btn btn-default" data-toggle="modal"
			data-target="#modal-fase" onclick="javascript:clearForm();">Crear</button>
		<div class="row">
			<div class="col-lg-12">
				<div class="gx-card">
					<div class="gx-card-body">
						<div class="table-responsive">
							<table class="table table-bordered table-hover dataTables-fases">
								<thead>
											<tr>
												<th>Orden</th>
												<th>Nombre</th>
												<th>Activa</th>
												<th>Competición</th>												
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php $iter = 1;
											while($row = mysqli_fetch_array($resultFases)){?>
											<tr>												
												<td>
													<?php echo $row['numero']; ?>
												</td>
												<td>
													<?php echo $row['nombre']; ?>
												</td>
												<td>
													<?php echo $row['activa']==1?'SI':'NO'; ?>
												</td>													
												<td>
													<?php echo $row['nombreCompeticion']; ?>
												</td>	
												<td>
												<a href="javaScript:editFase(<?php echo $row['id']; ?>)">
												<i class="zmdi zmdi-edit zmdi-hc-2x"></i>
												</a>
												<a title="Borrar" href="javaScript:delFase('<?php echo $row['id']; ?>');">
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
		</div>
	</div>
</div>
<!--/gx-wrapper-->
<div id="modal-fase" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header border-0">
				<h2 class="modal-title" id="mySmallModalLabel">Fase</h2>
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="formCreateFase" method="post"> 
					<div class="form-group"> 
							<label for="nombre">Competición</label>
								<select class="form-control" required id="cmbComp" name="cmbComp"> 
									<option value="">Seleccione una competencia</option><?php
									while ( $row = mysqli_fetch_array( $resultCompetencias ) ) {
										echo "<option value='" . $row[ 'id' ] . "'>" . $row[ 'nombre' ] . "</option>";
									}
									?> 
								</select>
						</div> 
						<div class="form-group"> 
							<label for="nombre">Nombre</label> 
							 
								<input type="text" onblur="javascript:aMayusculas(this.value,this.id);" placeholder="Nombre" id="nombre" name="nombre" class="form-control">
							 
						</div>
						<div class="form-group"> 
								<label for="activa">Activa</label> 
								<div class="col-sm-10">
									<input type="checkbox" id="activa" name="activa" checked>
								 </div> 
							</div>																		
						<div class="form-group"> 
							<div class="col-sm-offset-2 col-sm-10"> 
								<button type="submit" class="btn btn-primary">Guardar</button> 
							</div> 
						</div> 
						<input type="hidden" id="bthAction" name="bthAction" value="1" />
						<input type="hidden" id="bthValId" name="bthValId" value="" />
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
$(document).ready(function () {
$('.dataTables-fases').DataTable({	
	"bLengthChange": false,
	"bInfo": false,
	"bSort" : false,
	"pageLength": 10
});
});
	
$( "#formCreateFase" ).submit(function( event ) {
	event.preventDefault();
	$.ajax( {
		url: 'server.php?action=addUpdFase',
		type: 'POST',
		data: new FormData( this ),
		success: function ( data ) {
			//console.log( data );
			$('#modal-fase').modal('hide');
			setTimeout(function(){											
				loadPage( 'fases.php' );				
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
function editFase( id ) {
	$.ajax( {
			url: 'server.php?action=getDataFase&id=' + id,
			type: 'POST',
			data: new FormData(  ),
			success: function ( data ) {
				//console.log(data);
				$("#bthAction").val(2);
				$("#bthValId").val(data.id);
				$("#nombre").val(data.nombre);
				$("#numero").val(data.numero);
				if(data.activa == 1){
					$("#activa").prop("checked", true);
				}else{
					$("#activa").prop("checked", false);
				}		
				$( "#cmbComp" ).val(data.id_competicion);
				$('#modal-fase').modal('show');
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
function delFase( id ) {
	if ( confirm( 'Confirma Eliminar?' ) ) {
		$.ajax( {
			url: 'server.php?action=delFase&id=' + id,
			type: 'POST',
			data: new FormData(  ),
			success: function ( data ) {
				//console.log( data );											
				loadPage( 'fases.php' );
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
function aMayusculas(obj,id){
    obj = obj.toUpperCase();
    document.getElementById(id).value = obj;
}
function clearForm(){
	$("#bthAction").val(1);
	$("#nombre").val(null);
	$("#activa").prop("checked", false);	
}
</script>
<?php $connect->close(); ?>
