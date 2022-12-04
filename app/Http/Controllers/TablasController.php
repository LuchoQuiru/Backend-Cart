<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TablasController extends Controller
{
    public function index(){
        $usuarios = User::all();
        return view("tablas.tablaUsuarios")->with('usuarios',$usuarios);
    }

    public function create(){
        return view('forms.forms_create.form_create_usuario');
    }

    public function edit($id_usuario)
    {
        $usuario = User::where('id',$id_usuario);
        return view('forms.forms_edit.form_edit_usuario') 
            ->with('id_usuario',$id_usuario)
            ->with('nombre_usuario',$usuario->value('name'))
            ->with('email',$usuario->value('email'));
    }

    public function update(Request $request, $id_usuario){
        $request->validate([
            'nombre' => 'required | string',
            'email' => 'required'
        ]);

        $user = User::find($id_usuario);
        $user -> name = $request->nombre;
        $user -> email = $request->email;
        if($request->password != null){
            $user -> password = $request->password;        
        };
        
        $user -> save();

        return redirect('/tablaUsuarios')
		->with('success','Usuario actualizado');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required | string',
            'email' => 'required | unique:users',
            'password' => 'required'
        ]);

        $user = new User();
        $user -> name = $request->nombre;
        $user -> email = $request->email;
        $user -> password = $request->password;
        
        $user -> save();

        return redirect('/tablaUsuarios')
		->with('success','Nuevo usuario registrado');
    }

    public function destroy($id_usuario){
        User::destroy($id_usuario);
        return redirect('/tablaUsuarios')
		->with('success','Usuario eliminado');
    }
}
