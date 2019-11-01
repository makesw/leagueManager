<?php
session_start();
if ( !isset( $_SESSION[ 'dataSession' ] ) ) {
    header( 'Location: ../index.html' );
}else{
    if($_SESSION[ 'dataSession' ]['perfil'] != 'admin'){
        header( 'Location: ../salir.php' );
    }
}
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
require '../conexion.php';
//las del ultimo año:
$resultCompetencias = $connect->query( "select * from competicion WHERE  now() <= ADDDATE(DATE(fecha_creacion), interval 1  YEAR) order by fecha_creacion desc,nombre asc" );
?>
<!--gx-wrapper-->
<div class="gx-wrapper">

	<div class="animated slideInUpTiny animation-duration-3">
		<div class="page-heading">
			<h2 class="title">Competiciones</h2>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="gx-card">
					<div class="gx-card-body">
					
						<div class="table-responsive">
									<table class="table table-bordered table-hover dataTables-comp" >
										<thead>
											<tr>
												<th>Código</th>
												<th>Nombre</th>
												<th># Jug. x Equipo</th>
												<th>Fech. Max. Mod. Planilla</th>
												<th>Valor Inscripción</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php
											while($row = mysqli_fetch_array($resultCompetencias)){
											    $date_aux = null;
											    if(!empty($row["fech_max_pla"])){
											        $date_aux = new DateTime($row["fech_max_pla"]);
											    }
											?>
											<tr>												
												<td>
													<?php echo $row['id']; ?>
												</td>
												<td>
													<?php echo $row['nombre']; ?>
												</td>
												<td>
													<?php echo $row['nummxjug']; ?>
												</td>
												<td>
													<?php if(!empty($date_aux)){echo $date_aux->format('d-m-Y');} ?>
												</td>														
												<td>
													<?php echo $row['valor']; ?>
												</td>
												<td>
												<a href="javaScript:editComp(<?php echo $row['id']; ?>)">
												<i class="fa fa-edit"></i>
												</a>
												<a title="Borrar" href="javaScript:delComp('<?php echo $row['id']; ?>');">
												<i class="icon-cancel icon-larger red-color"></i>
												</a>
												<a title="Borrar" href="javaScript:verDetalleComp('<?php echo $row['id']; ?>');">
													<button class="btn btn-link" type="button">Más Detalle</button>			
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
<div id="modal-comp" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Competición</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="formCreateComp" method="post"> 
						 	<div class="form-group"> 
								<label class="col-sm-2 control-label" for="nombre">Nombre</label> 
								<div class="col-sm-10"> 
									<input type="text" onblur="javascript:aMayusculas(this.value,this.id);" placeholder="Nombre" id="nombre" name="nombre" class="form-control">
								 </div> 
							</div> 
							<div class="form-group"> 
								<label class="col-sm-2 control-label" for="puntosp">Activa</label> 
								<div class="col-sm-10">
									<input type="checkbox" id="activa" name="activa">
								 </div> 
							</div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label" for="puntosp">Inscripción Activa</label> 
								<div class="col-sm-10">
									<input type="checkbox" id="inscripcion" name="inscripcion">
								 </div> 
							</div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label" for="puntosp">Puntos Ganador</label> 
								<div class="col-sm-10">
									<input type="text" placeholder="Puntos Ganador" value="3" id="puntosg" name="puntosg" class="form-control">
								 </div> 
							</div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label" for="puntosp">Puntos Perdedor</label> 
								<div class="col-sm-10">
									<input type="text" placeholder="Puntos Perdedor" value="0" id="puntosp" name="puntosp" class="form-control">
								 </div> 
							</div> 
							<div class="form-group"> 
								<label class="col-sm-2 control-label" for="puntosp">Puntos Empate</label> 
								<div class="col-sm-10">
									<input type="text" placeholder="Puntos Empate" value="1" id="puntose" name="puntose" class="form-control">
								 </div> 
							</div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label" for="puntosp" title="Valor Iscripción Competencia">$ Valor</label> 
								<div class="col-sm-10">
									<input type="text" placeholder="Valor" value="0" id="valor" name="valor" class="form-control">
								 </div> 
							</div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label" for="maxJug"># Max. Jugadores</label> 
								<div class="col-sm-10">
									<input type="number" placeholder="# Max. Jugadores x equipo" id="maxJug" name="maxJug" class="form-control" min="0" max="100">
								 </div> 
							</div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label" for="maxFech">Fecha Max. Modif. Planilla</label> 
								<div class="col-sm-10">
									<input type="date" name="fechaMax" id="fechaMax" required>
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

<div id="modal-comp-det" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Detalle Competición</h4>
			</div>
			<div class="modal-body">
						 <form class="form-horizontal" id="a" method="post"> 	
							<div class="form-group"> 
								<label class="col-sm-2 control-label" for="activaDet">Activa</label> 
								<div class="col-sm-10">
									<input type="checkbox" id="activaDet" name="activaDet" disabled="disabled">
								 </div> 
							</div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label" for="inscripcionDet">Inscripción Activa</label> 
								<div class="col-sm-10">
									<input type="checkbox" id="inscripcionDet" name="inscripcionDet" disabled="disabled">
								 </div> 
							</div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label" for="puntosgDet">Puntos Ganador</label> 
								<div class="col-sm-10">
									<input type="text" placeholder="Puntos Ganador" value="3" id="puntosgDet" name="puntosgDet" class="form-control" disabled>
								 </div> 
							</div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label" for="puntospDet">Puntos Perdedor</label> 
								<div class="col-sm-10">
									<input type="text" placeholder="Puntos Ganador" value="3" id="puntospDet" name="puntospDet" class="form-control" disabled>
								 </div> 
							</div> 
							<div class="form-group"> 
								<label class="col-sm-2 control-label" for="puntoseDet">Puntos Empate</label> 
								<div class="col-sm-10">
									<input type="text" placeholder="Puntos Ganador" value="3" id="puntoseDet" name="puntoseDet" class="form-control" disabled>
								 </div> 
							</div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label" for="feCreacionDet">Fecha Creación</label> 
								<div class="col-sm-10">
									<input type="text"  id="feCreacionDet" name="feCreacionDet" class="form-control">
								 </div> 
							</div>
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
$('.dataTables-comp').DataTable({
	"searching": true,
	"bLengthChange": false,
	"bInfo": false,
	"pageLength": 5
});
});
	
