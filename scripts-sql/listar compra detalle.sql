create or replace function f_listar_detalle_compra (p_cod_compra integer)
returns table
(
	item integer,
	articulo character varying,
	cantidad integer,
	precio money,
	subtotal money
) as

$body$
	declare p_cod_compra alias for $1;

	begin
		return query

		select 
			dc.item,
			pr.nombre,
			dc.cantidad,
			dc.preciocompra,
			(dc.cantidad*dc.preciocompra) as subtotal
		from
			detallecompra dc
			inner join producto pr on dc.codproducto = pr.codproducto
		where
			dc.codcompra =  p_cod_compra;
	
	end

$body$
language plpgsql;


select * from f_listar_detalle_compra(1)

select * from detallecompra

select * from compra

select * from producto