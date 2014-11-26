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
INSERT INTO elemento(nombre, unidad) VALUES('Desinfectante en aerosol', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Lustra muebles aerosol', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Desodorante de piso', 'Litros');
INSERT INTO elemento(nombre, unidad) VALUES('Desinfectante para baño (respuesto)', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Desinfectante para baño con gatillo', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Secador de piso de goma', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Jabón líquido para manos', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Cera', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Limpiador cremoso', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Escobillón', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Pala para basura', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Repasador', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Franela', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Sopapa', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Virulana', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Estructura para mopa 60cm', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Mopa trapo 60cm', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Guantes de goma chico', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Guantes de goma mediano', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Guantes de goma grande', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Papel higiénico rollo 300m cono chico', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Papel higiénico rollo 50m', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Bolsas 60x90', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Bolsas 50x70', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Trapo de piso', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Esponja de acero', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Esponja amarilla', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Esponja con secador', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Cepillo con secador', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Trapo rejilla', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Líquido para lampazo', 'Litros');
INSERT INTO elemento(nombre, unidad) VALUES('Mango de madera para secador de piso', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Mango metálico para escobillón', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Mango metálico para mopa', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Cepillo para inodoro', 'Unitario');
INSERT INTO elemento(nombre, unidad) VALUES('Limpia vidrios', 'Unitario');
