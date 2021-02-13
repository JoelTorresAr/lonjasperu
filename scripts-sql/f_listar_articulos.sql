create or replace function f_listar_articulo( p_codigo_marca integer )
returns table
(
	codigo integer,
	nombre character varying,
	precio numeric,
	marca character varying
)as
$body$
	declare p_codigo_marca alias for $1;
	
	begin
		return query
		select
			a.codigo_articulo,
			a.nombre,
			a.precio_venta,
			m.descripcion
		from
			articulo a 
			inner join marca m on ( a.codigo_marca = m.codigo_marca )
		where
			(case p_codigo_marca
				when 0 then 
					true
				else
					a.codigo_marca = p_codigo_marca
			end)
		order by
			a.nombre;
	end
$body$
language plpgsql;

select * from f_listar_articulo(1);