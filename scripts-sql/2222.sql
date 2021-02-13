create table devolucion(
id_dev serial primary key,
id_usuario int,
id_area int,
fecha date
)


create table detalledevolucion(
id_dev int,
id_prod int,
cant int
)



select * from correlativo

insert into correlativo values ('devolucion', 0)



select * from devolucion



select * from detalledevolucion


