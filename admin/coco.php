<?php
session_start();
if (! isset($_SESSION['dataSession'])) {
    header('Location: ../index.html');
} else {
    if ($_SESSION['dataSession']['perfil'] != 'admin') {
        header('Location: ../salir.php');
    }
}
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
require '../conexion.php';
// las del ultimo año:
$resultCompetencias = $connect->query("select * from competicion WHERE  now() <= ADDDATE(DATE(fecha_creacion), interval 1  YEAR) order by fecha_creacion desc,nombre asc");
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
							<table class="table table-bordered table-hover dataTables-comp"></table>
						</div>
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
<?php $connect->close(); ?>
