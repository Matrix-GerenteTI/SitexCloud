<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/user', 'Login\LoginController@getUser');

    Route::get('/searchEmpleado/{data}', 'Get\GetsController@searchEmpleado');

    Route::get('/getSucursal', 'Get\GetsController@getSucursal');
    Route::get('/getDepartamento', 'Get\GetsController@getDepartamento');
    Route::get('/getPuesto/{id}', 'Get\GetsController@getPuesto');
    Route::get('/getEmpleado/{id}', 'Get\GetsController@getEmpleado');

    Route::get('/getEstados', 'Get\GetsController@getEstadosRepublica');
    Route::get('/getEstadoCivil', 'Get\GetsController@getEstadoCivil');
    Route::get('/getSexo', 'Get\GetsController@getSexo');
    Route::get('/getNivelEstudio', 'Get\GetsController@getNivelEstudio');
    Route::get('/getTipoSangre', 'Get\GetsController@getTipoSangre');
    Route::get('/getTipoUsuario', 'Get\GetsController@getTipoUsuario');
    Route::get('/getTipoContrato', 'Get\GetsController@getTipoContrato');
    Route::get('/getTiempoContrato', 'Get\GetsController@getTiempoContrato');
    Route::get('/getTipoJornada', 'Get\GetsController@getTipoJornada');
    Route::get('/getAntiguedad/{date}', 'Get\GetsController@getAntiguedad');
    Route::get('/getTipoRegimen', 'Get\GetsController@getTipoRegimen');
    Route::get('/getRiesgoPuesto', 'Get\GetsController@getRiesgoPuesto');
    Route::get('/getPeriodicidadPago', 'Get\GetsController@getPeriodicidadPago');
    Route::get('/getBancos', 'Get\GetsController@getBancos');
    Route::get('/getEmpleadosAll', 'Get\GetsController@getEmpleadosAll');
    Route::get('/getTipoDocumentos', 'Get\GetsController@getTipoDocumentos');
    Route::get('/getMarca', 'Get\GetsController@getMarca');
    Route::get('/getLinea/{id}', 'Get\GetsController@getLinea');
    Route::get('/getUsuarios', 'Get\GetsController@getUsuarios');
    Route::get('/getTicketsPrediction/{fecha}', 'Get\GetsController@getTicketsPrediction');
    Route::get('/getRegistrosCavim/{fecha}', 'Get\GetsController@getRegistrosCavim');
    Route::post('/borrarRegistro/{folio}', 'Cavim\CavimController@borrarRegistro');
    Route::post('/registrar', 'Cavim\CavimController@registrar');
    Route::get('/exportarExcel/{fecha}', 'Cavim\CavimController@exportarExcel');
    Route::get('/getFamilia', 'almacen\AlmacenController@getFamilia');
    Route::get('/getSubfamilia/{id}', 'almacen\AlmacenController@getSubfamilia');
    Route::get('/getAllPoliticaPrecios', 'almacen\AlmacenController@getAllPoliticaPrecios');
    Route::get('/getPrecioPorFamilia/{id}', 'almacen\AlmacenController@getPrecioPorFamilia');
    Route::post('/getPrecioPorSubfamilia', 'almacen\AlmacenController@getPrecioPorSubfamilia');
    Route::post('/savePrecio', 'almacen\AlmacenController@savePrecio');
    Route::post('/updateItemTabla', 'almacen\AlmacenController@updateItemTabla');
    Route::post('/borrarPrecio/{id}', 'almacen\AlmacenController@borrarPrecio');
    Route::get('/getAllSubfamilias', 'almacen\AlmacenController@getAllSubfamilias');
    Route::get('/getFiltroFamilia', 'almacen\AlmacenController@getFiltroFamilia');
    Route::get('/getFiltroSubfamilia/{id}', 'almacen\AlmacenController@getFiltroSubfamilia');
    Route::get('/getUsuarioPermiso/{idpuesto}', 'Get\GetsController@getUsuarioPermiso');
    Route::get('/getllantas', 'almacen\AlmacenController@getllantas');
    Route::get('/getNameCliente/{name}', 'Get\GetsController@getNameCliente');
    Route::get('/getFormaPago', 'Get\GetsController@getFormaPago');
    Route::get('/getUsoCfdi', 'Get\GetsController@getUsoCfdi');
    Route::post('/getTicketsFacturacion', 'ventas\VentasController@getTicketsFacturacion');
    Route::get('/getTicketAnticipo/{id}', 'ventas\VentasController@getTicketAnticipo');
    
    Route::get('/getRegistrosUsuarioSucursal/{usuario}', 'Get\GetsController@getRegistrosUsuarioSucursal');

    Route::get('/getModulo', 'Get\GetsController@getModulo');
    Route::get('/getSubmodulo/{id}', 'Get\GetsController@getSubmodulo');
    Route::get('/getAccion/{id}', 'Get\GetsController@getAccion');
    Route::post('/registrarPermiso', 'sistemas\SistemaController@registrarPermiso');
    Route::post('/guardarExcepcion', 'sistemas\SistemaController@guardarExcepcion');
    Route::post('/saveUsuarioSucursal', 'sistemas\SistemaController@saveUsuarioSucursal');
    Route::post('/saveUsuarioIncidencia', 'sistemas\SistemaController@saveUsuarioIncidencia');
    Route::get('/getRegistrosExcepciones/{id}', 'sistemas\SistemaController@getRegistrosExcepciones');
    Route::get('/deleteUsuarioSucursal/{id}', 'sistemas\SistemaController@deleteUsuarioSucursal');
    Route::post('/updateUsuarioSucursal', 'sistemas\SistemaController@updateUsuarioSucursal');
    
    Route::post('/guardarVehiculo', 'Cavim\CavimController@guardarVehiculo');
    Route::get('/getChoferes', 'Cavim\CavimController@getChoferes');
    Route::post('/saveBonoChofer', 'Cavim\CavimController@saveBonoChofer');
    Route::post('/uploadFotoBono', 'Cavim\CavimController@uploadFotoBono');
    Route::post('/getBonosChoferesFiltros', 'Cavim\CavimController@getBonosChoferesFiltros');
    Route::post('/exportarExcelBonoChoferes', 'Cavim\CavimController@exportarExcelBonoChoferes');
    
    
    Route::get('/getAllSubcategorias', 'Get\GetsController@getAllSubcategorias');
    Route::get('/getCategoria', 'Get\GetsController@getCategoria');
    Route::get('/getSubcategoria/{id}', 'Get\GetsController@getSubcategoria');
    Route::post('/uploadPhoto', 'Nomina\NominaController@uploadPhoto');
    Route::get('/getTipoVenta', 'Get\GetsController@getTipoVenta');
    Route::get('/getTipoTicket', 'Get\GetsController@getTipoTicket');


    
    Route::post('/logout', 'Login\LoginController@logout');
    Route::post('/registerParametros', 'Nomina\NominaController@registerParametros');
    Route::post('/agregarEmpleado', 'Nomina\NominaController@agregarEmpleado');
    Route::get('/editEmpleado/{id}', 'Nomina\NominaController@editEmpleado');
    Route::get('/editDireccion/{id}', 'Nomina\NominaController@editDireccion');
    Route::get('/editUsuario/{id}', 'Nomina\NominaController@editUsuario');
    Route::get('/editContrato/{id}', 'Nomina\NominaController@editContrato');
    Route::get('/editFotoEmpleado/{id}', 'Nomina\NominaController@editFotoEmpleado');
    Route::post('/updateEmpleado/{id}', 'Nomina\NominaController@updateEmpleado');
    Route::post('/changeAdscripcion', 'Nomina\NominaController@changeAdscripcion');
    Route::post('/renovarContrato', 'Nomina\NominaController@renovarContrato');
    Route::post('/bajaEmpleado/{id}', 'Nomina\NominaController@bajaEmpleado');
    Route::post('/generatePDFcontrato', 'Nomina\NominaController@generatePDFcontrato');
    Route::post('/uploadPhotosActivos', 'Contabilidad\ContabilidadController@uploadPhotosActivos');
    Route::post('/saveActivoFijo', 'Contabilidad\ContabilidadController@saveActivoFijo');
    Route::post('/getFiltroActivos', 'Contabilidad\ContabilidadController@getFiltroActivos');
    Route::get('/getActivosFijos', 'Contabilidad\ContabilidadController@getActivosFijos');
    Route::post('/borrarActivo/{id}', 'Contabilidad\ContabilidadController@borrarActivo');
    Route::post('/exportarExcelActivos', 'Contabilidad\ContabilidadController@exportarExcelActivos');
    Route::post('/exportarExcelPoliticaPrecios', 'almacen\AlmacenController@exportarExcelPoliticaPrecios');
    
    Route::get('/verFotosResguardos/{id}', 'Recursoshumanos\RecursosHumanosController@verFotosResguardos');
    Route::post('/imprimirResguardo', 'Recursoshumanos\RecursosHumanosController@imprimirResguardo');
    Route::get('/borrarResguardo/{id}', 'Recursoshumanos\RecursosHumanosController@borrarResguardo');
    Route::get('/getResguardos/{nip}', 'Recursoshumanos\RecursosHumanosController@getResguardos');
    Route::post('/saveResguardo', 'Recursoshumanos\RecursosHumanosController@saveResguardo');
    Route::post('/uploadPhotosResguardos', 'Recursoshumanos\RecursosHumanosController@uploadPhotosResguardos');
    Route::post('/getPreguntasfiltrosQuizz', 'Recursoshumanos\RecursosHumanosController@getPreguntasfiltrosQuizz');
    Route::get('/getSubcategoriaquizz', 'Recursoshumanos\RecursosHumanosController@getSubcategoriaquizz');
    Route::get('/verRespuestasQuizz/{id}', 'Recursoshumanos\RecursosHumanosController@verRespuestasQuizz');
    Route::get('/getNivelquizz', 'Recursoshumanos\RecursosHumanosController@getNivelquizz');
    Route::get('/getClasificacionquizz', 'Recursoshumanos\RecursosHumanosController@getClasificacionquizz');
    Route::post('/saveQuizzPregunta', 'Recursoshumanos\RecursosHumanosController@saveQuizzPregunta');
    Route::post('/saveQuizzRespuestas', 'Recursoshumanos\RecursosHumanosController@saveQuizzRespuestas');
    Route::post('/uploadFotos', 'Recursoshumanos\RecursosHumanosController@uploadFotos');
    Route::get('/getTipoIncidencia', 'Recursoshumanos\RecursosHumanosController@getTipoIncidencia');
    Route::get('/getTipoIncidencia', 'Recursoshumanos\RecursosHumanosController@getTipoIncidencia');
    Route::get('/getAccionIncidencias/{id}', 'Recursoshumanos\RecursosHumanosController@getAccionIncidencias');
    Route::post('/getAccionIncidenciasPorUsuario', 'Recursoshumanos\RecursosHumanosController@getAccionIncidenciasPorUsuario');
    Route::post('/guardarIncidencia', 'Recursoshumanos\RecursosHumanosController@guardarIncidencia');
    Route::post('/borrarIncidencia/{id}', 'Recursoshumanos\RecursosHumanosController@borrarIncidencia');
    Route::get('/getAllDeducciones', 'Recursoshumanos\RecursosHumanosController@getAllDeducciones');
    Route::get('/getAllPercepciones', 'Recursoshumanos\RecursosHumanosController@getAllPercepciones');
    Route::get('/getPagos/{id}', 'Recursoshumanos\RecursosHumanosController@getPagos');
    Route::get('/getDeduccionesEmpleado', 'Recursoshumanos\RecursosHumanosController@getDeduccionesEmpleado');
    Route::get('/getPercepcionesEmpleado', 'Recursoshumanos\RecursosHumanosController@getPercepcionesEmpleado');


    Route::get('/dashboard', function () {
        return view('users.dashboard');
    })->name('dashboard');

    Route::get('/SGC_recursos', function () {
        return view('users.SGC.recursos');
    })->name('SGC_recursos');

    Route::get('/nomina_parametros', function () {
        return view('users.nomina.parametros');
    })->name('Nomina_parametros');

    Route::get('/nomina_empleados', function () {
        return view('users.nomina.empleados');
    })->name('Nomina_empleados');

    Route::get('/cavim_registroVehiculos', function () {
        return view('users.cavim.registroVehiculos');
    })->name('Cavim_registroVehiculos');

    Route::get('/nuevo_vehiculo', function () {
        return view('users.cavim.nuevoVehiculo');
    })->name('Cavim_nuevoVehiculo');

    Route::get('/bono_choferes', function () {
        return view('users.cavim.bonoChoferes');
    })->name('Cavim_bonoChoferes');

    Route::get('/contabilidad_activosfijos', function () {
        return view('users.contabilidad.activosfijos');
    })->name('Contabilidad_ActivosFijos');

    Route::get('/almacen_politicaPrecios', function () {
        return view('users.almacen.politicaprecio');
    })->name('Contabilidad_ActivosFijos');

    Route::get('/ti_excepciones', function () {
        return view('users.ti.excepciones');
    })->name('ti_excepciones');

    Route::get('/ti_usuarioSucursal', function () {
        return view('users.ti.usuarioSucursal');
    })->name('ti_usuarioSucursal');

    Route::get('/ti_usuarioincidencia', function () {
        return view('users.ti.usuarioIncidencia');
    })->name('ti_usuarioincidencia');

    Route::get('/compras_proveedor', function () {
        return view('users.compras.compras');
    })->name('compras_proveedor');

    Route::get('/RH_quizz', function () {
        return view('users.recursoshumanos.quizz');
    })->name('RH_quizz');

    Route::get('/RH_resguardos', function () {
        return view('users.recursoshumanos.resguardo');
    })->name('RH_resguardos');

    Route::get('/RH_incidencias', function () {
        return view('users.recursoshumanos.incidencias');
    })->name('RH_incidencias');

    Route::get('/ventas_facturacion', function () {
        return view('users.ventas.facturacion');
    })->name('ventas_facturacion');

    Route::get('/ventas_pedido', function () {
        return view('users.ventas.pedido');
    })->name('ventas_pedido');
});

Route::get('/', function () {
    return redirect()->route('login');
    //return view('layouts.home');
})->name('home');

Route::get('/login', function () {
    if(Auth::check() == true){
        return redirect()->route('dashboard');}
    else{
        return view('login.index');}
})->name('login');



Route::post('/login', 'Login\LoginController@login');