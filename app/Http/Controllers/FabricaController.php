<?php

namespace App\Http\Controllers;

use App\Models\empleado;
use App\Models\fabrica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FabricaController extends Controller
{
    public function index()
    {
        $fabri = fabrica::where('estado',1)->get();
        $empleados = DB::table('empleados')
            ->join('fabricas', 'fabri_id', '=', 'fabricas.id')
            ->where('empleados.estado', 1)
            ->select('empleados.*', 'fabricas.nombreFabrica')
            ->get();
        return view('empresa.fabrica', compact('empleados', 'fabri'));
    }

    public function store(Request $request)
    {
        $fabrica = new fabrica();
        $fabrica->nombreFabrica = $request->nombreFabrica;
        $fabrica->ubicacion = $request->ubicacion;
        $fabrica->save();
        return back();
    }

    public function eliminar($id) {
        // Obtener la fábrica por su ID
        $fabrica = Fabrica::find($id);
    
        if ($fabrica) {
            // Desactivar la fábrica y guardar los cambios
            $fabrica->estado = false;
            $fabrica->save();
    
            // Desactivar los empleados relacionados
            $fabrica->empleados()->update(['estado' => false]);
    
            return back();
        }
    }
    
    

}
