<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $categoria = Categoria::all();
        return view('tablas.tablaCategorias')->with('categorias',$categoria);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.forms_create.form_create_categoria');
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
            'nombre' => 'required | string | unique:categoria',
        ]);

        $categoria = new Categoria();
        $categoria -> nombre = $request->nombre;
        $categoria -> save();

        return redirect('/tablaCategorias')
		->with('success','Nueva categoria registrada');
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
    public function edit($id_categoria)
    {
        $nombre_categoria = Categoria::where('id',$id_categoria)->value('nombre');
        return view('forms.forms_edit.form_edit_categoria')
        ->with('nombre_categoria',$nombre_categoria)
        ->with('id_categoria',$id_categoria);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_categoria)
    {
        $request->validate([
            'nombre' => 'required | string ',
        ]);

        $categoria = Categoria::find($id_categoria);
        $categoria -> nombre = $request->nombre;
        $categoria -> save();

        return redirect('/tablaCategorias')
		->with('success','Nueva categoria registrada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id_categoria = $request->id_categoria;
        Categoria::destroy($id_categoria);
        return redirect('/tablaCategorias')
		->with('success','Categoria eliminada');

    }
}
