<?php

namespace App\Http\Controllers;

use App\Desarrollos;
use App\TiposProyecto;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class TiposProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        return view('tiposProyecto.index')
            ->with(
                [
                    'tiposProyecto'=>TiposProyecto::orderBy('nombre')->get(),
                ]
            );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tiposProyecto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->hasFile('logo')) {

            if ($request->file('logo')->isValid()) {
                $frendlyPathName = str_slug($request->input('nombre')) . '.' . $request->file('logo')->getClientOriginalExtension();
                $partialPath = '/img/tipos_proyecto/' . $frendlyPathName;


                $path = public_path() . '/img/tipos_proyecto/';
                $request->file('logo')->move($path, $frendlyPathName);

            } else {
                $partialPath = '/img/tipos_proyecto/otros.png';
            }
        } else {
            $partialPath = '/img/tipos_proyecto/otros.png';
        }

        if (TiposProyecto::create($request->all())) {
            $tipo_proyecto = TiposProyecto::all()->last();
            $tipo_proyecto->logo = $partialPath;
            $tipo_proyecto->save();
            Session::put('message', 'Tipo de proyecto creado correctamente');
            return redirect('/proyectos');
        };

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

        return view('tiposProyecto.edit')->with(['tipo'=>TiposProyecto::findOrFail($id)]);
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

        $tipoProyecto = TiposProyecto::findOrFail($id);

        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {

            $frendlyPathName = str_slug($request->input('nombre')) . '.' . $request->file('logo')->getClientOriginalExtension();
            $partialPath = '/img/tipos_proyecto/' . $frendlyPathName;


            $path = public_path() . '/img/tipos_proyecto/';
            $request->file('logo')->move($path, $frendlyPathName);

        } else {
            $partialPath = $tipoProyecto->logo;
        }


        if ($tipoProyecto->update($request->all())) {


            $tipoProyecto->logo = $partialPath;
            $tipoProyecto->save();

            Session::put('message', 'Tipo de proyecto editado correctamente');
            return redirect('/proyectos');
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
        $tipo = TiposProyecto::findOrFail($id);
        $tipo->delete();
        Session::put('message', 'Tipo de proyecto borrado correctamente');
        return redirect('/proyectos');
    }

    /**
     * Obtiene todos los tipos de proyecto
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function  getTiposProyecto() {
        return TiposProyecto::orderBy('nombre')->get();
    }

    
}
