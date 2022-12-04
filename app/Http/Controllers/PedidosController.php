<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Detalle;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Response;
use phpDocumentor\Reflection\Types\ArrayKey;

use Illuminate\Support\Arr;
use SebastianBergmann\Environment\Console;

class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Pedido::all();
        $this->limpiarSesion();
        return view('tablas.tablaPedidos')->with('pedidos',$pedidos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        $this->limpiarSesion();     
        return($this->vista_create_pedido());
    }

    public function vista_create_pedido(){
        $usuario_seleccionado = $this->obtenerUsuarioDesdeLaSession();
        $usuarios = User::pluck('name');
        $productos = Producto::pluck('nombre_producto');  
        return view('forms.forms_create.form_create_pedido')
            ->with('usuarios' , $usuarios)
            ->with('productos',$productos)
            ->with('usuario_seleccionado',$usuario_seleccionado);
    }    
        

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arreglo_detalles = $this->obtenerDetallesDesdeLaSesion();
        if($arreglo_detalles!=null){
            $request->validate([
                'usuario' => 'required'
            ]);

            $id_usuario = User::where('name','=',$request->usuario)->value('id'); 
            $pedido = new Pedido();
            $pedido -> id_usuario = $id_usuario;
            $pedido -> total = 0;
            $pedido -> save(); //para generar un id para el pedido. 
            
            
            $total_pedido = 0;

            foreach($arreglo_detalles as $detalle){
                $detalle -> id_pedido = $pedido->id;
                $total_detalle = ($detalle -> producto -> precio) * ($detalle -> cantidad) ;
                $detalle -> total = $total_detalle;
                $total_pedido += $total_detalle;
                $detalle->save();
            }

            $pedido -> total = $total_pedido;
            $pedido -> save();
        }

        if(session()->get('id_pedido') != null)
            Pedido::destroy(array_values(session()->get('id_pedido'))[0]); //elimino el pedido anterior 
        $this->limpiarSesion();

        return redirect('/tablaPedidos')
		->with('success','Nuevo pedido agregado');
    }
    
    public function edit($id_pedido)
    {        
            $this->limpiarSesion();

            //cargo el id del pedido a la sesion
            session()->push('id_pedido',$id_pedido);

            //cargo el nombre del usuario relacionado al pedido, a la sesion
            $id_usuario = Pedido::where('id',$id_pedido)->value('id_usuario');
            $nombre_usuario = User::where('id',$id_usuario)->value('name');
            session()->push('usuario',$nombre_usuario);

            //cargo los detalles a la sesion
            $detalles = Detalle::where('id_pedido',$id_pedido)->get();
            foreach($detalles as $detalle){
                $nombre_producto = Producto::where('id',$detalle->id_producto)->value('nombre_producto');
                session()->push('item' , [$nombre_producto => $detalle->cantidad]);
            }

            return ($this->vista_edit_desde_session($id_pedido));
    }
    

    private function vista_edit_desde_session($id_pedido){
            $usuario_seleccionado = $this->obtenerUsuarioDesdeLaSession();
            $usuarios = User::pluck('name');
            $productos = Producto::pluck('nombre_producto');  
            return view('forms.forms_edit.form_edit_pedido')
                ->with('usuarios' , $usuarios)
                ->with('productos',$productos)
                ->with('id_pedido',$id_pedido)
                ->with('usuario_seleccionado',$usuario_seleccionado);
    }
    


    public function limpiarSesion(){
        session()->forget('item');
        session()->forget('usuario');
        session()->forget('id_pedido');
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
        Pedido::destroy($id);
        return($this->store($request));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pedido::destroy($id);
        return redirect('/tablaPedidos');
    }

    public function destroyDetalleCreateSession($nombre_producto)
    {        
        $items = session()->get('item');
        session()->forget('item');
        foreach($items as $item){
            if(key($item) != $nombre_producto)
                session()->push('item' , [key($item)=>array_values($item)[0]]);
        }; 
        
        return($this->vista_create_pedido());
    }

    public function destroyDetalleEditSession($id_pedido,$nombre_producto)
    {        
        $items = session()->get('item');
        session()->forget('item');
        foreach($items as $item){
            if(key($item) != $nombre_producto)
                session()->push('item' , [key($item)=>array_values($item)[0]]);
        }; 
        
        return($this->vista_edit_desde_session($id_pedido));
    }


    public function tabla_detalles_create_pedido(){
        $usuario = session()->get('usuario');
        $arreglo_detalles = $this->obtenerDetallesDesdeLaSesion(); 
        return view('tablas.tablaDinamicaDetallesCreatePedido')
            ->with('detalles',$arreglo_detalles)
            ->with('usuario',$usuario);
    }

    public function tabla_detalles_edit_pedido($id_pedido){        
        $usuario = session()->get('usuario');
        $arreglo_detalles = $this->obtenerDetallesDesdeLaSesion(); 
        return view('tablas.tablaDinamicaDetallesEditPedido')
            ->with('detalles',$arreglo_detalles)
            ->with('usuario',$usuario)
            ->with('id_pedido',$id_pedido);
    }

    public function obtenerDetallesDesdeLaSesion(){
        if(session()->get('item') == null)
            return "";
        
        $items = session()->get('item');
        $nombre_producto = '';
        $cantidad = '' ;
        $arreglo_detalles = array();
        foreach($items as $item){          
            $nombre_producto = key($item);
            $cantidad = array_values($item)[0];
            $id_producto = Producto::where("nombre_producto",'=',$nombre_producto)->value('id');
            $detalle = new Detalle();
            $detalle->id_producto = $id_producto;
            $detalle->cantidad = $cantidad;
            array_push($arreglo_detalles , $detalle);
        
        };
        return $arreglo_detalles;
    }

    public function agregarProductoALaSesionDeUnNuevoPedido(Request $request){
        $request->validate([
            'nombre_producto' => 'required | string',
            'cantidad' => 'required | numeric',
        ]);

        $nombre_producto = $request->input('nombre_producto');
        $cantidad = $request->input('cantidad');
        session()->push('item' , [$nombre_producto=>$cantidad]);
        
        return($this->vista_create_pedido());
    }

    public function agregarProductoAlEditDelPedido($id_pedido, Request $request){
        $request->validate([
            'nombre_producto' => 'required | string',
            'cantidad' => 'required | numeric',
        ]);
        $nombre_producto = $request->input('nombre_producto');
        $cantidad = $request->input('cantidad');
        session()->push('item' , [$nombre_producto=>$cantidad]);
        
        return($this->vista_edit_desde_session($id_pedido));
    }


    public function agregarUsuarioALaSesion(Request $request){
        session()->forget('usuario');
        session()->push('usuario' ,$request->input("usuario"));
    }

    public function obtenerUsuarioDesdeLaSession(){
        if(session()->get('usuario') != null)
            return session()->get('usuario')[0];
        else
            return '';
    }

    // public function verSession(){
    //     return session()->all();
    // }

    // public function limpiarSession(){
    //     session()->forget('pedido');
    //     return session()->forget('item');
    // }

    
}
