<html>
	<head>
		<title>Limpieza | Listado de agentes</title>
		<link rel="shortcut icon" href="images/favicon.ico" />
		<link href="css/default.css" rel="stylesheet">
		<link href="css/bootstrap.css" rel="stylesheet">
		<script language="JavaScript" src="js/jquery.js"></script>
		<script language="JavaScript" src="js/bootstrap.js"></script>
		<script language="JavaScript" src="js/twitter-bootstrap-hover-dropdown.min.js"></script>
        <link rel="stylesheet" href="css/jquery.dataTables.css">
        <link rel="stylesheet" href="css/jquery.dataTables_themeroller.css">
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/listadosTabla.js"></script>
	</head>
	<body style="background-color: #0174DF;">
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
			<div class="container col-md-10 col-md-offset-1 jumbotron">
				<table class="table table-striped tablaData">
					<thead>
						<tr>
							<th>Agente</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($as as $a):?>
						<tr>
							<td><?php echo $a->getApellido(). ", ". $a->getNombre() ?></td>
							<td>
								<div class="btn btn-group">
									<a class="btn btn-default " title="Editar" href="?action=editar&id=<?php echo $a->getId() ?>">
										<i class="glyphicon glyphicon-pencil"></i>
									</a>
									<a class="btn btn-danger disabled" title="Eliminar" href="?action=eliminar&id=<?php echo $a->getId() ?>">
										<i class="glyphicon glyphicon-minus"></i>
									</a>
								</div>
							</td>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</article>
		<footer>
			<div class="container">
				
			</div>
		</footer>
	</body>
</html>