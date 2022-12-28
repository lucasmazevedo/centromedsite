<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\User;
use Auth;
use Hash;


class UserController extends Controller
{
    public function perfil()
    {
        $user = Auth::user();
        $empresa = Empresa::findOrFail(1);

        return view('usuarios.meus-dados', compact('user', 'empresa'));
    }

    public function perfilupdate(Request $request)
    {
        $user = Auth::user();


        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->username = $request->get('username');
        $user->sexo = $request->get('sexo');
        if(!$request->get('password') == null)
        {
            $user->password = Hash::make($request->get('password'));
        }
        $user->assinaturaRodape = $request->get('assinaturaRodape');

        if($request->get('avatar_remove') == 1)
        {
            $user->assinatura = null;
        }
        if($request->has('assinatura'))
        {
            $name = $request->file('assinatura')->getClientOriginalName();
            $path = $request->file('assinatura')->store('assinaturas');
            $user->assinatura =  $path;

        }

        $user->update();
        return redirect()->route('usuarios.perfil')->with('success', 'Informações atualizadas com sucesso...');
    }
}
