<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::all();

        foreach ($productos as $producto) {
            if($producto->img != null){
                $image = $producto->img;  // your base64 encoded
                $image = str_replace('data:image/png;base64,', '', stream_get_contents($image));
                $image = str_replace(' ', '+', $image);
                $imageName = $producto->nombre_producto . '.jpg';

                Storage::disk('public')->put($imageName, base64_decode($image),'public');
            }
        }
        return view('tablas.tablaProductos')->with('productos', $productos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nombres_categorias = Categoria::pluck('nombre');
        return view('forms.forms_create.form_create_producto')->with('categorias', $nombres_categorias);
    }

    public function getCategorias()
    {
        $salida = Categoria::all();
        return response(json_encode($salida), 200);
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
            'nombre_producto' => 'required | string | unique:productos',
            'stock' => 'required | numeric',
            'precio' => 'required | numeric',
            'nombre_categoria' => 'required',
        ]);

        $producto = new Producto();
        $producto->nombre_producto = $request->nombre_producto;
        $producto->stock = $request->stock;
        $producto->precio = $request->precio;
        if ($request->image != null)
            $producto->img = base64_encode(file_get_contents($request->file('image')->path()));

        $id_categoria = Categoria::where('nombre', '=', $request->nombre_categoria)->value('id');
        $producto->id_categoria = $id_categoria;
        $producto->save();

        return redirect('/tablaProductos')
            ->with('success', 'Nuevo producto agregado');
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
    public function edit($id_producto)
    {
        $producto = Producto::where('id', $id_producto);
        $categoria_producto = Categoria::where('id', $producto->value('id_categoria'))->value('nombre');
        $nombres_categorias = Categoria::pluck("nombre");
        return view('forms.forms_edit.form_edit_producto')
            ->with('id_producto', $id_producto)
            ->with('nombre_producto', $producto->value('nombre_producto'))
            ->with('stock', $producto->value('stock'))
            ->with('precio', $producto->value('precio'))
            ->with('categoria_producto', $categoria_producto)
            ->with('categorias', $nombres_categorias)
            ->with('update', 'update');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_producto)
    {
        $request->validate([
            'nombre_producto' => 'required | string ',
            'stock' => 'required | numeric',
            'precio' => 'required | numeric',
            'nombre_categoria' => 'required'
        ]);

        $producto = Producto::find($id_producto);
        $producto->nombre_producto = $request->nombre_producto;
        $producto->stock = $request->stock;
        $producto->precio = $request->precio;
        if ($request->image != null)
            $producto->img = base64_encode(file_get_contents($request->file('image')->path()));

        $id_categoria = Categoria::where('nombre', '=', $request->nombre_categoria)->value('id');
        $producto->id_categoria = $id_categoria;
        $producto->save();

        return redirect('/tablaProductos')
            ->with('success', 'Nuevo producto agregado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_producto)
    {
        Producto::destroy($id_producto);
        return redirect('/tablaProductos')
            ->with('success', 'Producto eliminado');
    }
}
