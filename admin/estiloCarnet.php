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
$styleCarnet = mysqli_fetch_array($connect->query("select * from carnet WHERE id=1"));
?>
<!-- Font Material stylesheet -->
<link rel="stylesheet"
	href="../fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
<!-- /font material stylesheet -->

<!-- sprite-flags-master stylesheet -->
<link rel="stylesheet"
	href="../fonts/sprite-flags-master/sprite-flags-32x32.css">
<!-- /sprite-flags-master stylesheet -->

<!--Weather stylesheet -->
<link rel="stylesheet"
	href="../fonts/weather-icons-master/css/weather-icons.min.css">
<!-- /Weather stylesheet -->

<!-- Bootstrap stylesheet -->
<link href="../css/mouldifi-bootstrap.css" rel="stylesheet">
<!-- /bootstrap stylesheet -->

<!-- Perfect Scrollbar stylesheet -->
<link href="../node_modules/perfect-scrollbar/css/perfect-scrollbar.css"
	rel="stylesheet">
<!-- /perfect scrollbar stylesheet -->

<!-- jquery.minicolorsstylesheet -->
<link href="../node_modules/jquery-minicolors/jquery.minicolors.css"
	rel="stylesheet">
<!-- /jquery.minicolors stylesheet -->

<!-- Mouldifi-core stylesheet -->
<link href="../css/mouldifi-core.css" rel="stylesheet">
<!-- /mouldifi-core stylesheet -->

<!-- Color-Theme stylesheet -->
<link id="override-css-id" href="../css/theme-indigo.min.css"
	rel="stylesheet">
<!-- Color-Theme stylesheet -->

<!--gx-wrapper-->
<div class="gx-wrapper">

	<div class="animated slideInUpTiny animation-duration-3">
		<div class="page-heading">
			<h2 class="title">Colores Plantilla Carnet Liga</h2>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="gx-card">
					<div class="gx-card-body">

						<form id="formSaveTempCarnet" method="post">
							<div class="form-group row">
								<label for="exampleInputEmai08"
									class="col-xl-2 col-md-3 col-sm-2 control-label">Fondo Cabecera</label>
								<div class="col-xl-10 col-md-9 col-sm-8">
									<input type="hidden" class="color-picker"
										value="<?php echo $styleCarnet['color_header']; ?>"
										placeholder="color_header" id="color_header"
										name="color_header">
								</div>
							</div>
							<div class="form-group row">
								<label for="exampleInputEmai08"
									class="col-xl-2 col-md-3 col-sm-2 control-label">Texto Cabecera</label>
								<div class="col-xl-10 col-md-9 col-sm-8">
									<input type="text"
										onblur="javascript:aMayusculas(this.value,this.id);"
										value="<?php echo $styleCarnet['text_header']; ?>"
										placeholder="text_header" id="text_header" name="text_header"
										class="form-control" maxlength="50">
								</div>
							</div>
							<div class="form-group row">
								<label for="exampleInputEmai08"
									class="col-xl-2 col-md-3 col-sm-2 control-label">Color Texto
									Cabecera</label>
								<div class="col-xl-10 col-md-9 col-sm-8">
									<input type="hidden" class="color-picker"
										value="<?php echo $styleCarnet['text_color_header']; ?>"
										id="text_color_header" name="text_color_header">
								</div>
							</div>
							<div class="form-group row">
								<label for="exampleInputEmai08"
									class="col-xl-2 col-md-3 col-sm-2 control-label">Color Fondo
									Medio</label>
								<div class="col-xl-10 col-md-9 col-sm-8">
									<input type="hidden" class="color-picker"
										value="<?php echo $styleCarnet['color_body']; ?>"
										placeholder="color_body" id="color_body" name="color_body">
								</div>
							</div>
							<div class="form-group row">
								<label for="exampleInputEmai08"
									class="col-xl-2 col-md-3 col-sm-2 control-label">Color Texto
									Medio</label>
								<div class="col-xl-10 col-md-9 col-sm-8">
									<input type="hidden" class="color-picker"
										value="<?php echo $styleCarnet['text_color_body']; ?>"
										placeholder="text_color_body" id="text_color_body"
										name="text_color_body">
								</div>
							</div>
							
							<div class="form-group row">
								<label for="exampleInputEmai08"
									class="col-xl-2 col-md-3 col-sm-2 control-label">Texto 1</label>
								<div class="col-xl-10 col-md-9 col-sm-8">
									<input type="text"
										onblur="javascript:aMayusculas(this.value,this.id);"
										value="<?php echo $styleCarnet['text_body_1']; ?>"
										placeholder="text_body_1" id="text_body_1" name="text_body_1"
										class="form-control" maxlength="50">
								</div>
							</div>
							
							<div class="form-group row">
								<label for="exampleInputEmai08"
									class="col-xl-2 col-md-3 col-sm-2 control-label">Texto 2</label>
								<div class="col-xl-10 col-md-9 col-sm-8">
									<input type="text"
										onblur="javascript:aMayusculas(this.value,this.id);"
										value="<?php echo $styleCarnet['text_body_2']; ?>"
										placeholder="text_body_2" id="text_body_2" name="text_body_2"
										class="form-control" maxlength="50">
								</div>
							</div>
							
							<div class="form-group row">
								<label for="exampleInputEmai08"
									class="col-xl-2 col-md-3 col-sm-2 control-label">Texto 3</label>
								<div class="col-xl-10 col-md-9 col-sm-8">
									<input type="text"
										onblur="javascript:aMayusculas(this.value,this.id);"
										value="<?php echo $styleCarnet['text_body_3']; ?>"
										placeholder="text_body_3" id="text_body_3" name="text_body_3"
										class="form-control" maxlength="50">
								</div>
							</div>
							
							
							
							<div class="form-group row">
								<label for="exampleInputEmai08"
									class="col-xl-2 col-md-3 col-sm-2 control-label">Color Fondo
									Base</label>
								<div class="col-xl-10 col-md-9 col-sm-8">
									<input type="hidden" class="color-picker"
										value="<?php echo $styleCarnet['color_footer']; ?>"
										placeholder="color_footer" id="color_footer"
										name="color_footer">
								</div>
							</div>
							<div class="form-group row">
								<label for="exampleInputEmai08"
									class="col-xl-2 col-md-3 col-sm-2 control-label">Texto Base</label>
								<div class="col-xl-10 col-md-9 col-sm-8">
									<input type="text"
										onblur="javascript:aMayusculas(this.value,this.id);"
										value="<?php echo $styleCarnet['text_footer']; ?>"
										placeholder="text_footer" id="text_footer" name="text_footer"
										class="form-control" maxlength="50">
								</div>
							</div>
							<div class="form-group row">
								<label for="exampleInputEmai08"
									class="col-xl-2 col-md-3 col-sm-2 control-label">Color Texto
									Base</label>
								<div class="col-xl-10 col-md-9 col-sm-8">
									<input type="hidden" class="color-picker"
										value="<?php echo $styleCarnet['text_color_footer']; ?>"
										placeholder="text_color_footer" id="text_color_footer"
										name="text_color_footer">
								</div>
							</div>
							<div class="form-group row">
								<label for="exampleInputEmai08"
									class="col-xl-2 col-md-3 col-sm-2 control-label">Url Logo</label>
								<div class="col-xl-10 col-md-9 col-sm-8">
									<input type="text"
										onblur="javascript:aMayusculas(this.value,this.id);"
										value="<?php echo $styleCarnet['url_logo']; ?>"
										placeholder="url_logo" id="url_logo" name="url_logo"
										class="form-control" maxlength="50">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button class="btn btn-primary" type="submit">Guardar</button>

									<button type="button" class="btn btn-primary"
										data-toggle="modal" data-target="#modal-template">Ver
										Plantilla</button>
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--/gx-wrapper-->

