DROP TABLE IF EXISTS agente;

CREATE TABLE agente(
	
	id int auto_increment,
	nombre varchar(50) NOT NULL,
	apellido varchar(50) NOT NULL,
	
	CONSTRAINT pk_agente
		PRIMARY KEY (id)
);
