<html>
	<head>
		<title>Limpieza | Modificar ingreso</title>
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
				<div class="container col-md-6 col-md-offset-3 jumbotron">
					<div class="text-center">
						<h2>Modificar ingreso</h2>
					</div>
					<form role="form" class="form-horizontal" method="POST" action="elemento.php">
						<input type="hidden" name="action" value="modificarIngreso">
						<input type="hidden" name="id" value="<?php echo $i->getId() ?>">
						<div class="form-group">
							<label for="nombre" class="col-sm-3 control-label">Nombre: </label>
							<div class="col-sm-7">
								<select class="form-control" name="elemento">
									<?php foreach($es as $e): ?>
									<?php 	if($e->getNombre() == $i->getElemento()->getNombre()): ?>
										<option value="<?php echo $e->getNombre(); ?>" selected="selected"><?php echo $e->getNombre(). " - ". $e->getUnidad(); ?></option>
									<?php 	else: ?>
										<option value="<?php echo $e->getNombre(); ?>"><?php echo $e->getNombre(). " - ". $e->getUnidad(); ?></option>
									<?php 	endif; ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="cantidad" class="col-sm-3 control-label">Cantidad: </label>
							<div class="col-sm-7">
								<input type="number" class="form-control" name="cantidad" value="<?php echo $i->getCantidad() ?>" required>
							</div>
						</div>
						<div class="form-group">
							<label for="fecha" class="col-sm-3 control-label">Fecha: </label>
							<div class="col-sm-7">
								<input type="date" class="form-control" name="fecha" value="<?php echo $i->getFecha() ?>" >
							</div>
						</div>
						<div class="form-group">
							<label for="expediente" class="col-sm-3 control-label">Expediente: </label>
							<div class="col-sm-7">
								<input type="text" class="form-control" name="expediente" value="<?php echo $i->getExpediente() ?>" required>
							</div>
						</div>
						<div class="form-group">
							<label for="comentario" class="col-sm-3 control-label">Comentario: </label>
							<div class="col-sm-7">
								<input type="text" class="form-control" name="comentario" value="<?php echo $i->getComentario() ?>" >
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
