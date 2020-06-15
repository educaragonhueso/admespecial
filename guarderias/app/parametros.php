<?php
define("DIR_CSVS",DIR_BASE.'/scripts/datossalida/listadoscsv/');
define("DIR_PROV",DIR_BASE.'/scripts/datossalida/pdflistados/provisionales/');
define("DIR_PROV_WEB",'/guarderias/scripts/datossalida/pdflistados/provisionales/');
define("DIR_CSVS_WEB",'/guarderias/scripts/datossalida/listadoscsv/');
define("DIR_SOR",DIR_BASE.'/scripts/datossalida/pdflistados/sorteo/');
define("DIR_SOR_WEB",'/scripts/datossalida/pdflistados/sorteo/');

//Arrays de campos cabecera para los listados
//NUMERO ASIGNADO DE SORTEO
$campos_cabecera_sor_ale=array('Primer apellido','Segundo apellido','Nombre','Tipo enseñanza','Numero aleatorio');
$campos_bbdd_sor_ale=array('apellido1','apellido2','nombre','tipoestudios','nasignado');

//SOLICITUDES BAREMADAS
$campos_cabecera_sor_bar=array('Primer apellido','Segundo apellido','Nombre','Numero aleatorio','Total baremo');
$campos_bbdd_sor_bar=array('apellido1','apellido2','nombre','nasignado','puntos_validados');

//DETALLE BAREMO
$campos_cabecera_sor_det=array('Primer apellido','Segundo apellido','Nombre','Sit Laboral','Tutor en centro','Renta inferior','Discapacidad','Familia','Hermanos');
$campos_bbdd_sor_det=array('apellido1','apellido2','nombre','sitlaboral','tutores_centro','renta_inferior','discapacidad','tipo_familia','hermanos_centro');

//DATOS PARA EXPORTAR DATOS CSVS
$campos_cabecera_csv_fase2=array('Tipo','Ap1','Ap2','Nombre','Loc','Calle','Reserva','Reserva Original','Centro origen','Cen.Pref','Cen.Alt1','Cen.Alt2','Cen.Alt3','Cen.Alt4','Cen.Alt5','Cen.Alt6','Baremo','Prioridad','Estado','Centro definitivo','Numero de sorteo asignado','Modificacion');
$campos_bbdd_csv_fase2=array('tipoestudios','apellido1','apellido2','nombre','localidad','calle_dfamiliar','reserva','reserva_original','centro_origen','nombre_centro','centro1','centro2','centro3','centro4','centro5','centro6','puntos_validados','transporte','estado_solicitud','centro_definitivo','nasignado','tipo_modificacion');

$campos_cabecera_csv_fase3=array('Tipo','Ap1','Ap2','Nombre','Loc','Calle','Reserva','Cen.Pref','Cen.Alt1','Cen.Alt2','Cen.Alt3','Cen.Alt4','Cen.Alt5','Cen.Alt6','Baremo','Prioridad','Estado','Cen.Adj','NSorteo','Modificacion');
$campos_bbdd_csv_fase3=array('tipoestudios','apellido1','apellido2','nombre','localidad','calle_dfamiliar','centro_origen','nombre_centro','centro1','centro2','centro3','centro4','centro5','centro6','puntos_validados','transporte','estado_solicitud','centro_definitivo','nasignado','tipo_modificacion');

$campos_cabecera_csv_mat=array('Centro','Vacantets 2020','Vacantes 2019','Vacantes 2018');
$campos_bbdd_csv_mat=array('nombre_centro','vuno','vdos','vtres');

$campos_cabecera_csv_sol=array('Centro','Primer apellido','Segundo apellido','Nombre','Enseñanza','Plaza ACNEAE','Vacante','Hermanos admision');
$campos_bbdd_csv_sol=array('nombre_centro','apellido1','apellido2','nombre','tipoestudios','sol_plaza','sol_vacantes','num_hadmision');

$campos_cabecera_csv_tri=array('Nombre Centro','Primer apellido Alumno','Segundo apellido Alumno','Nombre Alumno','Parentesco','Primer apellido tributante','Segundo apellido tributante','Nombre tributante','DNI Tributante');
$campos_bbdd_csv_tri=array('nombre_centro','apellido1_alumno','apellido2_alumno','nombre_alumno','parentesco','apellido1_tributante','apellido2_tributante','nombre_tributante','dni_tributante');
//listado de alumnos que promocionan, la matricula
$campos_cabecera_csv_pro=array('Centro','Apellidos','Nombre','Enseñanza','Fecha Nacimiento','estado');
$campos_bbdd_csv_pro=array('nombre_centro','apellidos','nombre','tipo_alumno_actual','fnac','estado');

//listado de alumnos duplicados
$campos_cabecera_csv_dup=array('Centro','Primer apellido','Segundo apellido','Nombre','Enseñanza','Fecha Nacimiento','DNI Tutor');
$campos_bbdd_csv_dup=array('nombre_centro','apellido1','apellido2','nombre','tipoestudios','fnac','dni_tutor1');