jQuery( document ).on( 'submit', '#formCreateComp', function ( event ) {
	$.ajax( {
		url: 'server.php?action=addUpdComp',
		type: 'POST',
		data: new FormData( this ),
		success: function ( data ) {
			//console.log( data );
			location.href = './competicion.php';
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
function editComp( id ) {
	var formData = new FormData();
	$.ajax( {
			url: 'server.php?action=getDataComp&id=' + id,
			type: 'POST',
			data: formData,
			success: function ( data ) {
				//console.log(data);
				$("#bthAction").val(2);
				$("#bthValId").val(data.id);
				$("#nombre").val(data.nombre);
				$("#puntosg").val(data.puntos_ganador);
				$("#puntosp").val(data.puntos_perdedor);
				$("#puntose").val(data.puntos_empate);
				$("#valor").val(data.valor);
				$("#maxJug").val(data.nummxjug);
				var formatFecha;
				if(data.fech_max_pla!=null){
					var fechaMax = new Date(data.fech_max_pla);
					var mes = ''+fechaMax.getMonth(); 
					if(mes<10){mes='0'+(fechaMax.getMonth()+1);}else{mes=''+(fechaMax.getMonth()+1);}
					var dia = ''+fechaMax.getDate(); 
					if(dia<10){dia='0'+fechaMax.getDate();}else{dia=''+(fechaMax.getDate());}
					formatFecha = fechaMax.getFullYear()+'-'+mes+'-'+dia;
				}
				$("#fechaMax").val(formatFecha);
				if(data.activa == 1){
					$("#activa").prop("checked", true);
				}else{
					$("#activa").prop("checked", false);
				}
				if(data.habilitar_inscripciones == 1){
					$("#inscripcion").prop("checked", true);
				}else{
					$("#inscripcion").prop("checked", false);
				}
				if(data.id_parent != null){
					$("#cmbComp").val(data.id_parent);
				}else{
					$("#cmbComp").val(-1);
				}
				
				$('#modal-comp').modal('show');
			},
			error: function ( data ) {
				//console.log( data );
			},
			cache: false,
			contentType: false,
			processData: false
		} );
}
function verDetalleComp( id ) {
	var formData = new FormData();
	$.ajax( {
			url: 'server.php?action=getDataComp&id=' + id,
			type: 'POST',
			data: formData,
			success: function ( data ) {
				//console.log(data);
				$("#nombreDet").val(data.nombre);
				$("#puntosgDet").val(data.puntos_ganador);
				$("#puntospDet").val(data.puntos_perdedor);
				$("#puntoseDet").val(data.puntos_empate);
				$("#maxJugDet").val(data.nummxjug);
				$("#feCreacionDet").val(data.fecha_creacion);
				if(data.activa == 1){
					$("#activaDet").prop("checked", true);
				}else{
					$("#activaDet").prop("checked", false);
				}
				if(data.habilitar_inscripciones == 1){
					$("#inscripcionDet").prop("checked", true);
				}else{
					$("#inscripcionDet").prop("checked", false);
				}
				if(data.id_parent != null){
					$("#cmbCompDet").val(data.id_parent);
				}else{
					$("#cmbCompDet").val(-1);
				}
				
				$('#modal-comp-det').modal('show');
			},
			error: function ( data ) {
				//console.log( data );
			},
			cache: false,
			contentType: false,
			processData: false
		} );
}
function delComp( id ) {
	if ( confirm( 'Confirma Eliminar?' ) ) {
		$.ajax( {
			url: 'server.php?action=delComp&id=' + id,
			type: 'POST',
			data: new FormData(  ),
			success: function ( data ) {
				//console.log( data );
				location.href = './competicion.php';
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
function aMayusculas(obj,id){
    obj = obj.toUpperCase();
    document.getElementById(id).value = obj;
}
<?php $connect->close(); ?>
