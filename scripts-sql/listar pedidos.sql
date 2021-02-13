CREATE OR REPLACE FUNCTION f_listar_pedidos(IN p_fecha_ini date, IN p_fecha_fin date, IN p_tipo integer)
  RETURNS TABLE(
	cod_ped integer, 
	nom_usuario text, 
	area character varying, 
	cargo character varying, 
	fecha date, 
	estado character varying
	) AS
$BODY$
	declare p_fecha_ini alias for $1;
	declare p_fecha_fin alias for $2;
	declare p_tipo  alias for $3;

	BEGIN
		return query

		Select
			pd.codpedido,
			initcap(pr.nombres || ' ' || pr.apellido_paterno || ' ' || pr.apellido_materno) ::text,
			initcap(ar.nombre)::character varying , 
			initcap(c.descripcion)::character varying ,
			pd.fechapedido,
			(case when pd.estado = 'N' then 'No Atendido' when pd.estado = 'A' then 'Atendido' else 'Pendiente' end) :: character varying 
		From
			pedido pd 
			inner join usuario u on (pd.codigo_usuario = u.codigo_usuario)
			inner join personal pr on (u.dni_usuario = pr.dni)
			inner join cargo c on (pr.codigo_cargo = c.codigo_cargo)
			inner join area ar on (pr.codigo_area = ar.codigo_area)
		Where
			(case p_tipo
				when 1 then 
					pd.fechapedido = current_date
				when 2 then
					pd.fechapedido between p_fecha_ini and p_fecha_fin
				else 
					1=1
			end)
		order by
		6, 5 desc;

	End	
$BODY$
  LANGUAGE plpgsql 











select * from f_listar_pedidos(current_date,current_date,3);
 