//DATOS PARA LISTADO TRIBUTANTES
$campos_cabecera_tributantes=array('Primer apellido alumno','Segundo apellido alumno','Nombre alumno','DNI alumno','Nombre Tributante','DNI Tributante','ImporteRenta','PuntosRenta','Cuota');
$campos_bbdd_tributantes=array('apellido1_alumno','apellido2_alumno','nombre_alumno','dni_alumno','nombre_tributante','dni_tributante','importe_renta','puntos_renta','cuota');

//DATOS PARA EXPORTAR DATOS PDF

//vacantes para centros e pdf
$campos_cabecera_pdf_mat=array('Centro','2020','2019','2018');
$campos_bbdd_pdf_mat=array('nombre_centro','vuno','vdos','vtres');

//DATOS PARA LISTADOS PROVISIONALES
$campos_cabecera_admitidos_prov=array('Tipo','Nº Orden','NºAleatorio','Primer Apellido','Segundo apellido','Nombre','Criterios prioritarios','Puntos Baremo');
$campos_bbdd_admitidos_prov=array('tipoestudios','nordensorteo','nasignado','apellido1','apellido2','nombre','transporte','puntos_validados');

$campos_cabecera_noadmitidos_prov=array('Tipo','Nº Orden','NºAleatorio','Primer Apellido','Segundo apellido','Nombre','Tipo','Criterios prioritarios','Puntos Baremo');
$campos_bbdd_noadmitidos_prov=array('tipoestudios','nordensorteo','nasignado','apellido1','apellido2','nombre','tipoestudios','transporte','puntos_validados');

$campos_cabecera_excluidos_prov=array('Tipo','NºAleatorio','Primer Apellido','Segundo apellido','Nombre','Puntos Baremo');
$campos_bbdd_excluidos_prov=array('tipoestudios','nasignado','apellido1','apellido2','nombre','puntos_validados');

//DATOS PARA LISTADOS DEFINITIVOS
$campos_cabecera_admitidos_def=array('Tipo','Nº Orden','NºAleatorio','Primer Apellido','Segundo apellido','Nombre','Puntos Baremo');
$campos_bbdd_admitidos_def=array('tipoestudios','nordensorteo','nasignado','apellido1','apellido2','nombre','puntos_validados');

$campos_cabecera_noadmitidos_def=array('Tipo','Nº Orden','NºAleatorio','Primer Apellido','Segundo apellido','Nombre','Puntos Baremo');
$campos_bbdd_noadmitidos_def=array('tipoestudios','nordensorteo','nasignado','apellido1','apellido2','nombre','puntos_validados');

$campos_cabecera_excluidos_def=array('Tipo','NºAleatorio','Primer Apellido','Segundo apellido','Nombre','Puntos Baremo');
$campos_bbdd_excluidos_def=array('tipoestudios','nasignado','apellido1','apellido2','nombre','puntos_validados');

//DATOS PARA LISTADOS SOLICITUDES FASE II
$campos_cabecera_lfase2_sol_ebo=array('Ap1','Ap2','Nombre','Loc','Calle','Cen.Pref','Cen.Alt','Baremo','Prioridad','Estado','Cen.Adj','NSorteo','Centros','Cen.Origen','Reserva','nordsor');
$campos_bbdd_lfase2_sol_ebo=array('apellido1','apellido2','nombre','localidad','calle_dfamiliar','nombre_centro','centro1','puntos_validados','transporte','estado_solicitud','centro_definitivo','nasignado','centrosdisponibles','centro_origen','reserva','nordensorteo');

$campos_cabecera_lfase2_sol_tva=array('Ap1','Ap2','Nombre','Loc','Calle','Cen.Pref','Cen.Alt','Baremo','Prioridad','Estado','Cen.Adj','NSorteo','Centros','Reserva');
$campos_bbdd_lfase2_sol_tva=array('apellido1','apellido2','nombre','localidad','calle_dfamiliar','nombre_centro','centro1','puntos_validados','transporte','estado_solicitud','centro_definitivo','nasignado','centrosdisponibles','centro_origen');

//DATOS PARA LISTADOS SOLICITUDES FASE III
$campos_cabecera_lfase3_sol_ebo=array('Ap1','Ap2','Nombre','Loc','Calle','Cen.Pref','Cen.Alt','Baremo','Prioridad','Estado','Cen.Adj','NSorteo','Centros','Reserva','nordsor');
$campos_bbdd_lfase3_sol_ebo=array('apellido1','apellido2','nombre','localidad','calle_dfamiliar','nombre_centro','centro1','puntos_validados','transporte','estado_solicitud','centro_definitivo','nasignado','centrosdisponibles','centro_origen','nordensorteo');

$campos_cabecera_lfase3_sol_tva=array('Ap1','Ap2','Nombre','Loc','Calle','Cen.Pref','Cen.Alt','Baremo','Prioridad','Estado','Cen.Adj','NSorteo','Centros','Reserva');
$campos_bbdd_lfase3_sol_tva=array('apellido1','apellido2','nombre','localidad','calle_dfamiliar','nombre_centro','centro1','puntos_validados','transporte','estado_solicitud','centro_definitivo','nasignado','centrosdisponibles','centro_origen');
?>
