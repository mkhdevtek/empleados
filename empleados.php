<?php
	include("conexion.php");
	session_start();
	if(!isset($_SESSION['user'])){
		header ("location: index.php");
	}
?>

<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Datos de empleados</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style_nav.css" rel="stylesheet">

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
			<h2>Lista de empleados</h2>
			<hr />

			<?php
      // VALOR aksi es para borrar
			if(isset($_GET['aksi']) == 'delete'){
				// escaping, additionally removing everything that could be (html/javascript-) code
				$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
				$miConsulta = "SELECT * FROM empleados WHERE codigo='$nik'"; //buscar el empleado que tenga en el campo codigo lo que hay en la variable $nik para ser eliminado
				$cek = mysqli_query($con,$miConsulta);
				if(mysqli_num_rows($cek) == 0){
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</div>';
				}else{
					$delete = mysqli_query($con, "DELETE FROM empleados WHERE codigo='$nik'");
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
						<option value="0">Filtros de datos de empleados</option>
						<?php $filter = (isset($_GET['filter']) ? strtolower($_GET['filter']) : NULL);  ?>
						<option value="1" <?php if($filter == 'Tetap'){ echo 'selected'; } ?>>Fijo</option>
						<option value="2" <?php if($filter == 'Kontrak'){ echo 'selected'; } ?>>Contratado</option>
                        <option value="3" <?php if($filter == 'Outsourcing'){ echo 'selected'; } ?>>Outsourcing</option>
					</select>
				</div>
			</form>
			<br />
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr>
          <th>No</th>
					<th>Código</th>
					<th>Nombre</th>
          <th>Lugar de nacimiento</th>
          <th>Fecha de nacimiento</th>
					<th>Teléfono</th>
					<th>Cargo</th>
					<th>Estado</th>
          <th>Acciones</th>
				</tr>
				<?php
				if($filter){
                    $miConsulta = "SELECT * FROM empleados WHERE estado='$filter'";   //crear una consulta que muestre a todos los empleados de la tabla empleados 
                                        //que coincidan con el contenido del campo estado y de la variable $filter
					$sql = mysqli_query($con, $miConsulta);
				}else{
                    $miConsulta = "SELECT * FROM empleados ORDER BY '$codigo'"; //crear una consulta que muestre a todos los empleados de la tabla empleados ordenadas por el campo código
					$sql = mysqli_query($con, $miConsulta);
				}
				if(mysqli_num_rows($sql) == 0){
					echo '<tr><td colspan="8">No hay datos.</td></tr>';
				}else{
					$no = 1;
					while($row = mysqli_fetch_assoc($sql)){
						echo '
						<tr>
							<td>'.$no.'</td>
							<td>'.$row['codigo'].'</td>
							<td><a href="profile.php?nik='.$row['codigo'].'"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> '.$row['nombres'].'</a></td>
                            <td>'.$row['lugar_nacimiento'].'</td>
                            <td>'.$row['fecha_nacimiento'].'</td>
							<td>'.$row['telefono'].'</td>
                            <td>'.$row['puesto'].'</td>
							<td>';
							if($row['estado'] == '1'){
								echo '<span class="label label-success">Fijo</span>';
							}
                            else if ($row['estado'] == '2' ){
								echo '<span class="label label-info">Contratado</span>';
							}
                            else if ($row['estado'] == '3' ){
								echo '<span class="label label-warning">Outsourcing</span>';
							}
						echo '
							</td>
							<td>

								<a href="edit.php?nik='.$row['codigo'].'" title="Editar datos" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
								<a href="empleados.php?aksi=delete&nik='.$row['codigo'].'" title="Eliminar" onclick="return confirm(\'Esta seguro de borrar los datos '.$row['nombres'].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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

		<!--  -->
		<div class="container">
			<div class="content">
				<h2>Lista de usuarios</h2>
				<hr />

				<?php
				// VALOR aksi es para borrar
				if (isset($_GET['aksi']) == 'delete') {
					// escaping, additionally removing everything that could be (html/javascript-) code
					$id_user = mysqli_real_escape_string($con, (strip_tags($_GET["nik"], ENT_QUOTES)));
					$miConsulta = "SELECT * FROM users WHERE id_user='$id_user'";
					$cek = mysqli_query($con, $miConsulta);
					if (mysqli_num_rows($cek) == 0) {
						echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</div>';
					} else {
						$delete = mysqli_query($con, "DELETE FROM users WHERE id_user='$id_user'");
						if ($delete) {
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Datos eliminados correctamente.</div>';
						} else {
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo eliminar los datos.</div>';
						}
					}
				}
				?>

				<br />
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<tr>
							<th>No</th>
							<th>ID Usuario</th>
							<th>Nombre de Usuario</th>
							<th>Nombre</th>
							<th>Apellido</th>
							<th>Fecha de Nacimiento</th>
							<th>Correo Electrónico</th>
							<th>Número de Teléfono</th>
							<th>Población</th>
							<th>Acciones</th>
						</tr>
						<?php
						if ($filter) {
							$miConsulta = "SELECT * FROM users WHERE estado='$filter'";
							$sql = mysqli_query($con, $miConsulta);
						} else {
							$miConsulta = "SELECT * FROM users ORDER BY id_user";
							$sql = mysqli_query($con, $miConsulta);
						}
						if (mysqli_num_rows($sql) == 0) {
							echo '<tr><td colspan="10">No hay datos.</td></tr>';
						} else {
							$no = 1;
							while ($row = mysqli_fetch_assoc($sql)) {
								echo '
								<tr>
									<td>' . $no . '</td>
									<td>' . $row['id_user'] . '</td>
									<td><a href="profile.php?nik=' . $row['id_user'] . '"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> ' . $row['user'] . '</a></td>
									<td>' . $row['nombre'] . '</td>
									<td>' . $row['apellido_s'] . '</td>
									<td>' . $row['fecha_nac'] . '</td>
									<td>' . $row['mail'] . '</td>
									<td>' . $row['num_phone'] . '</td>
									<td>' . $row['poblacion'] . '</td>
									<td>
										<a href="edit.php?nik=' . $row['id_user'] . '" title="Editar datos" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
										<a href="empleados.php?aksi=delete&nik=' . $row['id_user'] . '" title="Eliminar" onclick="return confirm(\'¿Está seguro de borrar los datos de ' . $row['user'] . '?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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
		</div>


	</div><center>
    <p>&copy; Sistemas Web <?php echo date("Y");?></p>
		</center>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>