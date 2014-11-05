DROP TABLE IF EXISTS ingreso;

CREATE TABLE ingreso(
	
	id int auto_increment,
	elemento varchar(100) UNIQUE NOT NULL,
	cantidad int NOT NULL,
	fecha date NOT NULL,
	expediente varchar(20) NOT NULL,
	comentario text NOT NULL,
	
	CONSTRAINT pk_ingreso
		PRIMARY KEY (id),
	
	CONSTRAINT fk_elemento
		FOREIGN KEY (elemento)
		REFERENCES elemento (nombre)
);