<div id="modal-template" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Plantilla Carnet</h4>
			</div>
			<div class="modal-body">

				<table
					style="width: 340px; border: none; padding-left: 15px; border-collapse: inherit; border-spacing: 0px; font-family: Source Sans Pro, sans-serif !important;">
					<tr style="height: 50px;">
						<td style="width: 100%;background-color: <?php echo $styleCarnet['color_header']; ?>;" colspan="2" valign="top">
							<table>
								<tr>
									<td valign="top"><img
										style="padding-left: 5px; width: 100px !important; height: 49px !important;"
										src="<?php echo $styleCarnet['url_logo'] ?>" alt=""></td>
									<td valign="top" style="text-align: center;padding:5px 0px 0px 2px;font-size: 14px;font-weight: bold;color:<?php echo $styleCarnet['text_color_header']; ?>;">
							<?php if(empty($styleCarnet['text_header'])){ echo 'NombreTorneo';} else { echo $styleCarnet['text_header'];} ?>
						</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr style="background-color:<?php echo $styleCarnet['color_body'];?>;">
						<td style="width: 50%; font-weight: 600;"><img
							style="padding: 2px 0px 0px 2px; width: 105px !important; height: 110px !important;"
							src="../images/placeholder.jpg" alt=""></td>
						<td style="width: 50%; font-weight: 800; text-align: left;">
							<table style="font-size: 12px;">
								<tr>
									<td style="font-weight: 1000;color:<?php echo $styleCarnet['text_color_body'];?>;"><?php echo $styleCarnet['text_body_1'];?>:</td>
								</tr>
								<tr>
									<td></td>
								</tr>
								<tr>
									<td style="font-weight: 1000;color:<?php echo $styleCarnet['text_color_body'];?>;"><?php echo $styleCarnet['text_body_2']; ?>:</td>
								</tr>
								<tr>
									<td></td>
								</tr>
								<tr>
									<td style="font-weight: 1000;color:<?php echo $styleCarnet['text_color_body'];?>;"><?php echo $styleCarnet['text_body_3']; ?>:</td>
								</tr>
								<tr>
									<td></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr style="height: 30px;">
						<td colspan="2" style="font-size: 12px;padding-left: 5px;font-weight: 600;background-color: <?php echo $styleCarnet['color_footer']; ?>;color:<?php echo $styleCarnet['text_color_footer'];?>">
							<strong><?php echo $styleCarnet['text_footer']; ?></strong>
						</td>
					</tr>
				</table>

			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<!-- Menu Backdrop -->
<div class="menu-backdrop fade"></div>
<!-- /menu backdrop -->

<!--Custom JQuery-->
<script src="../js/functions.js"></script>
<script src="../js/custom/color-pickers.js"></script>

<!--Load JQuery-->
<script src="../node_modules/jquery/dist/jquery.min.js"></script>
<!--Bootstrap JQuery-->
<script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!--Perfect Scrollbar JQuery-->
<script
	src="../node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
<!--Big Slide JQuery-->
<script src="../node_modules/bigslide/dist/bigSlide.min.js"></script>
<!--Minicolors JQuery-->
<script src="../js/jquery.minicolors.js"></script>




<script>
$( "#formSaveTempCarnet" ).submit(function( event ) {
	event.preventDefault();
	$.ajax( {
		url: 'server.php?action=saveTemplateCarnet',
		type: 'POST',
		data: new FormData( this ),
		success: function ( data ) {
			console.log( data );
			loadPage( 'estiloCarnet.php' );			
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
	
function aMayusculas(obj,id){
	obj = obj.toUpperCase();
	document.getElementById(id).value = obj;
}
	</script>

<?php $connect->close(); ?>
