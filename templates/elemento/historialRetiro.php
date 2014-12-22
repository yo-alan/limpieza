<html>
	<head>
		<title>Limpieza | Historial de ingresos</title>
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
				<div class="container col-md-10 col-md-offset-1">
					<div class="text-center">
						<h2>Historial de retiros</h2>
					</div>
					<a class="btn btn-primary" href="?action=imprimirRetiros">Imprimir historial</a>
					<table class="table table-striped table-bordered tablaData">
						<thead>
							<tr>
								<th>Fecha</th>
								<th>Agente</th>
								<th>Elemento</th>
								<th>Cantidad</th>
								<th>Usuario</th>
								<th>Comentario</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($rs as $r):?>
							<tr>
								<td><?php echo $r->getFecha() ?></td>
								<td><?php echo $r->getAgente()->getApellido(). ", ". $r->getAgente()->getNombre() ?></td>
								<td><?php echo $r->getElemento()->getNombre() ?></td>
								<td><?php echo $r->getCantidad() ?></td>
								<td><?php echo $r->getUsuario()->getNombre() ?></td>
								<td><?php echo $r->getComentario() ?></td>
								<td>
									<div class="btn btn-group">
										<a class="btn btn-default" title="Modificar" href="?action=modificarRetiro&id=<?php echo $r->getId() ?>">
											<i class="glyphicon glyphicon-pencil"></i>
										</a>
										<a class="btn btn-danger disabled" title="Eliminar" href="?action=eliminarRetiro&id=<?php echo $r->getId() ?>">
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
