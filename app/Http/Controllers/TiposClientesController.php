<?php

namespace App\Http\Controllers;

use App\TiposClientes;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use nilsenj\Toastr\Facades\Toastr;

class TiposClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('clientes/tipos/index')->with(['tiposClientes' => TiposClientes::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes/tipos/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        TiposClientes::create($request->all());
        Toastr::success('Tipo de cliente creado correctamente', $title = 'Ok!', $options = []);
        return redirect('/clientes/tipos');
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
        return view('clientes/tipos/edit')->with(['tipoCliente' => TiposClientes::findOrFail($id)]);
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
        TiposClientes::findOrFail($id)->update($request->all());
        Toastr::success('Tipo de cliente editado correctamente', $title = 'Ok!', $options = []);
        return redirect('/clientes/tipos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TiposClientes::findOrFail($id)->destroy();
        Toastr::success('Tipo de cliente eliminado correctamente', $title = 'Ok!', $options = []);
        return redirect('/clientes/tipos');
    }
}
