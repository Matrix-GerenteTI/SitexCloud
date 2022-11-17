<?php

namespace App\Http\Controllers\Login;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pempleado;
use App\Models\Pusuarioventa;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $findUser = User::where('username',$request->username)->exists();
        if($findUser == true)
        {
            $usuario = User::where('username', $request->username)->firstOrFail();
            $status = Pempleado::where('nip', $usuario->idempleado)->firstOrFail();
            
            $user = User::where('username',$request->username)->join('ctipousuario', 'pusuarios.tipo', '=', 'ctipousuario.id')->firstOrFail();
            $user3 = User::where('username', 'admin')->join('ctipousuario', 'pusuarios.tipo', '=', 'ctipousuario.id')->get();
            if($user->password == $request->password && $status->status == 1)
            {
                Auth::login($user);
                return response()->json(Auth::user(), 200);
            }
            else if($status->status != 1)
                abort(404, 'El usuario ya está dado de baja');
            else
                abort(404, 'La contraseña ingresada es incorrecta');
        }
        else{
            $userVenta = Pusuarioventa::join('ctipousuario', 'pusuarioventa.tipo', '=', 'ctipousuario.id')
            ->where('username', $request->username)->where('password', $request->password)->where('pusuarioventa.status', 1)->firstOrFail();
            if(is_null($userVenta) == false)
            {
                dd(Auth::guard('venta')->user());
                //Auth::guard('venta');
                Auth::login($userVenta);
                //dd(Auth::check());
                return response()->json(Auth::user(), 200);
            }
            else
                abort(404, 'El usuario ingresado no existe');
        }
    }

    public function getUser()
    {   
        //$usuario = User::where('username', Auth::user()->username)->join('ppermiso', 'pusuarios.idempleado', '=', 'ppermiso.idusuario')->firstOrFail();
        $usuario = User::where('username', Auth::user()->username)
        ->join('ctipousuario', 'pusuarios.tipo', '=', 'ctipousuario.id')->firstOrFail();
        return response()->json($usuario, 200);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
