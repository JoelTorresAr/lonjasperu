CREATE OR REPLACE FUNCTION f_listar_participacion(IN p_fecha_ini date, IN p_fecha_fin date)
  RETURNS TABLE(codproducto integer, insumo character varying, cantidad integer, precio integer, valor_pedido numeric,participacion numeric, rownum int, pa numeric) AS
$BODY$
	declare p_fecha_ini alias for $1;
	declare p_fecha_fin alias for $2;
	BEGIN
	DROP TABLE IF EXISTS tmp;
	CREATE TEMPORARY TABLE IF NOT EXISTS tmp (codproducto int, insumo  character varying,cantidad int,precio int,valor_pedido numeric,participacion numeric,rownum int);

	insert into tmp(codproducto, insumo,cantidad,precio,valor_pedido,participacion,rownum)
		
	select 	p.codproducto,p.nombre insumo, 
		sum(dp.cantidad)::integer cantidad, 
		p.precio::integer,
		round(sum(dp.cantidad) * p.precio):: numeric ,
		round(round(sum(dp.cantidad) * p.precio)/(
							select sum(v.valor_pedido) 
							from vista_pedido v
							where v.fechaPedido between p_fecha_ini and p_fecha_fin
							),2) as participacion,
		row_number() over (order by round(sum(dp.cantidad) * p.precio) desc nulls last) as rownum
		
	from detallepedido dp inner join producto p on dp.codproducto = p.codproducto 
	inner join pedido pe on dp.codpedido = pe.codpedido
	where pe.fechaPedido between p_fecha_ini and p_fecha_fin
	group by p.codproducto, p.nombre, p.precio
	order by valor_pedido desc;
		
		return query
	select 	*, 
		(select sum(t.participacion)
		from 	tmp t
		where 	t.rownum<=v.rownum
		)
	from 	tmp v;

	End	

$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION f_listar_participacion(IN p_fecha_ini date, IN p_fecha_fin date)
  OWNER TO postgres;

SELECT * FROM f_listar_participacion('2017-12-05','2017-12-09')
SELECT * FROM PEDIDO




CREATE OR REPLACE FUNCTION f_listar_detalle(IN p_cod_pedido integer)
  RETURNS TABLE(codproducto integer, nombreprod character varying, cantidad text, stock numeric, pendiente numeric, cant_num numeric, atendido numeric, idunidad integer, unidad character varying, precio numeric) AS
$BODY$

	declare p_cod_pedido alias for $1;

	begin
		return query

		select 
			dp.codproducto,
			initcap(pr.nombre)::character varying,
			cast(dp.cantidad as text) || ' ' || um.nombre :: character varying as cantidad,
			pr.stock,
			dp.pendiente,
			dp.cantidad,
            dp.atendido,
            dp.unidadpedido as idunidad,
            um.nombre as unidad,
            pr.precio
            
		from
			detallepedido dp
			inner join producto pr on (dp.codproducto = pr.codproducto)
			inner join unidad_medida um on (dp.unidadpedido = um.idunid)
		where
			dp.codpedido = p_cod_pedido;
	
	end

$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION f_listar_detalle(integer)
  OWNER TO postgres;
