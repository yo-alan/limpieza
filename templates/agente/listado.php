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
	<body>
		<div class="container jumbotron">
			<header>
				<?php include_once "../templates/header.php"; ?>
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
		</div>
	</body>
</html>
