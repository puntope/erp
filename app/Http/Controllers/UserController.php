<?php

namespace App\Http\Controllers;

use App\Clientes;
use App\Tareas;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('user.index')->with(['empleados'=>User::all()->sortByDesc('rol_id')->sortBy('nivel_id')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    public function getUsuarios() {
        return User::all();
    }

    public function create()
    {
        return view('user.create')->with(['usuarios'=>User::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('avatar')) {

            if ($request->file('avatar')->isValid()) {
                $frendlyPathName = str_slug($request->input('name')) . '.' . $request->file('avatar')->getClientOriginalExtension();


                $path = public_path() . '/img/profiles/';
                $request->file('avatar')->move($path, $frendlyPathName);

            } else {
                $frendlyPathName = 'unknown.png';
            }
        } else {
            $frendlyPathName = 'unknown.png';
        }

        if (User::create($request->all())) {
            $user = User::all()->last();
            $user->avatar = $frendlyPathName;
            $user->password = bcrypt($user->password);
            $user->save();
            Session::put('message', 'Usuario creado correctamente');
            return redirect('/user');
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        if (is_null($id)) {
            $id = Auth::user()->id;
        } else {
            $id = (int) $id;
        }

        if (Auth::user()->id == $id || Auth::user()->rol_id == 1 ) {
            return view('user.profile', ['profile'=> User::findOrFail($id)]);
        } else {
            return view('errors.503');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return view('user.edit')->with(['user'=>User::find($id)]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {

            $frendlyPathName = str_slug($request->input('name')) . '.' . $request->file('avatar')->getClientOriginalExtension();


            $path = public_path() . '/img/profiles/';
            $request->file('avatar')->move($path, $frendlyPathName);

        } else {
            $frendlyPathName = $user->avatar;
        }


        if ($user->update($request->all())) {


            $user->avatar = $frendlyPathName;
            $user->password = bcrypt($user->password);
            $user->save();


            Session::put('message', 'Usuario editado correctamente');
            return redirect('/user');
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

        $user = User::findOrFail($id);

        $tareas = Tareas::where('user_id',$user->id)->get();


        foreach ($tareas as $tarea) {
            $tarea->user_id = 3; //javier
            $tarea->save();
        }



        $user->delete();
        Session::put('message', 'Empleado borrado correctamente');
        return redirect('/user');
    }
}
