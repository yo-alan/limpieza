<div class="container col-md-10 col-md-offset-1">
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
					<?php if($_SESSION['nivel'] == "Administrador"): ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Agentes <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="agente.php?action=agregar">Agregar</a></li>
							<li><a href="agente.php?action=listado">Listado</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuarios <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="usuario.php?action=agregar">Agregar</a></li>
							<li><a href="usuario.php?action=listado">Listado</a></li>
						</ul>
					</li>
					<?php endif; ?>
					<li class="dropdown">
						<a href="index.php?action=acerca_de" class="dropdown" data-hover="dropdown">Acerca de...</a>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<?php if(isset($_SESSION['usuario'])): ?>
						<li class="dropdown">
							<a href="usuario.php?action=salir" class="dropdown">Cerrar sesión</a>
						</li>
					<?php endif; ?>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
</div>
