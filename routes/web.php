<?php

use App\Http\Controllers\Usuario\Admin_login;
use App\Http\Controllers\Usuario\Admin_usuario;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->middleware(['no_autenticados'])->group(function(){
    Route::get('/', function () {
        return view('login');
    })->name('login');
    Route::get('/login', function () {
        return view('login');
    })->name('login');
    Route::post('ingresar',[Admin_login::class, 'ingresar'])->name('ingresar');
});


Route::prefix('/admin')->middleware(['autenticados'])->group(function(){
    Route::controller(Admin_login::class)->group(function(){
        Route::get('inicio','inicio')->name('inicio');
        Route::get('sistemas','sistemas')->name('sistemas');
        Route::get('recaudaciones','recaudaciones')->name('recaudaciones');
        Route::get('caja','caja')->name('caja');
        Route::post('salir','cerrar_session')->name('salir');
    });

    /**
     * ADMINISTRACION DE USUARIOS
     */
    Route::controller(Admin_usuario::class)->group(function(){
        Route::get('sys/perfil','perfil')->name('perfil');
        Route::post('sys/guardar_perfil','guardar_perfil')->name('guardar_perfil');
        Route::post('sys/guardar_password','guardar_password')->name('guardar_password');
        //USUARIOS
        Route::get('sys/usuarios','usuarios')->name('usuarios');
        Route::post('sys/usuario_guardar','usuario_guardar')->name('usuario_guardar');
        Route::post('sys/usuario_validar','usuario_validar')->name('usuario_validar');
        Route::post('sys/usuario_listar','usuario_listar')->name('usuario_listar');
        Route::post('sys/usuario_estado','usuario_estado')->name('usuario_estado');
        Route::delete('sys/usuario_eliminar','usuario_eliminar')->name('usuario_eliminar');
        Route::post('sys/usuario_reset','usuario_reset')->name('usuario_reset');
        Route::post('sys/usuario_reset_guardar','usuario_reset_guardar')->name('usuario_reset_guardar');
        Route::post('sys/usuario_editar_guardar','usuario_editar_guardar')->name('usuario_editar_guardar');
        //ROLES
        Route::get('sys/roles','roles')->name('roles');
        Route::post('sys/rol_nuevo','rol_nuevo')->name('rol_nuevo');
        Route::delete('sys/rol_eliminar','rol_eliminar')->name('rol_eliminar');
        Route::post('sys/rol_editar','rol_editar')->name('rol_editar');
        Route::post('sys/rol_editar_guardar','rol_editar_guardar')->name('rol_editar_guardar');
        //PERMISOS
        Route::get('sys/permisos','permisos')->name('permisos');
        Route::post('sys/permiso_nuevo','permiso_nuevo')->name('permiso_nuevo');
        Route::get('sys/permiso_listar','permiso_listar')->name('permiso_listar');
        Route::post('sys/permiso_eliminar','permiso_eliminar')->name('permiso_eliminar');
        Route::post('sys/permiso_editar','permiso_editar')->name('permiso_editar');
        Route::post('sys/permiso_editado','permiso_editado')->name('permiso_editado');
    });
});
