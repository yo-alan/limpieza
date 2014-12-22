<html>
	<head>
		<title>Limpieza | Ingreso de elementos</title>
		<link rel="shortcut icon" href="images/favicon.ico" />
		<link href="css/default.css" rel="stylesheet">
		<link href="css/bootstrap.css" rel="stylesheet">
		<script language="JavaScript" src="js/jquery.js"></script>
		<script language="JavaScript" src="js/bootstrap.js"></script>
		<script language="JavaScript" src="js/twitter-bootstrap-hover-dropdown.min.js"></script>
		<script language="JavaScript" src="js/selectProducto.js"></script>
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
				<div class="container col-md-6 col-md-offset-3 jumbotron">
					<div class="text-center">
						<h2>Registrar ingreso</h2>
					</div>
					<form role="form" class="form-horizontal" method="POST" action="elemento.php">
						<input type="hidden" name="action" value="ingreso">
						<div class="form-group">
							<label for="nombre" class="col-sm-3 control-label">Nombre: </label>
							<div class="col-sm-7">
								<select class="form-control" name="elemento" id="elemento" onchange="selectProducto();">
									<?php foreach($es as $e): ?>
										<?php if(isset($_GET['nombre']) && $_GET['nombre'] == $e->getNombre()): ?>
											<option selected="selected" value="<?php echo $e->getNombre(); ?>"><?php echo $e->getNombre(); ?></option>
										<?php else: ?>
											<option value="<?php echo $e->getNombre(); ?>"><?php echo $e->getNombre(); ?></option>
										<?php endif; ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label id="cantidad" for="cantidad" class="col-sm-3 control-label">Cantidad: </label>
							<div class="col-sm-7">
								<input type="number" class="form-control" name="cantidad" value="1" required>
							</div>
						</div>
						<?php $fecha = getDate(); ?>
						<?php $fecha = date("Y-m-d", strtotime($fecha["year"]. "-". $fecha["mon"]. "-". $fecha["mday"])); ?>
						<div class="form-group">
							<label for="fecha" class="col-sm-3 control-label">Fecha: </label>
							<div class="col-sm-7">
								<input type="date" class="form-control" name="fecha" value="<?php echo $fecha; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="expediente" class="col-sm-3 control-label">Expediente: </label>
							<div class="col-sm-7">
								<input type="text" class="form-control" name="expediente" required>
							</div>
						</div>
						<div class="form-group">
							<label for="comentario" class="col-sm-3 control-label">Comentario: </label>
							<div class="col-sm-7">
								<input type="text" class="form-control" name="comentario">
							</div>
						</div>
						<div class="form-group">
							<label for="usuario" class="col-sm-3 control-label">Usuario: </label>
							<div class="col-sm-7">
								<input type="text" class="form-control" name="usuario" value="<?php echo $_SESSION["usuario"] ?>" disabled>
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
