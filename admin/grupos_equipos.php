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
$resultCompetencias = $connect->query("select * from competicion WHERE activa=1  order by nombre asc");
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
?>
<!--gx-wrapper-->
<div class="gx-wrapper">

	<div class="animated slideInUpTiny animation-duration-3">
		<div class="page-heading">
			<h2 class="title">Equipos * Grupo</h2>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="gx-card">
					<div class="gx-card-body">
						<form>
							<div class="form-group">
								<label for="emailaddress">Competición</label> <select
									class="form-control" required id="cmbComp" name="cmbComp">
									<option value="">Seleccione una competencia</option><?php
        while ($row = mysqli_fetch_array($resultCompetencias)) {
            echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
        }
        ?> 
								</select>
							</div>
							<div class="form-group">
								<label for="password">Fase</label> <select class="form-control"
									required id="cmbFase" name="cmbFase">
								</select>
							</div>

							<div class="form-group">
								<div class="row" id="divGroupContent"></div>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--/gx-wrapper-->
<div id="modal-asoc-equi" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header border-0">
				<h2 class="modal-title" id="mySmallModalLabel">Agregar Equipo a Grupo</h2>
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="formAddEquiGru" method="post">
					<div class="table-responsive" id="tbodyAddEquiGru"></div>
					<input type="hidden" id="idGrupHid" name="idGrupHid" value="" />
					<button type="submit" class="btn btn-primary">Agregar</button>
				</form>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<div id="modal-alert" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Alerta!</h4>
			</div>
			<div class="modal-body">
				<form id="formSede" method="post">
					<div class="panel-body">
						<div class="alert alert-danger" role="alert">
							<strong>Alerta!</strong>
							<p id="textAlert"></p>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--Datatables JQuery-->
<script src="../node_modules/datatables.net/js/jquery.dataTables.js"></script>
<script
	src="../node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>
<script src="../js/custom/data-tables.js"></script>
<script>
var idComp;
var idFase;
$("#cmbComp").change(function () {
	$("#cmbComp option:selected").each(function () { 
        elegido=$(this).val();
		idComp = elegido;
        $.post("./ajax/ajaxFases.php", { elegido: elegido }, function(data){
        $("#cmbFase").html(data);
        });            
    });
});

$("#cmbFase").change(function () {
	idFase = $(this).val();
 	$("#divGroupContent").load('./ajax/ajaxGrupos.php?idFase='+this.value);
});
function addEquToGru( idGrupo ){
	$("#tbodyAddEquiGru").load('./ajax/ajaxListEquipos.php?option=toGroup&idComp='+idComp+"&idGrupo="+idGrupo+"&idFase="+idFase); 	
	$("#idGrupHid").val(idGrupo);
	$('#modal-asoc-equi').modal('show');
}	
$( "#formAddEquiGru" ).submit(function( event ) {
    event.preventDefault();
	$.ajax( {
		url: 'server.php?action=addEquiGru',
		type: 'POST',
		data: new FormData( this ),
		success: function ( data ) {
			//console.log( data );
			$('#modal-asoc-equi').modal('hide');
			setTimeout(function(){											
				$("#divGroupContent").load('./ajax/ajaxGrupos.php?idFase='+$("#cmbFase").val());				
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
function delEquiGru( id ) {
	if ( confirm( 'Confirma Eliminar?' ) ) {
		$.ajax( {
			url: 'server.php?action=delEquiGru&id=' + id +'&idComp='+$("#cmbComp").val()+'&idFase='+$("#cmbFase").val(),
			type: 'POST',
			data: new FormData(  ),
			success: function ( data ) {
				console.log( data );
				if(!data.error){
					$("#divGroupContent").load('./ajax/ajaxGrupos.php?idFase='+$("#cmbFase").val());
				}else{
					$('#textAlert').text(data.description);
					$('#modal-alert').modal('show');	
				}
			},
			error: function ( data ) {
				console.log( data );
			},
			cache: false,
			contentType: false,
			processData: false
		} );
	}
}
</script>
<?php $connect->close(); ?>
