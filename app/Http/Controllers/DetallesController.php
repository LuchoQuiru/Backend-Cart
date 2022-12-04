<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JeroenNoten\LaravelAdminLte\View\Components\Widget\Alert;
use App\Models\Detalle;;
use App\Models\User;;
use App\Models\Producto;;


class DetallesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $detalles = Detalle::where("id_pedido" , "=" , $request->input('id_pedido'))->get();
        $salida = array();
        foreach($detalles as $detalle){
            $salida [] = array(
                'id_pedido' => $detalle -> id_pedido,
                'id_producto' => $detalle -> producto -> nombre_producto,
                'cantidad' => $detalle -> cantidad,
                'total' => $detalle -> total
            );
        }
        return response(json_encode($salida),200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuarios = User::pluck('name');
        $productos = Producto::pluck('nombre_producto');  
        return view('formularios/formularioDetalle')
            ->with('usuarios' , $usuarios)
            ->with('productos',$productos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    
}
