<html>
	<head>
		<title>Limpieza | Sistema de seguimiento de stock</title>
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
					<div class="text-left">
						<h2>Stock de elementos</h2>
					</div>
					<div class="text-right">
						<a class="btn btn-primary" href="elemento.php?action=imprimirStock">Imprimir Stock</a>
					</div>
					<table class="table table-striped table-bordered tablaData">
						<thead>
							<tr>
								<th>Producto</th>
								<th>Unidad de medida</th>
								<th>Stock</th>
								<th>Ingresar/Retirar</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($es as $e):?>
							<tr>
								<td><?php echo $e->getNombre() ?></td>
								<td><?php echo $e->getUnidad() ?></td>
								<td><?php echo $e->getStock() ?></td>
								<td>
									<div class="btn btn-group">
										<a class="btn btn-success" title="Ingresar" href="elemento.php?action=ingreso&nombre=<?php echo $e->getNombre() ?>">
											<i class="glyphicon glyphicon-plus"></i>
										</a>
										<?php if($e->getStock() > 0): ?>
										<a class="btn btn-danger" title="Retirar" href="elemento.php?action=retiro&nombre=<?php echo $e->getNombre() ?>">
											<i class="glyphicon glyphicon-minus"></i>
										</a>
										<?php else: ?>
										<a class="btn btn-danger disabled" title="Retirar" href="elemento.php?action=retiro&nombre=<?php echo $e->getNombre() ?>">
											<i class="glyphicon glyphicon-minus"></i>
										</a>
										<?php endif; ?>
									</div>
								</td>
							<?php endforeach;?>
						</tbody>
					</table>
				</div>
			</article>
			<footer>
				<div class="container">
					<p class="text-right">
						Aplicación desarrollada por Alan Marchán, Depto. Informática.
					</p>
				</div>
			</footer>
		</div>
	</body>
</html>
