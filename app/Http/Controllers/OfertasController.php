<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use App\Models\Producto;
use Illuminate\Http\Request;

class OfertasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ofertas = Oferta::all();
        return view('tablas.tablaOfertas')->with('ofertas',$ofertas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos = Producto::pluck('nombre_producto');
        return view('forms.forms_create.form_create_oferta')->with('productos',$productos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_producto' => 'required',
            'fecha_inicio' => 'required', //date
            'fecha_fin' => 'required ', //date
            'descuento' => 'required | min:1 | max: 100'
        ],
        [
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria',
            'fecha_fin.required' => 'La fecha de fin es obligatoria',
            'descuento.required' => 'El descuento es obligatorio',

        ]);

        $oferta = new Oferta();
        $oferta -> fecha_inicio = $request->fecha_inicio;
        $oferta -> fecha_fin = $request->fecha_fin;
        $oferta -> descuento = $request -> descuento;

        $id_producto = Producto::where('nombre_producto','=',$request->nombre_producto)->value('id');
        $oferta -> id_producto = $id_producto;
        $oferta->save(); 

        return redirect('/tablaOfertas')
		->with('success','Nuevo producto agregado');
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
    public function edit($id_oferta)
    {
        $productos = Producto::pluck('nombre_producto');
        $oferta = Oferta::where('id',$id_oferta);
        $producto_de_la_oferta = Producto::where('id',$oferta->value('id_producto'))->value('nombre_producto');
        
        return view('forms.forms_edit.form_edit_oferta') 
            ->with('id_oferta',$id_oferta)
            ->with('producto_de_la_oferta',$producto_de_la_oferta)
            ->with('fecha_inicio',$oferta->value('fecha_inicio')) 
            ->with('fecha_fin', $oferta->value('fecha_fin'))
            ->with('descuento', $oferta->value('descuento'))
            ->with('productos',$productos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_oferta)
    {
        $request->validate([
            'nombre_producto' => 'required',
            'fecha_inicio' => 'required', //date
            'fecha_fin' => 'required ', //date
            'descuento' => 'required | min:1 | max: 100'
        ],
        [
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria',
            'fecha_fin.required' => 'La fecha de fin es obligatoria',
            'descuento.required' => 'El descuento es obligatorio',

        ]);

        $oferta = Oferta::find($id_oferta);
        $oferta -> fecha_inicio = $request->fecha_inicio;
        $oferta -> fecha_fin = $request->fecha_fin;
        $oferta -> descuento = $request -> descuento;

        $id_producto = Producto::where('nombre_producto','=',$request->nombre_producto)->value('id');
        $oferta -> id_producto = $id_producto;
        $oferta->save(); 

        return redirect('/tablaOfertas')
		->with('success','Nuevo producto agregado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_oferta)
    {
        Oferta::destroy($id_oferta);
        return redirect('/tablaOfertas')
		->with('success','Producto eliminado');
    }
}
