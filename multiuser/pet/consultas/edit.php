<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>


	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Datos citas</title>

	<!-- Bootstrap -->
	<link href="/multiuser/pet/css/bootstrap.min.css" rel="stylesheet">
	<link href="/multiuser//pet/css/bootstrap-datepicker.css" rel="stylesheet">
	<link href="/multiuser//pet/css/style_nav.css" rel="stylesheet">
	<style>
		.content {
			margin-top: 80px;
		}
	</style>
	

</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<?php include("nav.php");?>
	</nav>
	<div class="container">
		<div class="content">
			<h2>Datos de citas &raquo; Editar datos</h2>
			<hr />
			
			<?php
			// escaping, additionally removing everything that could be (html/javascript-) code
			$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
			$sql = mysqli_query($con, "SELECT * FROM consulta WHERE id_consultas='$nik'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			if(isset($_POST['save'])){
				$id_consultas		     = mysqli_real_escape_string($con,(strip_tags($_POST["id_consultas"],ENT_QUOTES)));//Escanpando caracteres 
				$id_veterinarios		     = mysqli_real_escape_string($con,(strip_tags($_POST["id_veterinarios"],ENT_QUOTES)));//Escanpando caracteres 
				$id_cliente		     = mysqli_real_escape_string($con,(strip_tags($_POST["id_cliente"],ENT_QUOTES)));//Escanpando caracteres 
				$id_mascota		     = mysqli_real_escape_string($con,(strip_tags($_POST["id_mascota"],ENT_QUOTES)));//Escanpando caracteres 
				$motivo		 = mysqli_real_escape_string($con,(strip_tags($_POST["motivo"],ENT_QUOTES)));//Escanpando caracteres 
				$tratamiento		     = mysqli_real_escape_string($con,(strip_tags($_POST["tratamiento"],ENT_QUOTES)));//Escanpando caracteres
				$detalles_examen		     = mysqli_real_escape_string($con,(strip_tags($_POST["detalles_examen"],ENT_QUOTES)));//Escanpando caracteres  
				$fecha	 = mysqli_real_escape_string($con,(strip_tags($_POST["fecha"],ENT_QUOTES)));//Escanpando caracteres
				
				
				$update = mysqli_query($con, "UPDATE consulta SET id_consultas='$id_consultas',id_veterinarios='$id_veterinarios', id_cliente='$id_cliente', id_mascota='$id_mascota', motivo='$motivo', tratamiento='$tratamiento', detalles_examen='$detalles_examen', fecha='$fecha' WHERE id_mascota='$nik'") or die(mysqli_error());
				if($update){
					header("Location: edit.php?nik=".$nik."&pesan=sukses");
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error, no se pudo guardar los datos.</div>';
				}
			}
			
			if(isset($_GET['pesan']) == 'sukses'){
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Los datos han sido guardados con éxito.</div>';
			}
			?>
			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">Código</label>
					<div class="col-sm-2">
						<input type="text" name="id_mascota" value="<?php echo $row ['id_mascota']; ?>" class="form-control" placeholder="NIK" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Dueño</label>
					<div class="col-sm-2">
						<input type="text" name="id_veterinarios" value="<?php echo $row ['id_veterinarios']; ?>" class="form-control" placeholder="NIK" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">id_clientes</label>
					<div class="col-sm-4">
						<input type="text" name="id_cliente" value="<?php echo $row ['id_cliente']; ?>" class="form-control" placeholder="id_cliente" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">id_mascota</label>
					<div class="col-sm-4">
						<input type="text" name="id_mascota" value="<?php echo $row ['id_mascota']; ?>" class="form-control" placeholder="id_mascota" required>
					</div>
				</div>
											
				<div class="form-group">
					<label class="col-sm-3 control-label">motivo</label>
					<div class="col-sm-3">
						<input type="text" name="motivo" value="<?php echo $row ['motivo']; ?>" class="form-control" placeholder="motivo" required>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">tratamiento</label>
					<div class="col-sm-3">
						<input type="text" name="tratamiento" value="<?php echo $row ['tratamiento']; ?>" class="form-control" placeholder="tratamiento" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">detalles_examen</label>
					<div class="col-sm-3">
						<input type="text" name="detalles_examen" value="<?php echo $row ['detalles_examen']; ?>" class="form-control" placeholder="detalles_examen" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Fecha</label>
					<div class="col-sm-4">
						<input type="text" name="fecha" value="<?php echo $row ['fecha']; ?>" class="input-group date form-control" date="" data-date-format="yyyy-mm-dd" placeholder="0000-00-00" required>
					</div>
				</div>
				
			
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="save" class="btn btn-sm btn-primary" value="Guardar datos">
						<a href="index.php" class="btn btn-sm btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="/pet/js/bootstrap.min.js"></script>
	<script src="/pet/js/bootstrap-datepicker.js"></script>
	<script>
	$('.date').datepicker({
		format: 'dd-mm-yyyy',
	})
	</script>
</body>
</html>