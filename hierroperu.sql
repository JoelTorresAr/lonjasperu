/*create table areas(
	codArea serial PRIMARY KEY,
	nombreArea varchar(30),
	descripcion text
);*/

--alter table area1 RENAME to areas;
/*
create table usuario1(
	codUsuario serial PRIMARY KEY,
	nombreUsuario varchar(200),
	dni varchar(8),
	usuario varchar(15),
	contraseña varchar(15),
	permiso boolean,
	estado boolean,
	codArea int
);*/

--alter table usuario RENAME to usuario1;

/*alter table usuario1 add constraint FK_usuario_codArea foreign key (codArea) references areas(codArea);*/



--create table analisisABC(
--	cantidadPedida
--	costoUnitario
--	valorPedido
--	participacion
--	participacionAcumulada
--)



CREATE TABLE area
(
  codigo_area serial NOT NULL,
  nombre character varying(50) NOT NULL,
  descripcion text,
  CONSTRAINT pk_area PRIMARY KEY (codigo_area)
);

--select codigo_area, descripcion from area where codigo_area>0

CREATE TABLE cargo
(
  codigo_cargo serial NOT NULL,
  descripcion character varying(50) NOT NULL,
  CONSTRAINT pk_cargo PRIMARY KEY (codigo_cargo)
);

CREATE TABLE personal
(
  dni character(8) NOT NULL,
  apellido_paterno character varying(30) NOT NULL,
  apellido_materno character varying(30) NOT NULL,
  nombres character varying(30) NOT NULL,
  direccion character varying(50) NOT NULL,
  telefono_fijo character varying(20),
  telefono_movil1 character varying(20),
  telefono_movil2 character varying(20),
  email character varying(50) NOT NULL,
  codigo_cargo integer NOT NULL,
  codigo_area integer NOT NULL,
  dni_jefe character(8),
  CONSTRAINT pk_personal PRIMARY KEY (dni),
  CONSTRAINT fk_personal_area FOREIGN KEY (codigo_area)
      REFERENCES area (codigo_area) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT fk_personal_cargo FOREIGN KEY (codigo_cargo)
      REFERENCES cargo (codigo_cargo) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT fk_personal_personal FOREIGN KEY (dni_jefe)
      REFERENCES personal (dni) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT uni_email UNIQUE (email)
);

CREATE TABLE usuario
(
  codigo_usuario integer NOT NULL,
  dni_usuario character(8) NOT NULL,
  clave character(32) NOT NULL,
  estado character(1) NOT NULL,
  CONSTRAINT pk_usuario PRIMARY KEY (codigo_usuario),
  CONSTRAINT fk_usuario_personal FOREIGN KEY (dni_usuario)
      REFERENCES personal (dni) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT uni_dni_usuaio UNIQUE (dni_usuario)
);




create table pedido(
	codPedido serial PRIMARY KEY,
	codigo_usuario int,
	fechaPedido timestamp
);

alter table pedido add constraint FK_pedido_codUsuario foreign key (codigo_usuario) references usuario(codigo_usuario);

create table producto(
	codProducto serial PRIMARY KEY,
	nombre varchar(50),
	precio money,
	stock int,
	descripcion text
);



create table proveedor(
	codProveedor serial PRIMARY KEY,
	razonSocial varchar(100),
	razonComercial varchar(100),
	ruc varchar(11),
	direccion varchar(100)
);



create table compra(
	codCompra serial PRIMARY KEY,
	codProveedor int,
	neto int, 
	fechaCompra timestamp
);

alter table compra add constraint FK_compra_proveedor foreign key (codProveedor) references proveedor(codProveedor);

create table detallePedido(
	codPedido int,
	codProducto int,
	cantidad int, 
	fechaPedido timestamp,
	descripcion text,
	estado bit,
	PRIMARY KEY(codPedido, codProducto)
);

alter table detallePedido add constraint FK_detPed_prod foreign key (codProducto) references producto(codProducto);
alter table detallePedido add constraint FK_detPed_pedi foreign key (codPedido) references pedido(codPedido);



create table detalleCompra(
	codProducto int,
	codCompra int,
	tipoDocumento boolean,
	serieDocumento int,
	nroDocumento int,
	cantidad int,
	fechaCompra timestamp,
	precioCompra money,
	PRIMARY KEY(codProducto, codCompra)
);

alter table detalleCompra add constraint FK_detCom_prod foreign key (codProducto) references producto(codProducto);
alter table detalleCompra add constraint FK_detCom_Comp foreign key (codCompra) references compra(codCompra);

create table movimientoKardex(
	codKardex serial PRIMARY KEY,
	tipoMovimiento boolean,
	fechaMovimiento timestamp,
	cantidadMovimiento int,
	saldo money,
	descripcion text,
	codPedido int,
	codProducto int,
	codCompra int
);

alter table movimientoKardex add constraint FK_kard_pedi foreign key (codPedido) references pedido(codPedido);
alter table movimientoKardex add constraint FK_kard_prod foreign key (codProducto) references producto(codProducto);
alter table movimientoKardex add constraint FK_kard_Comp foreign key (codCompra) references compra(codCompra);

