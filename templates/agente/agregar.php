<html>
	<head>
		<title>Limpieza | Agregar un agente nuevo</title>
		<link rel="shortcut icon" href="images/favicon.ico" />
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
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Ingreso <span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="elemento.php?action=ingreso">Registrar ingreso</a></li>
										<li><a href="elemento.php?action=historialIngreso">Historial</a></li>
									</ul>
								</li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Retiro <span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="elemento.php?action=retiro">Registrar retiro</a></li>
										<li><a href="elemento.php?action=historialRetiro">Historial</a></li>
									</ul>
								</li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Agentes <span class="caret"></span></a>
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
					<h2>Nuevo agente</h2>
				</div>
				<form role="form" class="form-horizontal" method="POST" action="agente.php">
					<input type="hidden" name="action" value="agregar">
					<div class="form-group">
						<label for="nombre" class="col-sm-3 control-label">Nombre: </label>
						<div class="col-sm-7">
							<input type="text" class="form-control" name="nombre" required>
						</div>
					</div>
					<div class="form-group">
						<label for="apellido" class="col-sm-3 control-label">Apellido: </label>
						<div class="col-sm-7">
							<input type="text" class="form-control" name="apellido" required>
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
