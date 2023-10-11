<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => ['required', 'unique:users', 'min:3', 'max:20', 'not_in:twitter,editar-perfil']
        ]);
        if ($request->imagen) {
            $imagen = $request->file('imagen');
            $nombreImagen = Str::uuid() . "." . $imagen->extension();
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000);
            $imagenServidor->save($imagenPath);
        }

        $usuario = User::find(auth()->user()->id);
        $usuario->username = Str::slug($request->username);
        $usuario->imagen = $nombreImagen ??
            auth()->user()->imagen ?? null;
        $usuario->save();
        return redirect()->route('posts.index', $usuario->username);
    }
}
