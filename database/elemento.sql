DROP TABLE IF EXISTS elemento;

CREATE TABLE elemento(
	
	id int auto_increment,
	nombre varchar(100) UNIQUE NOT NULL,
	unidad enum('Kilos', 'Litros', 'Rollos', 'Unitario') NOT NULL,
	stock float unsigned DEFAULT 0,
	
	CONSTRAINT pk_elemento
		PRIMARY KEY (id)
	
);

INSERT INTO elemento(nombre, unidad) VALUES('Lavandina', 'Litros');
INSERT INTO elemento(nombre, unidad) VALUES('Detergente', 'Litros');
INSERT INTO elemento(nombre, unidad) VALUES('Trapo de piso', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Desinfectante en aerosol', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Lustra muebles', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Desodorante de piso', 'Litros');
INSERT INTO elemento(nombre, unidad) VALUES('Repuesto Mr. Musculo', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Secador de goma negro', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Secador de goma negro', 'Unitario');
