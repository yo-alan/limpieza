<html>
	<head>
		<title>Limpieza | Sistema de seguimiento de stock</title>
		<meta charset="utf-8">
		<style><?php include '../templates/css/default.css'; ?></style>
		<style><?php include '../templates/css/bootstrap.css'; ?></style>
		<script><?php include '../templates/js/jquery.js'; ?></script>
		<script><?php include '../templates/js/bootstrap.js'; ?></script>
		<script><?php include '../templates/js/twitter-bootstrap-hover-dropdown.min.js'; ?></script>
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
										<li><a href="elemento.php?action=agregar">Agregar</a></li>
									</ul>
								</li>
								<li class="dropdown">
									<a href="agente.php" class="dropdown-toggle" data-hover="dropdown">Agentes <span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="agente.php?action=agregar">Agregar</a></li>
									</ul>
								</li>
							</ul>
						</div><!-- /.navbar-collapse -->
					</div><!-- /.container-fluid -->
				</nav>
			</div>
		</header>
		<article>
			<div class="container row clearfix col-md-6 col-md-offset-3 alert alert-success">
				<div class="text-center">
					<h2>Agregar elemento</h2>
				</div>
				<form role="form" class="form-horizontal" method="POST" action="elemento.php">
					<input type="hidden" name="action" value="agregar">
					<div class="form-group">
						<label for="nombre" class="col-sm-3 control-label">Nombre</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="nombre">
						</div>
						<div class="col-sm-3">
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
