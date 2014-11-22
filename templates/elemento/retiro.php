<html>
	<head>
		<title>Limpieza | Retirar elementos</title>
		<link href="css/default.css" rel="stylesheet">
		<link href="css/bootstrap.css" rel="stylesheet">
		<script language="JavaScript" src="js/jquery.js"></script>
		<script language="JavaScript" src="js/bootstrap.js"></script>
		<script language="JavaScript" src="js/twitter-bootstrap-hover-dropdown.min.js"></script>
	</head>
	<body>
		<header>
			<div class="container">
				<nav class="navbar navbar-default" role="navigation">
					<div class="container-fluid">
						<div class="navbar-header">
							<a class="navbar-brand" href="index.php">Limpieza</a>
						</div>
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav">
								<li class="dropdown">
									<a href="elemento.php?action=historialIngreso" class="dropdown-toggle" data-hover="dropdown">Ingreso <span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="elemento.php?action=ingreso">Registrar ingreso</a></li>
										<li><a href="elemento.php?action=historialIngreso">Historial</a></li>
									</ul>
								</li>
								<li class="dropdown">
									<a href="elemento.php?action=historialRetiro" class="dropdown-toggle" data-hover="dropdown">Retiro <span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="elemento.php?action=retiro">Registrar retiro</a></li>
										<li><a href="elemento.php?action=historialRetiro">Historial</a></li>
									</ul>
								</li>
								<li class="dropdown">
									<a href="agente.php" class="dropdown-toggle" data-hover="dropdown">Agentes <span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="agente.php?action=agregar">Agregar</a></li>
									</ul>
								</li>
								<li class="dropdown">
									<a href="elemento.php" class="dropdown-toggle" data-hover="dropdown">Ver Stock</a>
								</li>
							</ul>
						</div><!-- /.navbar-collapse -->
					</div><!-- /.container-fluid -->
				</nav>
			</div>
		</header>
		<article>
			<div class="container row clearfix col-md-6 col-md-offset-3 jumbotron">
				<div class="text-center">
					<h2>Registrar retiro de elementos</h2>
				</div>
				<form role="form" class="form-horizontal" method="POST" action="elemento.php">
					<input type="hidden" name="action" value="retiro">
					<div class="form-group">
						<label for="agente" class="col-sm-3 control-label">Agente: </label>
						<div class="col-sm-7">
							<select class="form-control" name="agente">
								<?php foreach($as as $a): ?>
								<option value="<?php echo $a->getId(); ?>"><?php echo $a->getApellido(). ", ". $a->getNombre(); ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="elemento" class="col-sm-3 control-label">Elemento: </label>
						<div class="col-sm-7">
							<select class="form-control" name="elemento">
								<?php foreach($es as $e): ?>
									<?php if($e->getStock() > 0): ?>
									<option value="<?php echo $e->getNombre(); ?>"><?php echo $e->getNombre(). " - ". $e->getUnidad(); ?></option>
									<?php endif; ?>
									<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="cantidad" class="col-sm-3 control-label">Cantidad: </label>
						<div class="col-sm-7">
							<input type="number" class="form-control" name="cantidad" required>
						</div>
					</div>
					<?php $fecha = getDate(); ?>
					<div class="form-group">
						<label for="fecha" class="col-sm-3 control-label">Fecha: </label>
						<div class="col-sm-7">
							<input type="date" class="form-control" name="fecha" value="<?php echo $fecha["year"]. "-". $fecha["mon"]. "-". $fecha["mday"]; ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="comentario" class="col-sm-3 control-label">Comentario: </label>
						<div class="col-sm-7">
							<input type="text" class="form-control" name="comentario">
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
	</body>
</html>
