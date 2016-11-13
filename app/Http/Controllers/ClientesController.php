<?php

namespace App\Http\Controllers;

use App\Clientes;
use App\TiposClientes;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use nilsenj\Toastr\Facades\Toastr;

class ClientesController extends Controller
{

    
    public function historico($id, $mes, $ano) {

            $cliente = Clientes::find($id);

            $realizadas = round($cliente->tareas()->HorasMesMantenimiento($mes,$ano)->sum('tiempo')/60,1);
            $restantes = round($cliente->tiempo_mes - $realizadas,1);

            if ($restantes < 0) {
                $average = 'text-danger';
                $masMenos = 'text-danger';
            } else if ($restantes < (($cliente->tiempo_mes/100) * 10)) {
                $average = 'text-warning';
                $masMenos = 'text-success';
            } else {
                $average = 'primary';
                $masMenos = 'text-success';
            }

            return view('clientes.show')->with(['mes' => $mes, 'ano' => $ano,'cliente'=>$cliente,'realizadas' => $realizadas, 'average' => $average, 'masMenos' => $masMenos, 'restantes' => $restantes]);
        
    }   
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('clientes.index')->with(['tiposClientes'=>TiposClientes::all(),'clientes'=>Clientes::activos()->visibles()->tipoCliente(2)->orderBy('tiempo_mes','DESC')->get(),'otros'=>Clientes::activos()->visibles()->tipoCliente(3)->get()]);
    }

    public function todos()
    {
        return view('clientes.index')->with(['tiposClientes'=>TiposClientes::all(),'clientes'=>Clientes::all(), 'otros' => []]);
    }

    public function getTiposClientes() {
        return TiposClientes::all();
    }

    public function getClientes() {
        return Clientes::all();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.create')->with(['tiposClientes'=>TiposClientes::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {


        if ($request->hasFile('logo')) {

            if ($request->file('logo')->isValid()) {
                $frendlyPathName = str_slug($request->input('nombre')) . '.' . $request->file('logo')->getClientOriginalExtension();
                $partialPath = '/img/clientes/' . $frendlyPathName;


                $path = public_path() . '/img/clientes/';
                $request->file('logo')->move($path, $frendlyPathName);

            } else {
                $partialPath = '/img/clientes/ril-logo-negro.png';
            }
        } else {
            $partialPath = '/img/clientes/ril-logo-negro.png';
        }

        if (Clientes::create($request->all())) {
            $cliente = Clientes::all()->last();
            $cliente->logo = $partialPath;
            $cliente->save();
            Toastr::success('Cliente creado correctamente', $title = 'Ok!', $options = []);
            return redirect('/clientes');
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
        
        $cliente = Clientes::find($id);

        $realizadas = round($cliente->tareas()->HorasMesMantenimiento()->sum('tiempo')/60,1);
        $restantes = round($cliente->tiempo_mes - $realizadas,1);

        if ($restantes < 0) {
            $average = 'text-danger';
            $masMenos = 'text-danger';
        } else if ($restantes < (($cliente->tiempo_mes/100) * 10)) {
            $average = 'text-warning';
            $masMenos = 'text-success';
        } else {
            $average = 'primary';
            $masMenos = 'text-success';
        }

        return view('clientes.show')->with(['mes' => Carbon::today()->format('m'), 'ano' => Carbon::today()->format('Y'), 'cliente'=>$cliente,'realizadas' => $realizadas, 'average' => $average, 'masMenos' => $masMenos, 'restantes' => $restantes]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('clientes.edit')->with(['tiposClientes'=>TiposClientes::all()->toArray(),'cliente'=>Clientes::findOrFail($id)]);
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
        $cliente = Clientes::findOrFail($id);

        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {

                $frendlyPathName = str_slug($request->input('nombre')) . '.' . $request->file('logo')->getClientOriginalExtension();
                $partialPath = '/img/clientes/' . $frendlyPathName;


                $path = public_path() . '/img/clientes/';
                $request->file('logo')->move($path, $frendlyPathName);

        } else {
            $partialPath = $cliente->logo;
        }


        if ($cliente->update($request->all())) {


            $cliente->logo = $partialPath;
            $cliente->save();


            Toastr::success('Cliente editado correctamente', $title = 'Ok!', $options = []);
            return redirect('/clientes');
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
        $cliente = Clientes::findOrFail($id);
        $cliente->delete();
        Toastr::success('Cliente eliminado correctamente', $title = 'Ok!', $options = []);
        return view('clientes.index')->with(['tiposClientes'=>TiposClientes::all(),'clientes'=>Clientes::tipoCliente(1)->orderBy('tiempo_mes','DESC')->get(),'otros'=>Clientes::tipoCliente(3)->get()]);
    }
}
