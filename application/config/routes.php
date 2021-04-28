<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'c_menu';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//proyectos
$route['vproy']='c_proyectos/index';
$route['aproy']='c_proyectos/agregar_proyecto';
$route['gproy']='c_proyectos/guardar_proyecto';
$route['apar/(:any)']='c_proyectos/a_participantes/$i';
$route['gpar']='c_proyectos/guardar_participante';
$route['gparp']='c_proyectos/guardar_participante_profesor';
$route['epar/(:any)/(:num)']='c_proyectos/eliminar_participantes/$i/$i2';
$route['veproy/(:any)']='c_proyectos/v_editar_proyecto/$i';
$route['gproye']='c_proyectos/guardar_proyecto_editado';
$route['eproy/(:any)']='c_proyectos/eliminar_proyecto/$i';

//lista de proyectos para alumnos
$route['lproy']='c_proyectos/lista_proyectos';


//ajax controllers
$route['oproya'] = 'c_proyectos/obtener_proyectos_ajax';
$route['opara'] = 'c_proyectos/obtener_participantes_ajax';


//datos siitec tiempo real
$route['de']='c_datos_siitec/datos_estudiantes_tr';
$route['dp']='c_datos_siitec/datos_profesores_tr';
