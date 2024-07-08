<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    
     // Recuperar todos los pedidos asociados al usuario con ID 2
    public function UsuarioOrdenes($userId)
    {
        $orders = Pedido::where('usuario_id', $userId)->get();
        return response()->json($orders);
    }


   // Obtener información detallada de los pedidos, incluyendo nombre y correo de los usuarios
   public function obtenerOrdenes()
   {
       $orders = Pedido::with('usuario')->get();
       return response()->json($orders);
   }

   //obtener los pedidos de el rango de 100 a 200
   public function pedidosRango()
   {
    $rango = Pedido::whereBetween('total',[100,200])
    ->get();
    return response()->json($rango);
   }

   //obtener los nombres que empiecen con la letra R
   public function nombreConR()
   {
    $nombre = Usuario::where('nombre','like','r%')
    ->get();
    return response()->json($nombre);
   }


    // Calcular el total de registros en la tabla de pedidos para el usuario con ID 5
    public function totalPedidosUsuario($userId)
    {
        $totalPedidos = Pedido::where('usuario_id', $userId)->count();
        return response()->json(['total_pedidos' => $totalPedidos]);
    }

    // Recuperar todos los pedidos junto con la información de los usuarios, ordenándolos de forma descendente según el total del pedido
    public function pedidosUsuarioOrdenados()
    {
        $pedidos = Pedido::with('usuario')->orderBy('total', 'desc')->get();
        return response()->json($pedidos);
    }

     // Obtener la suma total del campo "total" en la tabla de pedidos
    public function sumaTotalPedidos()
    {
        $sumaTotal = Pedido::sum('total');
        return response()->json(['suma_total' => $sumaTotal]);
    }

     // Encontrar el pedido más económico, junto con el nombre del usuario asociado
     public function pedidoMasEconomico()
     {
         $pedido = Pedido::orderBy('total', 'asc')->first();
         $usuario = $pedido->usuario; // Asumiendo que hay una relación 'usuario' en el modelo Pedido
         return response()->json([
             'pedido' => $pedido,
             'usuario' => $usuario
         ]);
     }
 
     // Obtener el producto, la cantidad y el total de cada pedido, agrupándolos por usuario
     public function pedidosAgrupadosPorUsuario()
     {
         $pedidos = Pedido::select('producto', 'cantidad', 'total', 'usuario_id')
             ->with('usuario')
             ->get()
             ->groupBy('usuario_id');
         return response()->json($pedidos);
     }

 
}
