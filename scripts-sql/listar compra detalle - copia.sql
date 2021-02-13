create or replace function f_listar_detalle_devolucion (p_cod_devolucion integer)
returns table
(
	codigo integer,
	nombre character varying,
	cantidad integer
) as

$body$
	declare p_cod_devolucion alias for $1;

	begin
		return query

		select 
			dd.id_prod,
			pr.nombre,
			dd.cant
			
		from
			detalledevolucion dd
			inner join producto pr on dd.id_prod = pr.codproducto
		where
			dd.id_dev =  p_cod_devolucion;
	
	end

$body$
language plpgsql;


select * from f_listar_detalle_devolucion(1)

select * from detalledevolucion

select * from compra

select * from producto