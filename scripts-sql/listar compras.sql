CREATE OR REPLACE FUNCTION f_listar_compras(IN p_fecha_ini date, IN p_fecha_fin date, IN p_tipo integer)
  RETURNS TABLE(
	codcompra integer, 
	razonsocial character varying, 
	fecha date, 
	total numeric
	) AS
$BODY$
	declare p_fecha_ini alias for $1;
	declare p_fecha_fin alias for $2;
	declare p_tipo  alias for $3;

	BEGIN
		return query

		Select
			co.codcompra,
			initcap(pr.razonsocial) ::character varying,
			co.fechacompra, 
			co.neto
		From
			compra co 
			inner join proveedor pr on (co.codproveedor = pr.codproveedor)
			
		Where
			(case p_tipo
				when 1 then 
					co.fechacompra = current_date
				when 2 then
					co.fechacompra between p_fecha_ini and p_fecha_fin
				else 
					1=1
			end)
		order by
		co.codcompra asc;

	End	
$BODY$
  LANGUAGE plpgsql 











select * from f_listar_compras(current_date,current_date,3);
 



DROP FUNCTION f_listar_compras(date,date,integer)


