<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsuarioControlador extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 

    public function edit ()
    {
        $user = Auth::id();
        return view ('usuarios.edit',[
            'user' => $user
        ]);
    }

    public function updateUser (Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('usuarios.edit')
                        ->withErrors($validator);
        }

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect()
            ->route('usuarios.edit')
            ->withMessage('Actualizado correctamente');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(),[
            'old_password' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        if ($validator->fails()) {
            return redirect()->route('usuarios.edit')
                        ->withErrors($validator);
        }

        if( !Hash::check($request->old_password , $user->password))
        {
            return redirect()->route('usuarios.edit')
            ->with('error','Contraseña no coincide con la anterior');
        } 
        $user->password =  Hash::make($request->password);
        $user->save();
        return redirect()
            ->route('usuarios.edit')
            ->with('status', 'Password updated!');
    }

}