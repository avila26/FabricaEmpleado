<?php

namespace App\Http\Controllers;

use App\Models\empleado;
use App\Models\fabrica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\If_;

class EmpleadoController extends Controller
{
    public function index()
    {
        $fabri = fabrica::where('estado',1)->get();
        $empleados = DB::table('empleados')
            ->join('fabricas', 'fabricas.id', '=','empleados.fabri_id' )
            ->where('empleados.estado', 1)
            ->select('empleados.*', 'fabricas.nombreFabrica')
            ->get();
        return view('empresa.empleado', compact('empleados', 'fabri'));
    }

    public function store(Request $request)
    {
        $empleado = new empleado();

        $empleado->nombre           = $request->nombre;
        $empleado->apellido         = $request->apellido;
        $empleado->fecha_nacimieto  = $request->fecha_nacimieto;
        $empleado->cantidadHijos    = $request->cantidadHijos;
        $empleado->salario          = $request->salario;
        $empleado->fabri_id         = $request->fabri_id;
        $empleado->save();
        return back();
    }

    public function delete($id)
    {
        $empleado = Empleado::find($id);
        if ($empleado) {
            $empleado->estado = false;
            $empleado->save();
            return back();
        }
    }

    public function showEmpleado($id)
    {
        // Obtener todos los departamentos
        $fabri = fabrica::where('estado',1)->get();
    
        // Buscar un empleado por su ID en la base de datos
        $empleado = Empleado::where('id', $id)->first();
    
        // Devolver una vista llamada 'depaemple.bono' con los datos de departamentos y empleado
        return view('depaemple.bono', compact('fabri', 'empleado'));
    }
    
    public function actualizar($id, Request $request){
        $empleado = Empleado::find($id);
        if($empleado){
            $empleado->nombre           = $request->nombre;
            $empleado->apellido         = $request->apellido;
            $empleado->fecha_nacimieto  = $request->fecha_nacimieto;
            $empleado->cantidadHijos    = $request->cantidadHijos;
            $empleado->salario          = $request->salario;
            $empleado->fabri_id         = $request->fabri_id;
            $empleado->save();
            //return back();
            return redirect('/empleado');
        }
    }

    public function showEmpleadorAct($id){ //trae a la Nueva vista todos los datos de Autor
        $fabri = fabrica::where('estado',1)->get();
        $empleado = Empleado::find($id);
        return view('empresa.empleadoEdit',compact('empleado', 'fabri'));//R  
    }
    
}
