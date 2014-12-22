DROP TABLE IF EXISTS retiro;

CREATE TABLE retiro(
	
	id int auto_increment,
	agente int NOT NULL,
	elemento varchar(100) NOT NULL,
	fecha date NOT NULL,
	fecha_hora datetime NOT NULL,
	cantidad int NOT NULL,
	usuario int NOT NULL,
	comentario text,
	
	CONSTRAINT pk_retiro
		PRIMARY KEY (id),
	
	CONSTRAINT fk_agente
		FOREIGN KEY (agente)
		REFERENCES agente (id),
	
	CONSTRAINT fk_elemento_retiro
		FOREIGN KEY (elemento)
		REFERENCES elemento (nombre),
	
	CONSTRAINT fk_usuario_retiro
		FOREIGN KEY (usuario)
		REFERENCES usuario (id)
);
