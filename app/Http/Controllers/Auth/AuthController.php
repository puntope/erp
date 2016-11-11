<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\Lang;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new user, as well as the
    | authentication of existing user. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['getLogout','getRegister']]);
    }

    public function getRegister()
    {
        return view('user.create');
    }

    protected function getFailedLoginMessage()
    {
        return Lang::has('password.user')
            ? Lang::get('password.user')
            : 'Los datos introducidos no son correctos.';
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'apellidos' => 'required|max:255',
            'email' => 'required|email|max:255|unique:user',
            'alias' => 'required|max:255|unique:user',
            'password' => 'required|confirmed|min:6',
            'avatar' => 'image',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

        if ($data->hasFile('avatar')) {

            if ($data->avatar->isValid()) {
                $frendlyPathName = str_slug($data->nombre) . '.' . $data->avatar->getClientOriginalExtension();
                $partialPath = '/img/user/profiles/' . $frendlyPathName;


                $path = public_path() . '/img/user/profiles/';
                $data->avatar->move($path, $frendlyPathName);

            } else {
                $partialPath = '/img/user/profiles/unknown.png';
            }
        } else {
            $partialPath = '/img/user/profiles/unknown.png';
        }


        User::create([
            'name' => $data['name'],
            'apellidos' => $data['apellidos'],
            'alias' => $data['alias'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        dd(User::all()->last());
    }
}
