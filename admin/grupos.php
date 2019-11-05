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

$resultGrupos = $connect->query( "select g.*,f.id idFase, f.nombre nombreFase, c.id idCompeticion, c.nombre nombreCompeticion from grupo g JOIN fase f ON g.id_fase = f.id AND f.activa = 1 JOIN competicion c ON f.id_competicion = c.id AND c.activa = 1" );

header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
?>
<!--gx-wrapper-->
<div class="gx-wrapper">

	<div class="animated slideInUpTiny animation-duration-3">
		<div class="page-heading">
			<h2 class="title">Grupos</h2>
		</div>
		<button class="jr-btn btn-primary btn btn-default" data-toggle="modal"
			data-target="#modal-grupo">Crear</button>
		<div class="row">
			<div class="col-lg-12">
				<div class="gx-card">
					<div class="gx-card-body">
						<div class="table-responsive">
							<table class="table table-bordered table-hover dataTables-comp">
								<thead>
											<tr>
												<th>Nombre</th>
												<th>Clasifican</th>
												<th>Fase</th>
												<th>Competición</th>												
												<th></th>
											</tr>
										</thead>
									<tbody>
											<?php $iter = 1;
											while($row = mysqli_fetch_array($resultGrupos)){?>
											<tr>												
												<td>
													<?php echo $row['nombre']; ?>
												</td>
												<td>
													<?php echo $row['clasifican']; ?>
												</td>
												<td>
													<?php echo $row['nombreFase']; ?>
												</td>		
												<td>
													<?php echo $row['nombreCompeticion']; ?>
												</td>	
												<td>
												<a href="javaScript:editGrupo(<?php echo $row['id']; ?>, <?php echo $row['idFase']; ?>)">
												<i class="zmdi zmdi-edit zmdi-hc-2x"></i>
												</a>
												<a title="Borrar" href="javaScript:delGrupo('<?php echo $row['id']; ?>');">
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
<div id="modal-grupo" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header border-0">
				<h2 class="modal-title" id="mySmallModalLabel">Grupo</h2>
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="formCreateGrupo" method="post"> 
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
						<label for="nombre">Fase</label> 
						
							<select class="form-control" required id="cmbFase" name="cmbFase">							 
							</select>
						 
					</div> 
					<div class="form-group"> 
						<label for="nombre">Nombre</label> 
						 
							<input type="text" onblur="javascript:aMayusculas(this.value,this.id);" placeholder="Nombre" id="nombre" name="nombre" class="form-control">
						 
					</div>
					<div class="form-group"> 
						<label for="nombre">Clasifican</label> 
						 
							<input type="text" placeholder="Clasifican" id="clasi" name="clasi" class="form-control" maxlength="2" size="10">
						 
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
<?php $connect->close(); ?>
<script>
$(document).ready(function () {
$('.dataTables-comp').DataTable({	
	"searching": true,
	"bSort" : true,
	"bLengthChange": false,
	"bInfo": false,
	"pageLength": 20
});
});
	
$( "#formCreateGrupo" ).submit(function( event ) {
    event.preventDefault();
	$.ajax( {
		url: 'server.php?action=addUpdGrupo',
		type: 'POST',
		data: new FormData( this ),
		success: function ( data ) {
			//console.log( data );
			$('#modal-grupo').modal('hide');
			setTimeout(function(){											
				loadPage( 'grupos.php' );				
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
function editGrupo( id, idFase ) {
	$.ajax( {
			url: 'server.php?action=getDataGrupo&id=' + id,
			type: 'POST',
			data: new FormData(  ),
			success: function ( data ) {
				//console.log(data);
				$("#bthAction").val(2);
				$("#bthValId").val(data.id);
				$("#nombre").val(data.nombre);
				$("#clasi").val(data.clasifican);
				$("#cmbComp" ).val(data.id_competicion);
				elegido=$("#cmbComp" ).val();
				$.post("./ajax/ajaxFases.php", { elegido: elegido }, function(data){
            		$("#cmbFase").html(data);
					$("#cmbFase" ).val(idFase);
				});     				
        		$('#modal-grupo').modal('show');
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
function delGrupo( id ) {
	if ( confirm( 'Confirma Eliminar?' ) ) {
		$.ajax( {
			url: 'server.php?action=delGrupo&id=' + id,
			type: 'POST',
			data: new FormData(  ),
			success: function ( data ) {
				//console.log( data );
				loadPage( 'grupos.php' );
			},
			error: function ( data ) {
				//console.log( data );
			},
			cache: false,
			contentType: false,
			processData: false
		} );
	}
}
$(document).ready(function(){
   $("#cmbComp").change(function () {
   		$("#cmbComp option:selected").each(function () {
            elegido=$(this).val();
            $.post("./ajax/ajaxFases.php", { elegido: elegido }, function(data){
           	 $("#cmbFase").html(data);
            });            
        });
   })
});
function aMayusculas(obj,id){
    obj = obj.toUpperCase();
    document.getElementById(id).value = obj;
}
</script>