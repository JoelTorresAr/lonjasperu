create or replace function f_listar_detalle (p_cod_pedido integer)
returns table
(
	codproducto integer,
	nombreprod character varying,
	cantidad text,
	stock integer,
	pendiente integer,
	cant_num integer
) as

$body$
	declare p_cod_pedido alias for $1;

	begin
		return query

		select 
			dp.codproducto,
			initcap(pr.nombre)::character varying,
			cast(dp.cantidad as text) || ' ' || um.nombre :: character varying as cantidad,
			pr.stock,
			dp.pendiente,
			dp.cantidad 
		from
			detallepedido dp
			inner join producto pr on (dp.codproducto = pr.codproducto)
			inner join unidad_medida um on (pr.idunid = um.idunid)
		where
			dp.codpedido = p_cod_pedido;
	
	end

$body$
language plpgsql;


DROP FUNCTION f_listar_detalle(integer)

select * from f_listar_detalle(7)

select * from detallepedido

select * from producto