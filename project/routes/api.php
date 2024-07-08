<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/usuario/ordenes/{userId}', [UsuarioController::class, 'UsuarioOrdenes']);

// Ruta para obtener información detallada de los pedidos, incluyendo nombre y correo de los usuarios
Route::get('/usuario/ordenes-detalladas', [UsuarioController::class, 'obtenerOrdenes']);

// Ruta para obtener los pedidos en el rango de 100 a 200
Route::get('/usuario/pedidos-rango', [UsuarioController::class, 'pedidosRango']);

// Ruta para obtener los nombres que empiecen con la letra R
Route::get('/usuario/nombres-con-r', [UsuarioController::class, 'nombreConR']);

// Ruta para calcular el total de registros en la tabla de pedidos para el usuario con ID 5
Route::get('/usuario/total-pedidos/{userId}', [UsuarioController::class, 'totalPedidosUsuario']);

// Ruta para recuperar todos los pedidos junto con la información de los usuarios, ordenándolos de forma descendente según el total del pedido
Route::get('/usuario/pedidos-usuarios-ordenados', [UsuarioController::class, 'pedidosUsuarioOrdenados']);

// Ruta para obtener la suma total del campo "total" en la tabla de pedidos
Route::get('/usuario/suma-total-pedidos', [UsuarioController::class, 'sumaTotalPedidos']);

// Ruta para encontrar el pedido más económico, junto con el nombre del usuario asociado
Route::get('/usuario/pedido-mas-economico', [UsuarioController::class, 'pedidoMasEconomico']);

// Ruta para obtener el producto, la cantidad y el total de cada pedido, agrupándolos por usuario
Route::get('/usuario/pedidos-agrupados', [UsuarioController::class, 'pedidosAgrupadosPorUsuario']);

