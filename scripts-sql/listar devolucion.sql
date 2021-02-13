CREATE OR REPLACE FUNCTION f_listar_devoluciones(IN p_fecha_ini date, IN p_fecha_fin date, IN p_tipo integer)
  RETURNS TABLE(
	cod integer, 
	fecha date, 
	area character varying(50), 
	usuario text
	) AS
$BODY$
	declare p_fecha_ini alias for $1;
	declare p_fecha_fin alias for $2;
	declare p_tipo  alias for $3;

	BEGIN
		return query

		Select
			de.id_dev as cod,
			de.fecha,
			a.nombre as area,
			p.nombres ||' '|| p.apellido_paterno ||' '|| p.apellido_materno as usuario
		From
			devolucion de 
			inner join area a on (de.id_area = a.codigo_area)
			inner join usuario u on (de.id_usuario = u.codigo_usuario)
			inner join personal p on (u.dni_usuario = p.dni)
			
		Where
			(case p_tipo
				when 1 then 
					de.fecha = current_date
				when 2 then
					de.fecha between p_fecha_ini and p_fecha_fin
				else 
					1=1
			end)
		order by
		de.fecha desc;

	End	
$BODY$
  LANGUAGE plpgsql 



select * from devolucion

select * from personal

select * from usuario

select * from  area








select * from f_listar_devoluciones(current_date,current_date,3);
 



DROP FUNCTION f_listar_compras(date,date,integer)


