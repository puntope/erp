<?php

namespace App\Http\Controllers;

use App\Clientes;
use App\Desarrollos;
use App\Tareas;
use App\TiposProyecto;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class TareasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Clientes::all();
        $tiposProyecto = TiposProyecto::all();
        $desarrollos = Desarrollos::all();
        return view('tareas.index',['clientes' => $clientes, 'tiposProyecto' => $tiposProyecto, 'desarrollos' => $desarrollos]);
    }

    /**
     * @return mixed
     */
    public function getTareas() {

        return Tareas::fromUser()->todayOrUncompleted()->orderBy('tiempo', 'desc')->get();

    }



    public function sendEmailTareas() {

        $user = Auth::user();
        $tareas = $this->getTareas();
        $data = ['user' => $user, 'tareas' => $tareas];

        Mail::send('emails.tareas', $data, function ($message) use ($user) {
            $subject = 'ERP Tareas | ' . $user->name . ' ' . $user->apellidos . ' | ' . Carbon::today()->format('d-m-Y');

            $message->from($user->email, $user->name);
            $message->subject($subject);
            $message->replyTo($user->email);
            $message->to('javier@ril.es')->cc($user->email);
        });

        $today = Carbon::today()->format('Y-m-d H:i:s');
        $user->ultimo_envio = $today;
        $user->save();
        Session::put('message', 'Tareas enviadas correctamente');
        return redirect()->back();
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
        $tarea = Tareas::create($request->all());
        return response($tarea->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tareas = Tareas::find($id);
        $clientes = Clientes::all();
        $tipos = TiposProyecto::all();

        return view('tareas.edit')->with(['tarea'=>$tareas,'clientes'=>$clientes,'tiposProyecto'=>$tipos]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ApiUpdate(Request $request)
    {
        Tareas::find($request->id)->update($request->all());

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

        //guardo el udpated de la tarea
        $tarea = Tareas::find($id);
        $preserveUpdated = $tarea->updated_at;

        //actualizo tarea
        Tareas::find($id)->update($request->all());

        //dejo el campo updated como estaba
        $tarea = Tareas::find($id);
        $tarea->updated_at = $preserveUpdated;
        $tarea->save();

        Session::put('message', 'Tarea actualizada correctamente');
        return redirect('/tareas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tareas::destroy($id);
        Session::put('message', 'Tarea borrada correctamente');
        return redirect('/tareas');
    }
}
