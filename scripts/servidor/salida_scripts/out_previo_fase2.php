


ACTUALIZANDO VACANTES CENTROS, VACANTES: 0, INC: 1 CONSULTA: UPDATE centros set vacantes_ebo=vacantes_ebo+1,vacantes_ebo_original=vacantes_ebo_original+1 where id_centro=50011537
ACTUALIZANDO VACANTES CENTROS, VACANTES: 0, INC: 1 CONSULTA: UPDATE centros set vacantes_ebo=vacantes_ebo+1,vacantes_ebo_original=vacantes_ebo_original+1 where id_centro=50011537
ACTUALIZANDO VACANTES CENTROS, VACANTES: 0, INC: 1 CONSULTA: UPDATE centros set vacantes_ebo=vacantes_ebo+1,vacantes_ebo_original=vacantes_ebo_original+1 where id_centro=50018131
ACTUALIZANDO VACANTES CENTROS, VACANTES: 0, INC: 1 CONSULTA: UPDATE centros set vacantes_tva=vacantes_tva+1,vacantes_tva_original=vacantes_tva_original+1 where id_centro=50018131
ACTUALIZANDO VACANTES CENTROS, VACANTES: 0, INC: 1 CONSULTA: UPDATE centros set vacantes_ebo=vacantes_ebo+1,vacantes_ebo_original=vacantes_ebo_original+1 where id_centro=50017369
ACTUALIZANDO VACANTES CENTROS, VACANTES: 0, INC: 1 CONSULTA: UPDATE centros set vacantes_tva=vacantes_tva+1,vacantes_tva_original=vacantes_tva_original+1 where id_centro=50011537
ACTUALIZANDO VACANTES CENTROS, VACANTES: 0, INC: 1 CONSULTA: UPDATE centros set vacantes_ebo=vacantes_ebo+1,vacantes_ebo_original=vacantes_ebo_original+1 where id_centro=50011537
ACTUALIZANDO VACANTES CENTROS, VACANTES: 0, INC: 1 CONSULTA: UPDATE centros set vacantes_ebo=vacantes_ebo+1,vacantes_ebo_original=vacantes_ebo_original+1 where id_centro=50008630
ACTUALIZANDO VACANTES CENTROS, VACANTES: 0, INC: 1 CONSULTA: UPDATE centros set vacantes_ebo=vacantes_ebo+1,vacantes_ebo_original=vacantes_ebo_original+1 where id_centro=50010387
ACTUALIZANDO VACANTES CENTROS, VACANTES: 0, INC: 1 CONSULTA: UPDATE centros set vacantes_ebo=vacantes_ebo+1,vacantes_ebo_original=vacantes_ebo_original+1 where id_centro=50011537
ACTUALIZANDO VACANTES CENTROS, VACANTES: 0, INC: 1 CONSULTA: UPDATE centros set vacantes_tva=vacantes_tva+1,vacantes_tva_original=vacantes_tva_original+1 where id_centro=50018131
ACTUALIZANDO VACANTES CENTROS, VACANTES: 0, INC: 1 CONSULTA: UPDATE centros set vacantes_ebo=vacantes_ebo+1,vacantes_ebo_original=vacantes_ebo_original+1 where id_centro=50011537
ACTUALIZANDO VACANTES CENTROS, VACANTES: 0, INC: 1 CONSULTA: UPDATE centros set vacantes_tva=vacantes_tva+1,vacantes_tva_original=vacantes_tva_original+1 where id_centro=50011537
ACTUALIZANDO VACANTES CENTROS, VACANTES: 0, INC: 1 CONSULTA: UPDATE centros set vacantes_ebo=vacantes_ebo+1,vacantes_ebo_original=vacantes_ebo_original+1 where id_centro=50008368
ACTUALIZANDO VACANTES CENTROS, VACANTES: 0, INC: 1 CONSULTA: UPDATE centros set vacantes_ebo=vacantes_ebo+1,vacantes_ebo_original=vacantes_ebo_original+1 where id_centro=50007376
ACTUALIZANDO VACANTES CENTROS, VACANTES: 0, INC: 1 CONSULTA: UPDATE centros set vacantes_ebo=vacantes_ebo+1,vacantes_ebo_original=vacantes_ebo_original+1 where id_centro=50008630
ACTUALIZANDO VACANTES CENTROS, VACANTES: 0, INC: 1 CONSULTA: UPDATE centros set vacantes_ebo=vacantes_ebo+1,vacantes_ebo_original=vacantes_ebo_original+1 where id_centro=50018131
ACTUALIZANDO VACANTES CENTROS, VACANTES: 0, INC: 1 CONSULTA: UPDATE centros set vacantes_ebo=vacantes_ebo+1,vacantes_ebo_original=vacantes_ebo_original+1 where id_centro=50018131
ACTUALIZANDO VACANTES CENTROS, VACANTES: 0, INC: 1 CONSULTA: UPDATE centros set vacantes_tva=vacantes_tva+1,vacantes_tva_original=vacantes_tva_original+1 where id_centro=22000056
ACTUALIZANDO VACANTES CENTROS, VACANTES: 0, INC: 1 CONSULTA: UPDATE centros set vacantes_ebo=vacantes_ebo+1,vacantes_ebo_original=vacantes_ebo_original+1 where id_centro=50018131
Actualizadas vacantes centros para fase 2 a las 08:05 del dia 13-May-2020
Copiando tabla fase2....

