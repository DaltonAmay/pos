<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


// RUTAS PARA UNIDADES DE MEDIDA
 $routes->get('administrar/unidades', 'Inventarios\Unidades::index');
 $routes->post('administrar/unidades/listar', 'Inventarios\Unidades::ajaxListarUnidadMedida');
 $routes->post('administrar/unidades/obtenerUnidad/(:num)', 'Inventarios\Unidades::obtenerUnidad/$1');
 $routes->post('administrar/unidades/save', 'Inventarios\Unidades::save');
 $routes->post('administrar/unidades/update', 'Inventarios\Unidades::update');
 $routes->post('administrar/unidades/delete/(:num)', 'Inventarios\Unidades::delete/$1');
 $routes->post('administrar/unidades/active/(:num)', 'Inventarios\Unidades::active/$1');
//  RUTAS PARA CATEGORIAS
$routes->get('administrar/categorias', 'Inventarios\Categorias::index');
$routes->post('administrar/categorias/listar', 'Inventarios\Categorias::ajaxListarCategorias');
$routes->post('/administrar/categorias/save', 'Inventarios\Categorias::save');
$routes->post('administrar/categorias/obtenerCategoria/(:num)', 'Inventarios\Categorias::obtenerCategoria/$1');
$routes->post('administrar/categorias/update', 'Inventarios\Categorias::update');
$routes->post('administrar/categorias/delete/(:num)', 'Inventarios\Categorias::delete/$1');
$routes->post('administrar/categorias/active/(:num)', 'Inventarios\Categorias::active/$1');
//  RUTAS PARA MARCAS
$routes->get('administrar/marcas', 'Inventarios\Marcas::index');
$routes->post('administrar/marcas/listar', 'Inventarios\Marcas::ajaxListarMarcas');
$routes->post('administrar/marcas/obtenerMarca/(:num)', 'Inventarios\Marcas::obtenerMarca/$1');
$routes->post('administrar/marcas/save', 'Inventarios\Marcas::save');
$routes->post('administrar/marcas/update', 'Inventarios\Marcas::update');
$routes->post('administrar/marcas/delete/(:num)', 'Inventarios\Marcas::delete/$1');
$routes->post('administrar/marcas/active/(:num)', 'Inventarios\Marcas::active/$1');
//  RUTAS PARA PRODUCTOS
$routes->get('administrar/productos', 'Inventarios\Productos::index');
$routes->post('administrar/productos/listar', 'Inventarios\Productos::ajaxListarProductos');
$routes->post('administrar/productos/save', 'Inventarios\Productos::save');
$routes->get('administrar/productos/obtenerDatosProducto/(:num)', 'Inventarios\Productos::obtenerDatosProducto/$1');
$routes->post('administrar/productos/update', 'Inventarios\Productos::update');
$routes->get('administrar/productos/delete/(:num)', 'Inventarios\Productos::delete/$1');
//  RUTAS PARA FACTURAS
$routes->get('administrar/facturas', 'Ventas\Facturar::index');
$routes->get('administrar/ventas/listar', 'Ventas::ajaxListarVentas');
$routes->post('administrar/ventas/save', 'Ventas::save');
$routes->post('ventas/get_tipo_documentos', 'Ventas\TipoDocumento::obtenerTipoDocumentos');
$routes->get('administrar/ventas/obtenerDatosVenta/(:num)', 'Ventas::obtenerDatosVenta/$1');
$routes->post('ventas/update', 'Ventas::update');
$routes->get('ventas/delete/(:num)', 'Ventas::delete/$1');
//  RUTAS CLIENTES
$routes->get('ventas/clientes', 'Ventas\Clientes::index');
$routes->post('ventas/clientes/save', 'Ventas\Clientes::save');
$routes->post('ventas/clientes/obtenerClientes', 'Ventas\Clientes::obtenerClientes');
$routes->post('ventas/clientes/obtenerCliente/(:num)', 'Ventas\Clientes::obtenerCliente/$1');
$routes->post('ventas/clientes/update', 'Ventas\Clientes::update');
$routes->post('ventas/clientes/delete/(:num)', 'Ventas\Clientes::delete/$1');
$routes->post('ventas/clientes/active/(:num)', 'Ventas\Clientes::active/$1');
//RUTAS VENTAS
$routes->post('administrar/ventas/save', 'Ventas::save');
$routes->get('administrar/ventas/obtenerDatosVenta/(:num)', 'Ventas::obtenerDatosVenta/$1');
$routes->post('ventas/update', 'Ventas::update');
$routes->get('ventas/delete/(:num)', 'Ventas::delete/$1'); 
//RUTAS TIPO DOCUMENTO 
$routes->get('ventas/tiposdocumentos', 'Ventas\TipoDocumento::index');
$routes->post('ventas/tiposdocumentos/obtenerDocs', 'Ventas\TipoDocumento::ajaxListarTipoDocumento');
$routes->post('ventas/tiposdocumentos/save', 'Ventas\TipoDocumento::save');
$routes->post('ventas/tiposdocumentos/obtenerDoc/(:num)', 'Ventas\TipoDocumento::obtenerTipoDoc/$1');
$routes->post('ventas/tiposdocumentos/update', 'Ventas\TipoDocumento::update');
$routes->post('ventas/tiposdocumentos/delete/(:num)', 'Ventas\TipoDocumento::delete/$1');
$routes->post('ventas/tiposdocumentos/active/(:num)', 'Ventas\TipoDocumento::active/$1');
//RUTAS EMPRESAS 
$routes->get('gerencia/empresa', 'Gerencia\Empresa::index');
$routes->post('gerencia/empresa/get_tipo_documentos', 'Ventas\TipoDocumento::obtenerTipoDocumentos');
$routes->post('gerencia/empresa/listar', 'Gerencia\Empresa::ajaxListarEmpresas');
$routes->post('gerencia/empresa/obtenerEmpresa/(:num)', 'Gerencia\Empresa::obtenerEmpresa/$1');
$routes->post('gerencia/empresa/saveAndUpdate', 'Gerencia\Empresa::crud');
$routes->get('gerencia/empresa/obtenerImagen/(:num)', 'Gerencia\Empresa::obtenerImagen/$1');
$routes->post('gerencia/empresa/obtenerEntidades', 'Gerencia\Entidad::obtenerEntidades');
$routes->get('empresa/download/(:num)', 'Gerencia\Empresa::descargarCertificado/$1');
$routes->post('gerencia/empresa/deleteLogo/(:num)', 'Gerencia\Empresa::deleteLogo/$1');
$routes->post('gerencia/empresa/deleteEmpresa/(:num)', 'Gerencia\Empresa::delete/$1');
$routes->post('gerencia/empresa/activarEmpresa/(:num)', 'Gerencia\Empresa::active/$1');
//RUTA TIPO DE COMPROBANTES
$routes->get('gerencia/tipo_comprobantes', 'Gerencia\TipoComprobante::index');
$routes->get('gerencia/tipo_comprobantes/get', 'Gerencia\TipoComprobante::ajaxListarTipoDocumento');
$routes->post('gerencia/tipo_comprobantes/save', 'Gerencia\TipoComprobante::save');
$routes->get('gerencia/tipo_comprobantes/get/(:num)', 'Gerencia\TipoComprobante::obtenerTipoDoc/$1');
$routes->post('gerencia/tipo_comprobantes/update', 'Gerencia\TipoComprobante::update');
$routes->post('gerencia/tipo_comprobantes/delete/(:num)', 'Gerencia\TipoComprobante::delete/$1');
$routes->post('gerencia/tipo_comprobantes/active/(:num)', 'Gerencia\TipoComprobante::active/$1');

 
