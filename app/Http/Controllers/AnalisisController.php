<?php

namespace App\Http\Controllers;

use App\Clientes;
use App\Tareas;
use App\TiposProyecto;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class AnalisisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('analisis.index',['clientes' => Clientes::all(), 'tiposTareas' => TiposProyecto::all(), 'users' => User::all()]);
    }

    public function getAnalisis(Request $filtro) {

        $tareas = Tareas::filtro($filtro->all());

        return response($tareas->get());
    }

    /**
     * Exporta un recurso
     *
     * @see https://github.com/Maatwebsite/Laravel-Excel
     */

    public function export(Request $filtro) {

        $result = [];

        $tareas = Tareas::filtro($filtro->all())->get();

        foreach ($tareas as $tarea) {

            $user = $tarea->user()->first()->alias;
            $tipo = $tarea->tipoTarea()->first()->nombre;

            $result[] = ['titulo' => $tarea->titulo, 'tiempo' => $tarea->tiempo, 'empleado' => $user, 'tipo'=>$tipo ];
        }

        Excel::create('analisis', function($excel) use($result) {

            $excel->sheet('Sheetname', function($sheet) use ($result) {

                $sheet->fromArray($result);

            });

        })->store('xls', storage_path('excel/exports'));

    }

    public function getExport() {

        $path = storage_path() . '/excel/exports/analisis.xls';
        return response()->download($path, 'analisis.xls');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
