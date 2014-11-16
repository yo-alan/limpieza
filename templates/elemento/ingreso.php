<html>
	<head>
		<title>Limpieza | Ingreso de elementos</title>
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
							<a class="navbar-brand" href="index.php">Inicio</a>
						</div>
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav">
								<li class="dropdown">
									<a href="elemento.php" class="dropdown-toggle" data-hover="dropdown">Elementos <span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="elemento.php?action=ingreso">Registrar ingreso</a></li>
									</ul>
<!--
								</li>
								<li class="dropdown">
									<a href="agente.php" class="dropdown-toggle" data-hover="dropdown">Agentes <span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="agente.php?action=ingreso">Ingreso</a></li>
									</ul>
								</li>
-->
							</ul>
						</div><!-- /.navbar-collapse -->
					</div><!-- /.container-fluid -->
				</nav>
			</div>
		</header>
		<article>
			<div class="container col-md-6 col-md-offset-3 jumbotron">
				<div class="text-center">
					<h2>Registrar ingreso</h2>
				</div>
				<form role="form" class="form-horizontal" method="POST" action="elemento.php">
					<input type="hidden" name="action" value="ingreso">
					<div class="form-group">
						<label for="nombre" class="col-sm-3 control-label">Nombre: </label>
						<div class="col-sm-7">
							<select class="form-control" name="elemento">
								<?php foreach($es as $e): ?>
								<option value="<?php echo $e->getNombre(); ?>"><?php echo $e->getNombre(). " - ". $e->getUnidad(); ?></option>
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
