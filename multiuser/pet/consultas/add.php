<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Latihan MySQLi</title>

	<!-- Bootstrap -->
	<link href="/multiuser/pet/css/bootstrap.min.css" rel="stylesheet">
	<link href="/multiuser/pet/css/bootstrap-datepicker.css" rel="stylesheet">
	<link href="/multiuser/pet/css/style_nav.css" rel="stylesheet">
	<style>
		.content {
			margin-top: 80px;
		}
	</style>

	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<?php include("nav.php");?>
	</nav>
	<div class="container">
		<div class="content">
			<h2>Datos de citas &raquo; Agregar datos</h2>
			<hr />

			<?php
			if(isset($_POST['add'])){
				$id_consultas		     = mysqli_real_escape_string($con,(strip_tags($_POST["id_consultas"],ENT_QUOTES)));//Escanpando caracteres 
				$id_veterinarios		     = mysqli_real_escape_string($con,(strip_tags($_POST["id_veterinarios"],ENT_QUOTES)));//Escanpando caracteres 
				$id_cliente		     = mysqli_real_escape_string($con,(strip_tags($_POST["id_cliente"],ENT_QUOTES)));//Escanpando caracteres 
				$id_mascota		     = mysqli_real_escape_string($con,(strip_tags($_POST["id_mascota"],ENT_QUOTES)));//Escanpando caracteres 
				$motivo		 = mysqli_real_escape_string($con,(strip_tags($_POST["motivo"],ENT_QUOTES)));//Escanpando caracteres 
				$tratamiento		     = mysqli_real_escape_string($con,(strip_tags($_POST["tratamiento"],ENT_QUOTES)));//Escanpando caracteres
				$detalles_examen		     = mysqli_real_escape_string($con,(strip_tags($_POST["detalles_examen"],ENT_QUOTES)));//Escanpando caracteres  
				$fecha	 = mysqli_real_escape_string($con,(strip_tags($_POST["fecha"],ENT_QUOTES)));//Escanpando caracteres 
				
			

				$cek = mysqli_query($con, "SELECT * FROM consulta WHERE id_consultas='$id_consultas'");
				if(mysqli_num_rows($cek) == 0){
						$insert = mysqli_query($con, "INSERT INTO consulta(id_consultas, id_veterinarios, id_cliente, id_mascota, fecha, Genero, motivo, esterilizado, tratamiento, detalles_examen, vacunas, observaciones)
															VALUES('$id_consultas', '$id_veterinarios', '$id_cliente', '$id_mascota', '$motivo', '$tratamiento','$detalles_examen','$fecha')") or die(mysqli_error());
						if($insert){
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Bien hecho! Los datos han sido guardados con éxito.</div>';
						}else{
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo guardar los datos !</div>';
						}
					 
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. código exite!</div>';
				}
			}
			?>

			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">Código</label>
					<div class="col-sm-2">
						<input type="text" name="id_consultas" class="form-control" placeholder="Código" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Veterinario</label>
					<div class="col-sm-2">
						<input type="text" name="id_veterinarios" class="form-control" placeholder="Dueño" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">clientes</label>
					<div class="col-sm-4">
						<input type="text" name="id_cliente" class="form-control" placeholder="id_cliente" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">id_mascota</label>
					<div class="col-sm-4">
						<input type="text" name="id_mascota" class="form-control" placeholder="id_cliente" required>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">motivo</label>
					<div class="col-sm-3">
						<input type="text" name="motivo" class="form-control" placeholder="motivo" required>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">tratamiento</label>
					<div class="col-sm-3">
						<input type="text" name="tratamiento" class="form-control" placeholder="motivo" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">detalles_examen</label>
					<div class="col-sm-3">
						<input type="text" name="detalles_examen" class="form-control" placeholder="color" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Fecha</label>
					<div class="col-sm-4">
						<input type="text" name="fecha" class="input-group date form-control" date="" data-date-format="dd-mm-yyyy" placeholder="00-00-0000" required>
					</div>
				</div>
				
				
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="Guardar datos">
						<a href="index.php" class="btn btn-sm btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
	$('.date').datepicker({
		format: 'dd-mm-yyyy',
	})
	</script>
</body>
</html>
