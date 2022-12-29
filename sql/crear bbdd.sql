-- DB Jorge Val Gil

drop database if exists teis2_satpanel; -- Eliminamos la base de datos si existe


create database teis2_satpanel; -- Creamos la base de datos

use teis2_satpanel; -- Establemos nuestra db como principal


-- Creamos la tabla Roles
create table roles(
id bigint(20) not null auto_increment,
nombre_rol varchar(50) not null unique,
primary key(id)
);


-- Creamos la tabla Usuarios
create table usuarios (
id bigint(20) not null auto_increment,
nombre varchar(255) not null unique,
email varchar(50) not null unique,
contrasena varchar(255) not null,
rol_usuario bigint(20) not null,
PRIMARY KEY (id),
foreign key (rol_usuario) references roles(id)
);

-- Creamos la tabla Clientes
create table clientes (
dni varchar(9) not null unique,
nombre_apellidos varchar(255) not null,
email varchar(50) not null unique,
PRIMARY KEY (dni)
);

-- Creamos la tabla Etapas
create table etapas (
id bigint(20) not null auto_increment,
nombre varchar(255) not null unique,
PRIMARY KEY (id)
);

-- Creamos la tabla Tipo_Articulo
create table tipos_articulo (
id bigint(20) not null auto_increment,
nombre varchar(255) not null unique,
color varchar(255) not null unique,
PRIMARY KEY (id)
);

-- Creamos la Tabla Articulos 
create table articulos(
id bigint(20) not null auto_increment,
titulo varchar(255) not null,
descripcion varchar(255) not null,
comentarios_reparacion varchar(255) null,
precio DECIMAL(6,2) DEFAULT 0.00,
etapa varchar(255) default 'En espera - Tienda',
cliente varchar(9) not null,
tipo varchar(255) not null,
hora datetime DEFAULT CURRENT_TIMESTAMP,
primary key (id),
foreign key (etapa) references etapas(nombre),
foreign key (cliente) references clientes(dni),
foreign key (tipo) references tipos_articulo(nombre)
);


-- Creamos la Tabla Log_Modificacion
create table log_modificacion(
id bigint(20) not null auto_increment,
id_articulo bigint(20) not null,
etapa_origen varchar(255) not null,
etapa_destino varchar(255) not null,
hora datetime DEFAULT CURRENT_TIMESTAMP,
primary key (id),
foreign key (id_articulo) references articulos(id),
foreign key (etapa_origen) references etapas(nombre),
foreign key (etapa_destino) references etapas(nombre)
);