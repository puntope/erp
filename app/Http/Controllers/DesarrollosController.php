<?php

namespace App\Http\Controllers;

use App\Clientes;
use App\Desarrollos;
use App\TiposProyecto;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DesarrollosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tareas.desarrollo.index')->with(['desarrollos'=>Desarrollos::where('finalizado',0)->get(),'clientes'=>Clientes::all(), 'tiposProyectos'=>TiposProyecto::all()]);

    }

    public function finalizados()
    {
        return view('tareas.desarrollo.finalizados')->with(['desarrollos'=>Desarrollos::where('finalizado',1)->get(),'clientes'=>Clientes::all(), 'tiposProyectos'=>TiposProyecto::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tareas.desarrollo.create')->with(['clientes'=>Clientes::all(), 'tiposProyectos'=>TiposProyecto::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Desarrollos::create($request->all());
        Session::put('message', 'Desarrollo creado correctamente');
        return redirect('/desarrollos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $desarrollo = Desarrollos::find($id);
        $cliente = Clientes::find($desarrollo->cliente()->first()->id);
        $tipoProyecto = TiposProyecto::find($desarrollo->tipoProyecto()->first()->id);
        return view('tareas.desarrollo.show')->with(['cliente'=>$cliente, 'desarrollo'=>$desarrollo, 'tiposProyectos'=>$tipoProyecto]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('tareas.desarrollo.edit')->with(['desarrollo'=>Desarrollos::findOrFail($id),'clientes'=>Clientes::all(), 'tiposProyectos'=>TiposProyecto::all()]);
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
        $desarrollo = Desarrollos::findOrFail($id);
        $desarrollo->update($request->all());

        Session::put('message', 'Desarrollo editado correctamente');
        return redirect('/desarrollos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $desarrollo = Desarrollos::findOrFail($id);
        $desarrollo->delete();
        Session::put('message', 'Desarrollo borrado correctamente');
        return redirect('/desarrollos');
    }



    public function getDesarrollos($id_cliente,$id_proyecto)
    {
        $desarrollos = Desarrollos::where('cliente_id',$id_cliente)->where('tipo_proyecto_id',$id_proyecto)->get();
        return $desarrollos;
    }

    public function finalizar($id) {

        Desarrollos::findOrFail($id)->update(['finalizado'=> true]);
        Session::put('message', 'Desarrollo marcado como finalizado');
        return back();
    }
}
