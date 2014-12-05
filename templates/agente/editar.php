<html>
	<head>
		<title>Limpieza | Editar un agente</title>
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
								<?php echo $_GET["mensaje"]; ?>
							</p>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<div class="container col-md-6 col-md-offset-3 jumbotron">
					<div class="text-center">
						<h2>Editar agente</h2>
					</div>
					<form role="form" class="form-horizontal" method="POST" action="agente.php">
						<input type="hidden" name="action" value="editar">
						<input type="hidden" name="id" value="<?php echo $a->getId() ?>" >
						<div class="form-group">
							<label for="nombre" class="col-sm-3 control-label">Nombre: </label>
							<div class="col-sm-7">
								<input type="text" class="form-control" name="nombre" value="<?php echo $a->getNombre() ?>" required>
							</div>
						</div>
						<div class="form-group">
							<label for="apellido" class="col-sm-3 control-label">Apellido: </label>
							<div class="col-sm-7">
								<input type="text" class="form-control" name="apellido" value="<?php echo $a->getApellido() ?>" required>
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
