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
$resultUsuarios = $connect->query("select u.*, up.perfil from usuario u JOIN usuario_perfil up ON u.id = up.id_usuario ORDER BY nombres asc");
?>
<!--gx-wrapper-->
<div class="gx-wrapper">

	<div class="animated slideInUpTiny animation-duration-3">
		<div class="page-heading">
			<h2 class="title">Usuarios</h2>
		</div>
		<button class="jr-btn btn-primary btn btn-default"
			onclick="javaScript:createUser();">Crear</button>
		<div class="row">
			<div class="col-lg-12">
				<div class="gx-card">
					<div class="gx-card-body">
						<div class="table-responsive">
							<table class="table table-unbordered default-table table-hover">
								<thead>
									<tr>
										<th>Foto</th>
										<th>Documento</th>
										<th>Nombre</th>
										<th>Teléfono</th>
										<th>Correo</th>
										<th>Contraseña</th>
										<th>Rol</th>
										<th>Estado</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
							<?php
							while($row = mysqli_fetch_array($resultUsuarios)){
							?>
							<tr>								
								<td class="size-80"><img title="" alt="" src="<?php echo $row['url_foto'];?>" class="user-avatar"></td>
								<td class="size-80"><?php echo $row['documento']; ?></td>
								<td><strong><?php echo $row['nombres'].' '.$row['apellidos']; ?></strong></td>								
								<td class="text-center"><?php echo $row['telefono'];?></td>
								<td class="text-center"><?php echo $row['correo'];?></td>
								<td class="text-center"><?php echo $row['password'];?></td>				
								<td class="text-center"><?php echo $row['perfil'];?></td>
								<td class="text-center"><?php echo $row['activo']?'Activo':'Inactivo';?></td>	
								<td class="size-80 text-center">
									<a title="Modificar" href="javaScript:editUser(<?php echo $row['id']; ?>)">
									<i class="zmdi zmdi-edit zmdi-hc-2x"></i>
									</a>
									<a title="Borrar" href="javaScript:delUser('<?php echo $row['id']; ?>');">
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
<div id="modal-crear" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header border-0">
				<h2 class="modal-title" id="mySmallModalLabel">Usuario</h2>
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="formCreate" method="post">
							<div class="form-group"> 
								<label class="col-sm-2 control-label" for="nombre">*Documento</label> 
								<div class="col-sm-10"> 
									<input type="text" placeholder="documento" required id="documento" name="documento" class="form-control" maxlength="15">
								 </div> 
							</div> 
						 	<div class="form-group"> 
								<label class="col-sm-2 control-label" for="nombre">*Nombres</label> 
								<div class="col-sm-10"> 
									<input type="text" placeholder="Nombres" required id="nombres" name="nombres" class="form-control">
								 </div> 
							</div> 
							<div class="form-group"> 
								<label class="col-sm-2 control-label" for="nombre">*Apellidos</label> 
								<div class="col-sm-10"> 
									<input type="text" placeholder="Apellidos" required id="apellidos" name="apellidos" class="form-control">
								 </div> 
							</div> 
							<div class="form-group"> 
								<label class="col-sm-2 control-label" for="nombre">Teléfono</label> 
								<div class="col-sm-10"> 
									<input type="text" placeholder="telefono" id="telefono" name="telefono" class="form-control">
								 </div> 
							</div> 
							<div class="form-group"> 
								<label class="col-sm-2 control-label"  for="nombre">*Correo</label> 
								<div class="col-sm-10"> 
									<input type="text" placeholder="correo" required id="correo" name="correo" class="form-control">
								 </div> 
							</div> 
							<div class="form-group"> 
								<label class="col-sm-2 control-label" for="nombre">* Contraseña</label> 
								<div class="col-sm-10"> 
									<input type="text" placeholder="constraseña" required id="password" name="password" class="form-control" value="javaScript:randomPassword();">
								 </div> 
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="cmbPerfil">*Perfil</label>
								<div class="col-sm-10">
								<select class="form-control" required id="cmbPerfil" name="cmbPerfil"> 
									<option value="">Seleccione un perfil</option>
									<option value="usuario">usuario</option>
									<option value="colaborador">colaborador</option>
									<option value="admin">admin</option>
								</select>
								</div>
							  </div> 
							<div class="form-group"> 
								<label class="col-sm-2 control-label" for="activo">Activo</label> 
								<div class="col-sm-10">
									<input type="checkbox" id="activo" name="activo">
								 </div> 
							</div>							
							<div class="form-group"> 
								<label class="col-sm-2 control-label" for="nombre">Foto</label> 
								<div class="col-sm-10"> 
									<input type="file" value="" class="upload-img" id="foto" name="foto" onchange="readURL(this);"/>
								 </div> 
							</div>
							<div class="alert alert-danger" role="alert" hidden="true" id="div-msg-fail"></div>
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
$('.dataTables-usuarios').DataTable({
	"searching": true,
	"bLengthChange": false,
	"bInfo": false,
	"pageLength": 20
});
});
	

$( "#formCreate" ).submit(function( event ) {
    event.preventDefault();
	$.ajax( {
		url: 'server.php?action=addUpdUser',
		type: 'POST',
		data: new FormData( this ),
		success: function ( data ) {
			//console.log( data );
			if( data.error ){
				$('#div-msg-fail').text(data.description);			
				$('#div-msg-fail').show();
				setTimeout(function(){
					$('#div-msg-fail').hide();
				},4000);
			}else{
				$('#modal-crear').modal('hide');
				setTimeout(function(){											
					loadPage( 'usuarios.php' );				
				},200);
			}			
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

function createUser(){
	$("#bthAction").val(1);
	$("#bthValId").val('');
	$("#documento").val('');
	$("#nombres").val('');
	$("#apellidos").val('');
	$("#telefono").val('');
	$("#correo").val('');
	$("#password").val(randomPassword());
	$("#cmbPerfil").val('');
	$("#activo").prop("checked", false);
				
	$('#modal-crear').modal('show');

	return false;
}

function editUser( id ) {
	$.ajax( {
			url: 'server.php?action=getDataUser&id=' + id,
			type: 'POST',
			data: new FormData(  ),
			success: function ( data ) {
				//console.log(data);
				$("#bthAction").val(2);
				$("#bthValId").val(data.id);
				$("#documento").val(data.documento);
				$("#nombres").val(data.nombres);
				$("#apellidos").val(data.apellidos);
				$("#telefono").val(data.telefono);
				$("#correo").val(data.correo);
				$("#password").val(data.password);
				$("#cmbPerfil").val(data.perfil);
				if(data.activo == 1){
					$("#activo").prop("checked", true);
				}else{
					$("#activo").prop("checked", false);
				}				
				$('#modal-crear').modal('show');
			},
			error: function ( data ) {
				console.log( data );
			},
			cache: false,
			contentType: false,
			processData: false
		} );
	return false;
}
function delUser( id ) {
	if ( confirm( 'Confirma Eliminar?' ) ) {
		$.ajax( {
			url: 'server.php?action=delUser&id=' + id,
			type: 'POST',
			data: new FormData(  ),
			success: function ( data ) {
				//console.log( data );
				loadPage( 'usuarios.php' );
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
function readURL( input ) {
	if ( input.files && input.files[ 0 ] ) {
		var typeFile = input.files[ 0 ].type;
		if( typeFile!="image/jpeg" && typeFile!="image/jpg" && typeFile!="image/png" ){
			alert("Tipo de imagen inválido");
			$("#foto").val('');
		}
	}
	return false;
}
function randomPassword(){
	return randomstring = Math.random().toString(36).slice(-8);
}

</script>
<?php $connect->close(); ?>
