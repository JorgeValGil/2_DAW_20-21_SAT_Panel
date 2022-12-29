/**DATOS BBDD SATPANEL - Jorge Val Gil*/
USE teis2_satpanel;


/**Datos tabla roles*/
INSERT INTO roles(ID,NOMBRE_ROL)
VALUES(1,'Tenda'),
(2,'Taller');


/**Datos tabla usuarios*/
INSERT INTO usuarios(NOMBRE,EMAIL,CONTRASENA,ROL_USUARIO)
VALUES('jorge_taller','jorge_taller@hotmail.com','$2y$10$SRRxNP9fud.dL2EBCMGDJ.eHIxn0FbsGeGXzpe4LDPTR3tF6Lgmh2',2),
('jorge_tenda','jorge_tenda4@gmail.com','$2y$10$SRRxNP9fud.dL2EBCMGDJ.eHIxn0FbsGeGXzpe4LDPTR3tF6Lgmh2',1),
('profe_tenda','profe_tenda@gmail.com','$2y$10$SRRxNP9fud.dL2EBCMGDJ.eHIxn0FbsGeGXzpe4LDPTR3tF6Lgmh2',1),
('profe_taller','profe_taller@gmail.com','$2y$10$SRRxNP9fud.dL2EBCMGDJ.eHIxn0FbsGeGXzpe4LDPTR3tF6Lgmh2',2);


/**Datos tabla clientes*/
INSERT INTO clientes(DNI,NOMBRE_APELLIDOS,EMAIL)
VALUES('12345678H','Jorge Val Gil','jorge@hotmail.com'),
('87654321A','Adrián Apellido Apellido','adrian@gmail.com'),
('98798798F','Carlos Apellido Apellido','carlos@gmail.com'),
('65465465M','Brais Apellido Apellido','brais@gmail.com');


/**Datos tabla etapas*/
INSERT INTO etapas(NOMBRE)
VALUES('En espera - Tienda'),
('En espera - Taller'),
('En reparación'),
('Pendiente Cliente'),
('Pendiente Pieza'),
('Finalizado');


/**Datos tabla tipos_articulo*/
INSERT INTO tipos_articulo(NOMBRE,COLOR)
VALUES('ORDENADOR TORRE','YELLOW'),
('ORDENADOR PORTATIL','ORANGE'),
('TABLET','LIME'),
('SMARTPHONE','RED'),
('TV/AUDIO','CYAN'),
('OTROS','VIOLET');

/**Datos tabla articulos*/
INSERT INTO articulos(TITULO,DESCRIPCION,CLIENTE,TIPO)
VALUES('ACER E1-570G','Publicidade no navegador Web.','12345678H','ORDENADOR PORTATIL'),
('Xiaomi Redmi Note 7','Erro ao abrir a aplicación da cámara.','12345678H','SMARTPHONE'),
('Samsung Galaxy S10','Presupostasr cambiod e pantalla máis copia de seguridade','87654321A','ORDENADOR PORTATIL'),
('Seagate Barracuda 1TB','Non se recoñece ao conectar a un ordenador. Recuperar información.','87654321A','OTROS'),
('HP Pavilion Gaming TG01','Non mostra video.','98798798F','ORDENADOR TORRE'),
('Lenovo IdeaCentre G5','Apágase aos 30 minutos de uso, logo tarda bastante tempo en volver a encender. Posible problemas de temperatura.','98798798F','ORDENADOR TORRE'),
('LG 50UP75006LF 50"','Problemas ao instalar aplicaciones.','65465465M','TV/AUDIO'),
('Lenovo Tab M10 HD Plus 10.1"','Presupostar cabio de pantalla e conectar de carga.','65465465M','TABLET');

