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
			<h2>Datos veterinario &raquo; Agregar datos</h2>
			<hr />

			<?php
			if(isset($_POST['add'])){
				$id_veterinarios		     = mysqli_real_escape_string($con,(strip_tags($_POST["id_veterinarios"],ENT_QUOTES)));//Escanpando caracteres 
				$nombre		     = mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));//Escanpando caracteres 
				$apellido		     = mysqli_real_escape_string($con,(strip_tags($_POST["apellido"],ENT_QUOTES)));//Escanpando caracteres 
				$tel_consultorio		     = mysqli_real_escape_string($con,(strip_tags($_POST["tel_consultorio"],ENT_QUOTES)));//Escanpando caracteres 
				$tel_celular	 = mysqli_real_escape_string($con,(strip_tags($_POST["tel_celular"],ENT_QUOTES)));//Escanpando caracteres 
				$correo	     = mysqli_real_escape_string($con,(strip_tags($_POST["correo"],ENT_QUOTES)));//Escanpando caracteres 
				$direccion		 = mysqli_real_escape_string($con,(strip_tags($_POST["direccion"],ENT_QUOTES)));//Escanpando caracteres 
				$nit		 = mysqli_real_escape_string($con,(strip_tags($_POST["nit"],ENT_QUOTES)));//Escanpando caracteres 
				$especialidad		     = mysqli_real_escape_string($con,(strip_tags($_POST["especialidad"],ENT_QUOTES)));//Escanpando caracteres
				
				
			

				$cek = mysqli_query($con, "SELECT * FROM veterinario WHERE id_veterinarios='$id_veterinarios'");
				if(mysqli_num_rows($cek) == 0){
						$insert = mysqli_query($con, "INSERT INTO veterinario(id_veterinarios, nombre, apellido, tel_consultorio, tel_celular, correo, direccion, nit, especialidad)
															VALUES('$id_veterinarios','$nombre','$apellido','$tel_consultorio','$tel_celular','$correo','$direccion','$nit','$especialidad' )") or die(mysqli_error());
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
						<input type="text" name="id_veterinarios" class="form-control" placeholder="Código" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Nombre</label>
					<div class="col-sm-2">
						<input type="text" name="nombre" class="form-control" placeholder="Dueño" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Apellidos</label>
					<div class="col-sm-4">
						<input type="text" name="apellido" class="form-control" placeholder="Nombre" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">tel. consultorio</label>
					<div class="col-sm-4">
						<input type="text" name="tel_consultorio" class="form-control" placeholder="Nombre" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Tel. celular</label>
					<div class="col-sm-4">
						<input type="text" name="tel_celular" class="form-control" placeholder="Nombre" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">correo</label>
					<div class="col-sm-4">
						<input type="text" name="correo" class="form-control" placeholder="Nombre" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">direccion</label>
					<div class="col-sm-3">
						<input type="text" name="direccion" class="form-control" placeholder="direccion" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">NIT</label>
					<div class="col-sm-3">
						<input type="text" name="nit" class="form-control" placeholder="direccion" required>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Especialidad</label>
					<div class="col-sm-3">
						<input type="text" name="especialidad" class="form-control" placeholder="direccion" required>
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
