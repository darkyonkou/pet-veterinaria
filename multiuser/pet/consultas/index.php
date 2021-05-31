
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
	<link href="/multiuser/pet/css/style_nav.css" rel="stylesheet">
 
	<style>
		.content {
			margin-top: 80px;
		}
	</style>
 
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<?php include('nav.php');?>
	</nav>
	<div class="container">
		<div class="content">
			<h2>Lista citas</h2>
			<hr />
			<?php
				
				session_start();

				if(!isset($_SESSION['personal_login']))	
				{
					header("location: ../index.php");
				}

				if(isset($_SESSION['admin_login']))	
				{
					header("location: ../admin/admin_portada.php");
				}

				if(isset($_SESSION['usuarios_login']))	
				{
					header("location: ../usuarios/usuarios_portada.php");
				}
				
				if(isset($_SESSION['personal_login']))
				{
				?>
					Bienvenido,
				<?php
					echo $_SESSION['personal_login'];
				}
				?>
			<?php
			if(isset($_GET['aksi']) == 'delete'){
				// escaping, additionally removing everything that could be (html/javascript-) code
				$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
				$cek = mysqli_query($con, "SELECT * FROM consulta WHERE id_consultas='$nik'");
				if(mysqli_num_rows($cek) == 0){
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</div>';
				}else{
					$delete = mysqli_query($con, "DELETE FROM consulta WHERE id_consultas='$nik'");
					if($delete){
						echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Datos eliminado correctamente.</div>';
					}else{
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo eliminar los datos.</div>';
					}
				}
			}
			?>
 
			<form class="form-inline" method="get">
				<div class="form-group">
					<select name="filter" class="form-control" onchange="form.submit()">
						<option value="0">.....</option>
						<?php $filter = (isset($_GET['filter']) ? strtolower($_GET['filter']) : NULL);  ?>
						<option value="1" <?php if($filter == 'Tetap'){ echo 'selected'; } ?>>Si</option>
						<option value="2" <?php if($filter == 'Kontrak'){ echo 'selected'; } ?>>No</option>
                        
					</select>
				</div>
			</form>
			<br />
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr>
                    <th>No</th>
					<th>consultas</th>
					<th>veterinarios</th>
					<th>Cliente</th>
                    <th>Mascota</th>
                    <th>Motivo</th>
					<th>tratamiento</th>
					<th>Det. Examen</th>
					<th>Fecha</th>
					
				</tr>
				<?php
				if($filter){
					$sql = mysqli_query($con, "SELECT * FROM consulta WHERE id_cliente='$filter' ORDER BY id_consultas ASC");
				}else{
					$sql = mysqli_query($con, "SELECT * FROM consulta ORDER BY id_consultas ASC");
				}
				if(mysqli_num_rows($sql) == 0){
					echo '<tr><td colspan="8">No hay datos.</td></tr>';
				}else{
					$no = 1;
					while($row = mysqli_fetch_assoc($sql)){
						echo '
						<tr>
							<td>'.$no.'</td>
							<td>'.$row['id_consultas'].'</td>
							<td>'.$row['id_veterinarios'].'</td>
							<td><a href="profile.php?nik='.$row['id_cliente'].'"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> '.$row['id_cliente'].'</a></td>
                            <td>'.$row['id_mascota'].'</td>
                            <td>'.$row['motivo'].'</td>
							<td>'.$row['tratamiento'].'</td>
                            <td>'.$row['color'].'</td>
							<td>'.$row['detalles_examen'].'</td>
							<td>'.$row['fecha'].'</td>
							<td>';
							if($row['vacunas'] == '1'){
								echo '<span class="label label-success">Si</span>';
							}
                            else if ($row['vacunas'] == '2' ){
								echo '<span class="label label-info">No</span>';
							}
                            
						echo '
						
							</td>
							<td>
 
								<a href="edit.php?nik='.$row['id_mascota'].'" title="Editar datos" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
								<a href="index.php?aksi=delete&nik='.$row['id_mascota'].'" title="Eliminar" onclick="return confirm(\'Esta seguro de borrar los datos '.$row['nombre'].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
							</td>
						</tr>
						';
						$no++;
					}
				}
				?>
			</table>
			</div>
		</div>
	</div><center>
	<p>&copy;  <?php echo date("Y");?></p
		</center>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="/pet/js/bootstrap.min.js"></script>
</body>
</html>
