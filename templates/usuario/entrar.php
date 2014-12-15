<html>
	<head>
		<title>Limpieza | Entrar</title>
		<link rel="shortcut icon" href="images/favicon.ico" />
		<link href="css/default.css" rel="stylesheet">
		<link href="css/bootstrap.css" rel="stylesheet">
		<script language="JavaScript" src="js/jquery.js"></script>
		<script language="JavaScript" src="js/bootstrap.js"></script>
		<script language="JavaScript" src="js/twitter-bootstrap-hover-dropdown.min.js"></script>
	</head>
	<body>
		<div class="container jumbotron">
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
				<div class="row">
					<div class="col-md-4 col-md-offset-4">
						<div class="panel panel-default">
							<div class="panel-heading">
								<strong>Identif&iacute;quese</strong>
							</div>
							<div class="panel-body">
								<form class="form-horizontal" role="form" method="post" action="usuario.php">
									<input type="hidden" name="action" value="entrar">
									<div class="form-group <?php if($_GET["estado"] == "danger") echo "has-error"; ?>">
										<label for="nombre" class="col-sm-3 control-label">Usuario:</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="nombre" placeholder="Nombre de usuario" autofocus required>
										</div>
									</div>
									<div class="form-group <?php if($_GET["estado"] == "danger") echo "has-error"; ?>">
										<label for="contrasena" class="col-sm-3 control-label">Contrase&ntilde;a:</label>
										<div class="col-sm-9">
											<input type="password" class="form-control" name="contrasena" placeholder="Contrase&ntilde;a" required>
										</div>
									</div>
									<div class="form-group last">
										<div class="col-sm-offset-3 col-sm-9">
											<button type="submit" class="btn btn-primary btn-sm">Entrar</button>
											<button type="reset" class="btn btn-default btn-sm">Restaurar</button>
										</div>
									</div>
								</form>
							</div>
							<div class="panel-footer">
								&iquest;Ha olvidado su contrase&ntilde;a? P&oacute;ngase en contacto con el Depto. de Inform&aacute;tica.
							</div>
						</div>
					</div>
				</div>
			</article>
			<footer>
				<div class="container">
					
				</div>
			</footer>
		</div>
	</body>
</html>
