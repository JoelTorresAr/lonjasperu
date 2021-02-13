-- Function: f_listar_articulo(integer, integer, integer)

-- DROP FUNCTION f_listar_articulo(integer, integer, integer);

CREATE OR REPLACE FUNCTION f_listar_articulo(IN p_codigo_marca integer, IN p_codigo_linea integer, IN p_codigo_categoria integer)
  RETURNS TABLE(codigo integer, nombre character varying, precio numeric, marca character varying, linea character varying, categoria character varying) AS
$BODY$
	declare p_codigo_marca alias for $1;
	declare p_codigo_linea alias for $2;
	declare p_codigo_categoria alias for $3;
	
	begin
		return query
		select
			a.codigo_articulo,
			a.nombre,
			a.precio_venta,
			m.descripcion,
			l.descripcion,
			c.descripcion
		from
			articulo a 
			inner join marca m on ( a.codigo_marca = m.codigo_marca )
			inner join categoria c on ( a.codigo_categoria = c.codigo_categoria )
			inner join linea l on ( c.codigo_linea = l.codigo_linea )
		where
			(case p_codigo_marca
				when 0 then 
					1=1
				else
					a.codigo_marca = p_codigo_marca
			end)
			
			and --y
			
			(case p_codigo_linea
				when 0 then 
					1=1
				else
					c.codigo_linea = p_codigo_linea
			end)

			and --y
			
			(case p_codigo_categoria
				when 0 then 
					1=1
				else
					a.codigo_categoria = p_codigo_categoria
			end)
			
		order by
			a.nombre;
	end
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION f_listar_articulo(integer, integer, integer)
  OWNER TO postgres;
