DROP TABLE IF EXISTS usuario;

CREATE TABLE usuario(
	
	id int auto_increment,
	nombre varchar(50) UNIQUE NOT NULL,
	contrasena varchar(70) NOT NULL,
	nivel enum('Administrador', 'Normal') NOT NULL,
	
	CONSTRAINT pk_usuario
		PRIMARY KEY (id)
);
