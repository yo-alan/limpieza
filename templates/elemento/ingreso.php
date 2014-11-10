<html>
	<head>
		<title>Limpieza | Ingreso de elementos</title>
		<meta charset="utf-8">
		<style><?php include '../templates/css/default.css'; ?></style>
		<style><?php include '../templates/css/bootstrap.css'; ?></style>
		<script><?php include '../templates/js/jquery.js'; ?></script>
		<script><?php include '../templates/js/bootstrap.js'; ?></script>
		<script><?php include '../templates/js/twitter-bootstrap-hover-dropdown.min.js'; ?></script>
		<script>
			function elementoChange(){
				document.getElementByName("expediente").value = "HOLA";
			}
		</script>
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
										<li><a href="elemento.php?action=ingreso">Ingreso</a></li>
									</ul>
								</li>
								<li class="dropdown">
									<a href="agente.php" class="dropdown-toggle" data-hover="dropdown">Agentes <span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="agente.php?action=ingreso">Ingreso</a></li>
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
					<h2>Registrar ingreso</h2>
				</div>
				<form role="form" class="form-horizontal" method="POST" action="elemento.php">
					<input type="hidden" name="action" value="ingreso">
					<div class="form-group">
						<label for="nombre" class="col-sm-3 control-label">Nombre: </label>
						<div class="col-sm-7">
							<select class="form-control" name="elemento" onChange="elementoChange()">
								<?php foreach($es as $e): ?>
								<option value="<?php echo $e->getNombre(); ?>"><?php echo $e->getNombre(); ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="cantidad" class="col-sm-3 control-label">Cantidad (<?php echo $e->getUnidad(); ?>): </label>
						<div class="col-sm-7">
							<input type="number" class="form-control" name="cantidad">
						</div>
					</div>
					<div class="form-group">
						<label for="fecha" class="col-sm-3 control-label">Fecha: </label>
						<div class="col-sm-7">
							<input type="date" class="form-control" name="fecha">
						</div>
					</div>
					<div class="form-group">
						<label for="expediente" class="col-sm-3 control-label">Expediente: </label>
						<div class="col-sm-7">
							<input type="text" class="form-control" name="expediente">
						</div>
					</div>
					<div class="form-group">
						<label for="comentario" class="col-sm-3 control-label">Comentario: </label>
						<div class="col-sm-7">
							<input type="text" class="form-control" name="comentario">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-4 col-md-offset-7">
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
