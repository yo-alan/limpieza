<html>
	<head>
		<title>Limpieza | Sistema de seguimiento de stock</title>
		<meta charset="utf-8">
		<link href="css/default.css" rel="stylesheet">
		<link href="css/bootstrap.css" rel="stylesheet">
		<script language="JavaScript" src="js/jquery.js"></script>
		<script language="JavaScript" src="js/bootstrap.js"></script>
		<script language="JavaScript" src="js/twitter-bootstrap-hover-dropdown.min.js"></script>
	</head>
	<body>
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
									<li><a href="elemento.php?action=retiro">Registrar retiro</a></li>
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
		<?php if(isset($estado)): ?>
		<div class="container col-md-6 col-md-offset-3">
			<div class="panel panel-<?php echo $estado; ?>">
				<div class="panel-heading">
					<?php if($estado == "success"): ?>
						<h3 class="panel-title"><strong>Información:</strong></h3>
					<?php else: ?>
						<h3 class="panel-title"><strong>Ocurrió un error:</strong></h3>
					<?php endif; ?>
				</div>
				<div class="panel-body">
					<p class="text-<?php echo $estado; ?> text-center">
						<?php echo $mensaje; ?>
					</p>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<div class="col-md-12">
			<?php  ?>
		</div>
		<div class="container">
			
		</div>
	</body>
</html>
