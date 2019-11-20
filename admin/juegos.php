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
			<h2 class="title">Juegos</h2>
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
								<label for="cmbFase">Fase</label> <select class="form-control"
									required id="cmbFase" name="cmbFase">
								</select>
							</div>
							<div class="form-group">
								<label for="cmbJornada">Jornada</label> <select
									class="form-control" required id="cmbJornada"
									name="cmbcmbJornada">
								</select>
							</div>
							<div class="form-group" id="divJuegosContent">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--/gx-wrapper-->
<!--Datatables JQuery-->
<script src="../node_modules/datatables.net/js/jquery.dataTables.js"></script>
<script
	src="../node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>
<script src="../js/custom/data-tables.js"></script>
<script>
var idComp;
var idFase;
var jornada;
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
	 $("#divJuegosContent").load('./ajax/ajaxJuegos.php?idFase='+idFase+'&idComp='+idComp+'&jornada='+jornada);
});

$(document).ready(function(){
   $("#cmbJornada").change(function () {
	 jornada = $(this).val();
	 $("#divJuegosContent").load('./ajax/ajaxJuegos.php?idFase='+idFase+'&idComp='+idComp+'&jornada='+jornada);	  	
   })
});

</script>
<?php $connect->close(); ?>
