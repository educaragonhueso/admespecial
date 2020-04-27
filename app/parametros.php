<?php
//define("DIA_SORTEO",'2020-02-14');
define("DIR_CSVS",DIR_BASE.'/scripts/datossalida/listadoscsv/');
define("DIR_PROV",DIR_BASE.'/scripts/datossalida/pdflistados/provisionales/');
define("DIR_PROV_WEB",'/scripts/datossalida/pdflistados/provisionales/');
define("DIR_CSVS_WEB",'/scripts/datossalida/listadoscsv/');
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
$campos_cabecera_sor_det=array('Primer apellido','Segundo apellido','Nombre','Proximidad dom.','Tutor en centro','Renta inferior','Discapacidad','Familia','Hermanos');
$campos_bbdd_sor_det=array('apellido1','apellido2','nombre','proximidad_domicilio','tutores_centro','renta_inferior','discapacidad','tipo_familia','hermanos_centro');

//DATOS PARA EXPORTAR DATOS CSVS
$campos_cabecera_csv_fase2=array('Tipo','Ap1','Ap2','Nombre','Loc','Calle','Reserva','Centro origen','Cen.Pref','Cen.Alt1','Cen.Alt2','Cen.Alt3','Cen.Alt4','Cen.Alt5','Cen.Alt6','Baremo','Prioridad','Estado','Centro definitivo','Numero de sorteo asignado','Modificacion');
$campos_bbdd_csv_fase2=array('tipoestudios','apellido1','apellido2','nombre','localidad','calle_dfamiliar','reserva','centro_origen','nombre_centro','centro1','centro2','centro3','centro4','centro5','centro6','puntos_validados','transporte','estado_solicitud','centro_definitivo','nasignado','tipo_modificacion');

$campos_cabecera_csv_fase3=array('Tipo','Ap1','Ap2','Nombre','Loc','Calle','Reserva','Cen.Pref','Cen.Alt1','Cen.Alt2','Cen.Alt3','Cen.Alt4','Cen.Alt5','Cen.Alt6','Baremo','Prioridad','Estado','Cen.Adj','NSorteo','Modificacion');
$campos_bbdd_csv_fase3=array('tipoestudios','apellido1','apellido2','nombre','localidad','calle_dfamiliar','centro_origen','nombre_centro','centro1','centro2','centro3','centro4','centro5','centro6','puntos_validados','transporte','estado_solicitud','centro_definitivo','nasignado','tipo_modificacion');

$campos_cabecera_csv_mat=array('Centro','Grupos EBO','Puestos EBO','Plazas Ocupadas EBO','Vacantes_EBO','Grupos TVA','Puestos TVA','Plazas Ocupadas TVA','Vacantes_TVA');
$campos_bbdd_csv_mat=array('nombre_centro','gruposebo','puestosebo','plazasactualesebo','vacantesebo','grupostva','puestostva','plazasactualestva','vacantestva');

$campos_cabecera_csv_sol=array('Centro','Primer apellido','Segundo apellido','Nombre','Enseñanza','Centro de procedencia','Criterios prioritarios','Localidad domicilio familiar','Fase','Estado');
$campos_bbdd_csv_sol=array('nombre_centro','apellido1','apellido2','nombre','tipoestudios','nombre_centro_origen','transporte','loc_dfamiliar','fase_solicitud','estado_solicitud');

//listado de alumnos que promocionan, la matricula
$campos_cabecera_csv_pro=array('Centro','Apellidos','Nombre','Enseñanza','Fecha Nacimiento','estado');
$campos_bbdd_csv_pro=array('nombre_centro','apellidos','nombre','tipo_alumno_actual','fnac','estado');

//listado de alumnos duplicados
$campos_cabecera_csv_dup=array('Centro','Primer apellido','Segundo apellido','Nombre','Enseñanza','Fecha Nacimiento','DNI Tutor');
$campos_bbdd_csv_dup=array('nombre_centro','apellido1','apellido2','nombre','tipoestudios','fnac','dni_tutor1');

//DATOS PARA EXPORTAR DATOS PDF
$campos_cabecera_pdf_mat=array('Centro','Grupos EBO','Puestos EBO','Plazas Ocupadas EBO','Vacantes_EBO','Grupos TVA','Puestos TVA','Plazas Ocupadas TVA','Vacantes_TVA');
$campos_bbdd_pdf_mat=array('nombre_centro','gruposebo','puestosebo','plazasactualesebo','vacantesebo','grupostva','puestostva','plazasactualestva','vacantestva');

