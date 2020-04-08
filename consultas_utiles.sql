LISTADO ALUMNOS FASE 2
select id_alumno,id_centro,nombre_centro,centro_definitivo,tipoestudios,transporte,puntos_validados,nordensorteo from alumnos_fase2 order by transporte,puntos_validados,nordensorteo asc\G

BORRAR/DESHACER MIGRACION DE DATOS A PROVISIONAL
delete from alumnos_provisional WHERE id_centro_destino in(SELECT id_Centro FROM centros where fase_Sorteo<"2");

