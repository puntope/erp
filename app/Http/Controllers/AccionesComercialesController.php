<?php

namespace App\Http\Controllers;

use App\Clientes;
use App\Comerciales;
use App\Desarrollos;
use App\Estados;
use App\TiposClientes;
use App\TiposProyecto;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AccionesComercialesController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('clientes.comerciales.index')->with(['comerciales' => Comerciales::all(), 'estados' => Estados::all()]);
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.comerciales.create')->with(['estados'=>Estados::all(),'clientes'=>Clientes::all(), 'tipos_proyecto' => TiposProyecto::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $partialPath = '';

        if ($request->hasFile('presupuesto')) {
            if ($request->file('presupuesto')->isValid()) {
                $frendlyPathName = str_slug($request->input('nombre')) . '.' . $request->file('presupuesto')->getClientOriginalExtension();
                $partialPath = '/files/presupuestos/' . $frendlyPathName;

                $path = public_path() . '/files/presupuestos/';
                $request->file('presupuesto')->move($path, $frendlyPathName);
            }
        }

        if (Comerciales::create($request->all())) {
            $comercial = Comerciales::all()->last();
            $comercial->presupuesto = $partialPath;
            $comercial->save();
            Session::put('message', 'Acción comercial creada correctamente');
            return redirect('/comerciales');
        };
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function setEstado($id, $estado_id)
    {
        $comercial = Comerciales::findOrFail($id);
        $comercial->update(['estado_id' => $estado_id]);
        Session::put('message', 'Estado cambiado correctamente');
        return redirect()->back();
    }

    public function promotion($id) {
        $comercial = Comerciales::findOrFail($id);

        if ($comercial->horas > 0) {
            Desarrollos::create([
                'nombre' => $comercial->nombre,
                'descripcion' => $comercial->descripcion,
                'cliente_id' => $comercial->cliente_id,
                'tipo_proyecto_id' => $comercial->tipo_proyecto_id,
                'horas' =>  $comercial->horas,
            ]);
        }

        if ($comercial->horas_mes > 0) {
            $cliente = Clientes::findOrFail($comercial->cliente_id);

            if ($cliente->tipo_cliente_id == 4) {
                $cliente->tipo_cliente_id = 1;
            }
            $cliente->tiempo_mes = $comercial->horas_mes;
            $cliente->save();
        }
        Session::put('message', 'Presupuesto promocionado correctamente');
        return redirect()->back();


    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('clientes.comerciales.edit')->with(['comercial' => Comerciales::findOrFail($id), 'estados'=>Estados::all(),'clientes'=>Clientes::all(), 'tipos_proyecto' => TiposProyecto::all()]);
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
        $comercial = Comerciales::findOrFail($id);
        $partialPath = $comercial->presupuesto;

        if ($request->hasFile('presupuesto') && $request->file('presupuesto')->isValid()) {

            $frendlyPathName = str_slug($request->input('nombre')) . '.' . $request->file('presupuesto')->getClientOriginalExtension();
            $partialPath = '/files/presupuestos/' . $frendlyPathName;


            $path = public_path() . '/files/presupuestos/';
            $request->file('presupuesto')->move($path, $frendlyPathName);

        }


        if ($comercial->update($request->all())) {
            $comercial->presupuesto = $partialPath;
            $comercial->save();


            Session::put('message', 'Acción comercial editada correctamente');
            return redirect()->back();
        };

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comercial = Comerciales::findOrFail($id);
        $comercial->delete();
        Session::put('message', 'Coemrcial borrado correctamente');
        return redirect('/comerciales');
    }
}