//DATOS PARA LISTADOS PROVISIONALES
$campos_cabecera_admitidos_prov=array('Tipo','Nº Orden','NºAleatorio','Primer Apellido','Segundo apellido','Nombre','Criterios prioritarios','Puntos Baremo');
$campos_bbdd_admitidos_prov=array('tipoestudios','nordensorteo','nasignado','apellido1','apellido2','nombre','transporte','puntos_validados');

$campos_cabecera_noadmitidos_prov=array('Nº Orden','NºAleatorio','Primer Apellido','Segundo apellido','Nombre','Tipo','Criterios prioritarios','Puntos Baremo');
$campos_bbdd_noadmitidos_prov=array('nordensorteo','nasignado','apellido1','apellido2','nombre','tipoestudios','transporte','puntos_validados');

$campos_cabecera_excluidos_prov=array('NºAleatorio','Primer Apellido','Segundo apellido','Nombre','Puntos Baremo');
$campos_bbdd_excluidos_prov=array('nasignado','apellido1','apellido2','nombre','puntos_validados');

//DATOS PARA LISTADOS DEFINITIVOS
$campos_cabecera_admitidos_def=array('Nº Orden','NºAleatorio','Primer Apellido','Segundo apellido','Nombre','Puntos Baremo');
$campos_bbdd_admitidos_def=array('nordensorteo','nasignado','apellido1','apellido2','nombre','puntos_validados');

$campos_cabecera_noadmitidos_def=array('Nº Orden','NºAleatorio','Primer Apellido','Segundo apellido','Nombre','Puntos Baremo');
$campos_bbdd_noadmitidos_def=array('nordensorteo','nasignado','apellido1','apellido2','nombre','puntos_validados');

$campos_cabecera_excluidos_def=array('NºAleatorio','Primer Apellido','Segundo apellido','Nombre','Puntos Baremo');
$campos_bbdd_excluidos_def=array('nasignado','apellido1','apellido2','nombre','puntos_validados');
//DATOS PARA LISTADOS SOLICITUDES FASE II
$campos_cabecera_lfase2_sol_ebo=array('Ap1','Ap2','Nombre','Loc','Calle','Cen.Pref','Cen.Alt','Baremo','Prioridad','Estado','Cen.Adj','NSorteo','Centros','Reserva','nordsor');
$campos_bbdd_lfase2_sol_ebo=array('apellido1','apellido2','nombre','localidad','calle_dfamiliar','nombre_centro','centro1','puntos_validados','transporte','estado_solicitud','centro_definitivo','nasignado','centrosdisponibles','centro_origen','nordensorteo');

$campos_cabecera_lfase2_sol_tva=array('Ap1','Ap2','Nombre','Loc','Calle','Cen.Pref','Cen.Alt','Baremo','Prioridad','Estado','Cen.Adj','NSorteo','Centros','Reserva');
$campos_bbdd_lfase2_sol_tva=array('apellido1','apellido2','nombre','localidad','calle_dfamiliar','nombre_centro','centro1','puntos_validados','transporte','estado_solicitud','centro_definitivo','nasignado','centrosdisponibles','centro_origen');

//DATOS PARA LISTADOS SOLICITUDES FASE III
$campos_cabecera_lfase3_sol_ebo=array('Ap1','Ap2','Nombre','Loc','Calle','Cen.Pref','Cen.Alt','Baremo','Prioridad','Estado','Cen.Adj','NSorteo','Centros','Reserva','nordsor');
$campos_bbdd_lfase3_sol_ebo=array('apellido1','apellido2','nombre','localidad','calle_dfamiliar','nombre_centro','centro1','puntos_validados','transporte','estado_solicitud','centro_definitivo','nasignado','centrosdisponibles','centro_origen','nordensorteo');

$campos_cabecera_lfase3_sol_tva=array('Ap1','Ap2','Nombre','Loc','Calle','Cen.Pref','Cen.Alt','Baremo','Prioridad','Estado','Cen.Adj','NSorteo','Centros','Reserva');
$campos_bbdd_lfase3_sol_tva=array('apellido1','apellido2','nombre','localidad','calle_dfamiliar','nombre_centro','centro1','puntos_validados','transporte','estado_solicitud','centro_definitivo','nasignado','centrosdisponibles','centro_origen');
?>
