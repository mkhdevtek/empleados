<?php
	include("conexion.php");
	session_start();

	if(!isset($_SESSION['username'])){
		header ("location: index.php");
	}

?>
<!DOCTYPE html>
<html lang="es">
<head>
<!--
Project      : Datos de empleados con PHP, MySQLi y Bootstrap CRUD  (Create, read, Update, Delete) 
Author		 : Obed Alvarado
Website		 : http://www.obedalvarado.pw
Blog         : https://obedalvarado.pw/blog/
Email	 	 : info@obedalvarado.pw
-->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Datos de usuario</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-datepicker.css" rel="stylesheet">
	<link href="css/style_nav.css" rel="stylesheet">
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
			<h2>Datos del usuario &raquo; Editar datos</h2>
			<hr />
			
			<?php
            $nik = mysqli_real_escape_string($con, (strip_tags($_GET["nik"], ENT_QUOTES)));
            $miConsulta = "SELECT * FROM usuarios WHERE iduser=" . $nik;
            $sql = mysqli_query($con, $miConsulta);
            if (mysqli_num_rows($sql) == 0) {
                header("Location: index.php");
            } else {
                $row = mysqli_fetch_assoc($sql);
            }
            if (isset($_POST['save'])) {
                $iduser = mysqli_real_escape_string($con, (strip_tags($_POST["iduser"], ENT_QUOTES)));
                $usuario = mysqli_real_escape_string($con, (strip_tags($_POST["usuario"], ENT_QUOTES)));
                $password = mysqli_real_escape_string($con, (strip_tags($_POST["password"], ENT_QUOTES)));
                $nombre = mysqli_real_escape_string($con, (strip_tags($_POST["nombre"], ENT_QUOTES)));
                $apellidos = mysqli_real_escape_string($con, (strip_tags($_POST["apellidos"], ENT_QUOTES)));
                $fechanac = mysqli_real_escape_string($con, (strip_tags($_POST["fechanac"], ENT_QUOTES)));
                $correo = mysqli_real_escape_string($con, (strip_tags($_POST["correo"], ENT_QUOTES)));
                $telefono = mysqli_real_escape_string($con, (strip_tags($_POST["telefono"], ENT_QUOTES)));
                $poblacion = mysqli_real_escape_string($con, (strip_tags($_POST["poblacion"], ENT_QUOTES)));
                $rol = mysqli_real_escape_string($con, (strip_tags($_POST["rol"], ENT_QUOTES)));

                // Comienza la transacción
                mysqli_begin_transaction($con);

                $miConsulta = "UPDATE usuarios SET 
                iduser  = '$iduser',
                usuario = '$usuario',
                password = '$password',
                nombre = '$nombre',
                apellidos = '$apellidos',
                fechanac = '$fechanac',
                correo	 = '$correo',
                telefono = '$telefono',
                poblacion = '$poblacion',
                rol = '$rol'
                WHERE iduser = '$nik'";

                $update = mysqli_query($con, $miConsulta);

                if ($update) {
                    // Commit la transacción si la actualización tiene éxito
                    mysqli_commit($con);
                    header("Location: editUsuarios.php?nik=" . $nik . "&pesan=sukses");
                } else {
                    // Rollback la transacción en caso de error
                    mysqli_rollback($con);
                    echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error, no se pudo guardar los datos.</div>';
                }
            }

            if (isset($_GET['pesan']) == 'sukses') {
                echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Los datos han sido guardados con éxito.</div>';
            }
            ?>	
			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">Id</label>
					<div class="col-sm-2">
						<input type="text" name="iduser" value="<?php echo $row ['iduser']; ?>" class="form-control" placeholder="NIK" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Usuario</label>
					<div class="col-sm-4">
						<input type="text" name="usuario" value="<?php echo $row ['usuario']; ?>" class="form-control" placeholder="usuario" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Password</label>
					<div class="col-sm-4">
						<input type="text" name="password" value="<?php echo $row ['password']; ?>" class="form-control" placeholder="password" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Nombre</label>
					<div class="col-sm-4">
						<input type="text" name="nombre" value="<?php echo $row ['nombre']; ?>" class="form-control" placeholder="nombre" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Apellidos</label>
					<div class="col-sm-3">
						<textarea name="apellidos" class="form-control" placeholder="apellidos"><?php echo $row ['apellidos']; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Fecha Nacimiento</label>
					<div class="col-sm-3">
						<input type="text" name="fechanac" value="<?php echo $row ['fechanac']; ?>" class="input-group date form-control" date="" data-date-format="yyyy-mm-dd" placeholder="0000-00-00" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Correo</label>
					<div class="col-sm-3">
						<input type="text" name="correo" value="<?php echo $row ['correo']; ?>" class="form-control" placeholder="correo" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Telefono</label>
					<div class="col-sm-3">
						<input type="text" name="telefono" value="<?php echo $row ['telefono']; ?>" class="form-control" placeholder="telefono" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Poblacion</label>
					<div class="col-sm-3">
						<input type="text" name="poblacion" value="<?php echo $row ['poblacion']; ?>" class="form-control" placeholder="poblacion" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Rol</label>
					<div class="col-sm-3">
						<input type="text" name="rol" value="<?php echo $row ['rol']; ?>" class="form-control" placeholder="rol" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="save" class="btn btn-sm btn-primary" value="Guardar datos">
						<a href="usuarios.php" class="btn btn-sm btn-danger">Cancelar</a>
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