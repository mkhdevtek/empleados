<!-- // Version: 1.0 -->

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="css/login_estilos.css" rel="stylesheet">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="js/login_js.js"></script>
<!------ Include the above in your HEAD tag ---------->
<div class="container">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link">Login</a>
							</div>
							<div class="col-xs-6">
								<a href="#" id="register-form-link">Register</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="logeo.php" method="post" role="form" style="display: block;">
									<div class="form-group">
										<input type="text" name="user" id="user" tabindex="1" class="form-control" placeholder="User" value="">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<div class="form-group text-center">
										<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
										<label for="remember">Remember Me</label>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="" tabindex="5" class="forgot-password">Forgot Password?</a>
												</div>
											</div>
										</div>
									</div>
								</form>
								<form id="register-form" action="register.php" method="post" role="form" style="display: none;">
									<!-- Nombre -->
									<div class="form-group">
										<input type="text" name="name" id="name" tabindex="1" class="form-control" placeholder="Nombre(s)*" value="">
									</div>
									<!-- Apellidos -->
									<div class="form-group">
										<input type="text" name="apellidos" id="apellidos" tabindex="1" class="form-control" placeholder="Apellido(s)" value="">
									</div>
									<!-- usuario -->
									<div class="form-group">
										<input type="text" name="user" id="user" tabindex="1" class="form-control" placeholder="Usuario*" value="">
									</div>
									<!-- email -->
									<div class="form-group">
										<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
									</div>
									<!-- fechanac -->
									<div class="form-group">
										<input type="date" name="date_birth" id="date_birth" tabindex="1" class="form-control" placeholder="Fecha de nacimiento" value="">
									</div>
									<!-- telefono -->
									<div class="form-group">
										<input type="text" name="phone" id="phone" tabindex="1" class="form-control" placeholder="Numero de telefono" value="">
									</div>
									<!-- fechanac -->
									<div class="form-group">
										<input type="text" name="poblacion" id="poblacion" tabindex="1" class="form-control" placeholder="Poblacion" value="">
									</div>
									<!-- password -->
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password*">
									</div>
									<!-- confirm-password -->
									<div class="form-group">
										<input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password*">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
