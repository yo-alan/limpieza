<html>
	<head>
		<title>Limpieza | Agregar un usuario nuevo</title>
		<link rel="shortcut icon" href="images/favicon.ico" />
		<link href="css/default.css" rel="stylesheet">
		<link href="css/bootstrap.css" rel="stylesheet">
		<script language="JavaScript" src="js/jquery.js"></script>
		<script language="JavaScript" src="js/bootstrap.js"></script>
		<script language="JavaScript" src="js/twitter-bootstrap-hover-dropdown.min.js"></script>
	</head>
	<body>
		<div class="container jumbotron">
			<header>
				<?php include_once "../templates/header.php"; ?>
			</header>
			<article>
				<?php if(isset($_GET["estado"])): ?>
				<div class="container col-md-6 col-md-offset-3">
					<div class="panel panel-<?php echo $_GET["estado"]; ?>">
						<div class="panel-heading">
							<?php if($_GET["estado"] == "success"): ?>
								<h3 class="panel-title"><strong>Información:</strong></h3>
							<?php else: ?>
								<h3 class="panel-title"><strong>Ocurrió un error:</strong></h3>
							<?php endif; ?>
						</div>
						<div class="panel-body">
							<p class="text-<?php echo $_GET["estado"]; ?> text-center">
								<?php if($_GET["estado"] == "success"): ?>
									<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
								<?php else: ?>
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
								<?php endif; ?>
								
								<?php echo $_GET["mensaje"]; ?>
							</p>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<div class="container col-md-6 col-md-offset-3">
					<div class="text-center">
						<h2>Crear usuario nuevo</h2>
					</div>
					<form role="form" class="form-horizontal" method="POST" action="usuario.php">
						<input type="hidden" name="action" value="agregar">
						<div class="form-group">
							<label for="nombre" class="col-sm-3 control-label">Usuario: </label>
							<div class="col-sm-7">
								<input type="text" class="form-control" name="nombre" required>
							</div>
						</div>
						<div class="form-group">
							<label for="contrasena" class="col-sm-3 control-label">Contraseña: </label>
							<div class="col-sm-7">
								<input type="password" class="form-control" name="contrasena" required>
							</div>
						</div>
						<div class="form-group">
							<label for="nivel" class="col-sm-3 control-label">Nivel: </label>
							<div class="col-sm-7">
								<select class="form-control" name="nivel">
									<option value="Administrador">Administrador</option>
									<option value="Normal">Normal</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4 col-md-offset-8">
								<button type='submit' class='btn btn-default'>Guardar</button>
							</div>
						</div>
					</form>
					</div>
			</article>
			<footer>
				<div class="container">
					
				</div>
			</footer>
		</div>
	</body>
</html>
