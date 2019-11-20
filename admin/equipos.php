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
// las del ultimo año:
$resultEquipos = $connect->query("select distinct e.*, CONCAT(u.nombres,' ',u.apellidos) delegado, c.nombre competicion from equipo e JOIN usuario u on e.id_usuario = u.id left join competicion c on e.id_competicion = c.id order by e.nombre asc");
$resultUsuarios = $connect->query("select * from usuario where activo =1 order by id asc");
$resultCompetencias = $connect->query("select * from competicion WHERE activa=1 and (id_parent = 0 or id_parent = null ) order by nombre asc");
$idComp = 0;
?>
<!-- jquery.minicolorsstylesheet -->
<link href="../node_modules/jquery-minicolors/jquery.minicolors.css"
	rel="stylesheet">
<!-- /jquery.minicolors stylesheet -->

<!--gx-wrapper-->
<div class="gx-wrapper">

	<div class="animated slideInUpTiny animation-duration-3">
		<div class="page-heading">
			<h2 class="title">Equipos</h2>
		</div>
		<button class="jr-btn btn-primary btn btn-default" data-toggle="modal"
			data-target="#modal-equi" onclick="javascript:clearForm();">Crear</button>
		<div class="row">
			<div class="col-lg-12">
				<div class="gx-card">
					<div class="gx-card-body">
						<div class="table-responsive">
							<table class="table table-bordered table-hover dataTables-table">
								<thead>
									<tr>
										<th>#</th>
										<th>Nombre</th>
										<th>Color</th>
										<th>Usuario</th>
										<th>Competición</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php

        $iter = 1;
        while ($row = mysqli_fetch_array($resultEquipos)) {
            ?>
											<tr>
										<td>
													<?php echo $iter; ?>
												</td>
										<td>
													<?php echo $row['nombre']; ?>
												</td>
										<td>
											<div style="text-align: center;width: 50%;background-color:<?php echo $row['color']; ?>; height: 15px;"></div>
										</td>
										<td>
													<?php echo $row['delegado']; ?>
												</td>
										<td>
													<?php echo $row['competicion']; ?>
												</td>
										<td>
											<div class="btn-group dropdown no-border">
												<button
													class="gx-btn gx-btn-sm gx-btn-primary dropdown-toggle"
													type="button" data-toggle="dropdown" aria-haspopup="true"
													aria-expanded="false">Acciones</button>
												<div class="dropdown-menu">
													<a class="dropdown-item" href="javaScript:editEqui(<?php echo $row['id']; ?>)">Editar</a>
													<a class="dropdown-item"
														href="javaScript:viewPhoto('<?php echo $row['url_foto']; ?>');">Ver
														Foto</a> <a class="dropdown-item"
														href="jugadores.php?idEqui=<?php echo $row['id']; ?>">Gestionar
														Jugadores</a> <a class="dropdown-item"
														href="javaScript:delEqui('<?php echo $row['id']; ?>');">Borrar</a>
												</div>
											</div>
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
<div id="modal-equi" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header border-0">
				<h2 class="modal-title" id="mySmallModalLabel">Equipo</h2>
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="formCreateEqui" method="post">
					<div class="form-group">
						<label  for="nombre">Nombre</label>
						
							<input type="text"
								onblur="javascript:aMayusculas(this.value,this.id);"
								placeholder="Nombre" id="nombre" name="nombre"
								class="form-control">
						
					</div>
					<div class="form-group">
								<label for="color" >Color</label>
									<input type="color" id="color" name="color" class="form-control">
							</div>
					<div class="form-group">
						<label  for="nombre">Usuario</label>
						
							<select required id="cmbUser" name="cmbUser" class="form-control"
								data-show-subtext="true" data-live-search="true"> 
									<?php
        while ($row = mysqli_fetch_array($resultUsuarios)) {
            echo "<option  data-subtext='" . $row['id'] . "' value='" . $row['id'] . "'>" . $row['correo'] . "</option>";
        }
        ?> 
									</select>
						
					</div>
					<div class="form-group">
						<label  for="nombre">Competición</label>
						
							<select class="form-control" required id="cmbComp" name="cmbComp"> 
									<?php
        while ($rowe = mysqli_fetch_array($resultCompetencias)) {
            echo "<option value='" . $rowe['id'] . "'>" . $rowe['nombre'] . "</option>";
        }
        ?> 
									</select>
						
					</div>
					<div class="form-group">
						<label  for="nombre">Foto</label>
						
							<input type="file" value="" class="upload-img" id="foto"
								name="foto" onchange="readURL(this);" />
						
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-primary">Guardar</button>
						</div>
					</div>
					<input type="hidden" id="bthAction" name="bthAction" value="1" /> <input
						type="hidden" id="bthValId" name="bthValId" value="" />
				</form>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<div id="modal-viewPhoto" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header border-0">
				<h2 class="modal-title" id="mySmallModalLabel">Foto Equipo</h2>
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body" style="text-align: center;">
					<img id="imgTeam"
						style="text-align: center; width: 50%; height: auto;" src="">
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
<!--Minicolors JQuery-->
<script src="../js/jquery.minicolors.js"></script>
<script src="../js/custom/color-pickers.js"></script>
<script>
$(document).ready(function () {
$('.dataTables-table').DataTable({
	"searching": true,
	"bLengthChange": false,
	"bInfo": false,
	"pageLength": 10
});
});
$( "#formCreateEqui" ).submit(function( event ) {
	    event.preventDefault();
	$.ajax( {
		url: 'server.php?action=addUpdEqui',
		type: 'POST',
		data: new FormData( this ),
		success: function ( data ) {
			//console.log( data );
			$('#modal-equi').modal('hide');
			setTimeout(function(){											
				loadPage( 'equipos.php' );				
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
function editEqui( id ) { 
	$.ajax( {
			url: 'server.php?action=getDataEqui&id=' + id,
			type: 'POST',
			data: new FormData(  ),
			success: function ( data ) {
				//console.log(data);
				$("#bthAction").val(2);
				$("#bthValId").val(data.id);
				$("#nombre").val(data.nombre);
				$("#color").val(data.color);
				$("#cmbComp").val(data.id_competicion);
				$("#cmbUser").val(data.id_usuario);								
				$('#modal-equi').modal('show');
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
function delEqui( id ) {
	if ( confirm( 'Confirma Eliminar?' ) ) {
		$.ajax( {
			url: 'server.php?action=delEqui&id=' + id,
			type: 'POST',
			data: new FormData(  ),
			success: function ( data ) {
				//console.log( data );
				$('#modal-equi').modal('hide');
				setTimeout(function(){											
					loadPage( 'equipos.php' );				
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
function aMayusculas(obj,id){
    obj = obj.toUpperCase();
    document.getElementById(id).value = obj;
}
function readURL( input ) {
	if ( input.files && input.files[ 0 ] ) {
		var typeFile = input.files[ 0 ].type;
		if( typeFile!="image/jpeg" && typeFile!="image/jpg" && typeFile!="image/png" ){
			alert("Tipo de imagen inválido");
			$("#foto").val('');
		}
	}
}
function viewPhoto( urlfoto ) { 
	$("#imgTeam").attr("src",urlfoto);						
	$('#modal-viewPhoto').modal('show');
}
function clearForm(){
	$("#bthAction").val(1);
	$("#nombre").val(null);
	$("#color").val(null);
	$("#cmbUser").val(null);
	$("#cmbComp").val(null);
}
</script>
<?php $connect->close(); ?>
