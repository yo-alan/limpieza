<html>
	<head>
		<title>Limpieza | Editar un usuario</title>
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
				<div class="container col-md-6 col-md-offset-3 jumbotron">
					<div class="text-center">
						<h2>Eliminar usuario</h2>
					</div>
					<form role="form" class="form-horizontal" method="POST" action="usuario.php">
						<input type="hidden" name="action" value="eliminar">
						<input type="hidden" name="id" value="<?php echo $u->getId() ?>">
						<div class="form-group">
							<p class="control-label">
								¿Estás seguro de querer eliminar "<strong><?php echo $u->getNombre() ?></strong>"?
							</p>
							<div class="col-sm-offset-4 col-sm-9">
								<button type='submit' class='btn btn-primary'>Eliminar</button>
								<a href="usuario.php" class='btn btn-default'>Cancelar</a>
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
