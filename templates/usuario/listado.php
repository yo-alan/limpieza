<html>
	<head>
		<title>Limpieza | Listado de usuarios</title>
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
				<div class="container col-md-10 col-md-offset-1">
					<div class="text-center">
						<h2>Usuarios</h2>
					</div>
					<table class="table table-striped table-bordered tablaData">
						<thead>
							<tr>
								<th>Usuario</th>
								<th>Nivel</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($us as $u):?>
							<tr>
								<td><?php echo $u->getNombre() ?></td>
								<td><?php echo $u->getNivel() ?></td>
								<td>
									<div class="btn btn-group">
										<a class="btn btn-default " title="Editar" href="?action=editar&id=<?php echo $u->getId() ?>">
											<i class="glyphicon glyphicon-pencil"></i>
										</a>
										<a class="btn btn-danger" title="Eliminar" href="?action=eliminar&id=<?php echo $u->getId() ?>">
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
		</div>
	</body>
</html>