INSERT IGNORE INTO alumnos_fase2 SELECT
t1.id_alumno,t1.nombre,t1.apellido1,t1.apellido2,t1.localidad,t1.calle_dfamiliar,'nodata'
as coordenadas,t1.nombre_centro,t1.tipoestudios,t1.fase_solicitud,t1.estado_solicitud,t1.transporte,'0' as nordensorteo,'0' as nasignado,t1.puntos_validados,t1.id_centro,t2.centro1,t2.id_centro1,t3.centro2,t3.id_centro2,t4.centro3,t4.id_centro3,t5.centro4,t5.id_centro4,t6.centro5,t6.id_centro5,t7.centro6,t7.id_centro6, 'nocentro' as centro_definitivo, '0' as id_centro_definitivo,t1.id_centro_estudios_origen as id_centro_origen,t8.centro_origen,t1.reserva,t1.reserva as reserva_original,'automatica' as tipo_modificacion,'0' as activado_fase3 FROM 
	(SELECT a.id_alumno, a.nombre, a.apellido1, a.apellido2,a.loc_dfamiliar as localidad,a.calle_dfamiliar,c.nombre_centro,a.tipoestudios,a.fase_solicitud,a.estado_solicitud,a.transporte,a.nordensorteo,a.nasignado as nasignado,b.puntos_validados,a.id_centro_destino as id_centro,a.id_centro_estudios_origen,a.est_desp_sorteo,a.reserva FROM alumnos a left join baremo b on b.id_alumno=a.id_alumno 
	left join centros c on a.id_centro_destino=c.id_centro  order by c.id_centro desc, a.tipoestudios asc,a.transporte desc, b.puntos_validados desc)
	as t1 
	left join 
	(SELECT a.id_alumno,c.id_centro as id_centro1, c.nombre_centro as centro1 from alumnos a, centros c where c.id_centro=a.id_centro_destino1) 
	as t2 on t1.id_alumno=t2.id_alumno
left join 
	(SELECT a.id_alumno,c.id_centro as id_centro2, c.nombre_centro as centro2 from alumnos a, centros c where c.id_centro=a.id_centro_destino2) 
	as t3 on t1.id_alumno=t3.id_alumno
left join 
	(SELECT a.id_alumno,c.id_centro as id_centro3, c.nombre_centro as centro3 from alumnos a, centros c where c.id_centro=a.id_centro_destino3) 
	as t4 on t1.id_alumno=t4.id_alumno
left join 
	(SELECT a.id_alumno,c.id_centro as id_centro4, c.nombre_centro as centro4 from alumnos a, centros c where c.id_centro=a.id_centro_destino4) 
	as t5 on t1.id_alumno=t5.id_alumno
left join 
	(SELECT a.id_alumno,c.id_centro as id_centro5, c.nombre_centro as centro5 from alumnos a, centros c where c.id_centro=a.id_centro_destino5) 
	as t6 on t1.id_alumno=t6.id_alumno
left join 
	(SELECT a.id_alumno,c.id_centro as id_centro6, c.nombre_centro as centro6 from alumnos a, centros c where c.id_centro=a.id_centro_destino6) 
	as t7 on t1.id_alumno=t7.id_alumno
left join 
	(SELECT a.id_alumno,c.id_centro as id_centro_origen, c.nombre_centro as centro_origen from alumnos a, centros c where c.id_centro=a.id_centro_estudios_origen) 
	as t8 on t1.id_alumno=t8.id_alumno WHERE t1.fase_solicitud!='borrador' and t1.est_desp_sorteo='noadmitida'

1Copia tabla solicitudesfase2 realizada corectamente a las 08:05 del dia 13-May-2020
