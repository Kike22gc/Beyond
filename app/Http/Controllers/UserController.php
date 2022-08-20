<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

//Librerias Passport Necesarias
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use App\Models\Teams;
use Exception;
use Illuminate\Support\Facades\Log;

class UserController extends BaseController
{
    /**
     * Registro de usuario
     */
    public function signUp(Request $request)
    {
        $data = $request->all();
        $fecha_fin_sub = date('Y-m-d 00:00:00', strtotime('+1 year, +1 day'));

        $user = User::create([
            'name' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'],),
            'max_teams' => $data['sub_type'],    
            'subscription_end_at' => $fecha_fin_sub,
        ]);

        return response()->json([
            'message' => 'Usuario Creado Correctamente',
            'status' => 'OK',
            'id' => $user->id
        ]);
    }

    /**
     * Inicio de sesión
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $credentials = request(['email', 'password']);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            
            return response()->json([
                'status' => 'OK',
                'server' => $_SERVER,
                'cookies' => $_COOKIE,
                'environment' => $_ENV
            ], 200);

        } else {
            return response()->json([
                'status' => 'ERROR'
            ], 401);
        }
    }

    /**
     * Cierre de sesión
     */
    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();
        }

        return response()->json([
            'status' => 'OK'
        ]);
    }

    /**
     * Obtener el objeto User como json
     */
    public function user(Request $request)
    {
        $user = $request->user();
        $teams = Teams::where('user_id', $user['id'])->first();

        if ($user instanceof User) {
            $json = array_merge(
                ['status' => 'OK'],
                ['team' => $teams['teams_id']],
                $user->toArray(),
            );
        } else {
            $json = [
                'status' => 'ERROR',
                'server' => $_SERVER,
                'cookies' => $_COOKIE,
                'environment' => $_ENV
            ];
        }

        return response()->json($json);
    }
}
