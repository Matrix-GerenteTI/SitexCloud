<?php

namespace App\Http\Controllers\Contabilidad;

use App\Exports\ActivosFijosExport;
use DateTime;
use App\Models\Ccategoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pactivofijos;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ContabilidadController extends Controller
{
    public function getActivosFijos()
    {
        $activos = Pactivofijos::select('pactivofijos.id', 'csucursal.descripcion', 'ccategoria.nombreCategoria', 
        'csubcategoria.nombreSubcategoria','marca', 'modelo', 'noSerie', 'cantidad', 'valorAdquisicion')
        ->where('pactivofijos.status', 1)
        ->join('csucursal', 'pactivofijos.csucursal_id', '=', 'csucursal.id')
        ->join('ccategoria', 'pactivofijos.ccategoria_id', '=', 'ccategoria.id')
        ->join('csubcategoria', 'pactivofijos.csubcategoria_id', '=', 'csubcategoria.id')->get();
        return response()->json($activos, 200);
    }
    public function borrarActivo($id, Request $request)
    {
        Pactivofijos::where('id', $id)->update(['status'=> 99]);
        Pactivofijos::where('id', $id)->update(['fechaBaja'=> $request->fechaBaja]);
        Pactivofijos::where('id', $id)->update(['motivoBaja'=> $request->motivoBaja]);
    }

    public function saveActivoFijo(Request $request)
    {
        $registro = new Pactivofijos;
        $registro->csucursal_id = $request->sucursal;
        $registro->ccategoria_id = $request->categoria;
        $registro->csubcategoria_id = $request->subcategoria;
        $registro->status = 1;
        $registro->descripcionActivo = $request->descripcion;
        $registro->marca = $request->marca;
        $registro->modelo = $request->modelo;
        $registro->noSerie = $request->serie;
        //$registro->tipoLinea = $request->input('tipoLinea');
        //$registro->numeroTelefonico = $request->input('numeroTelefonico');
        //$registro->usuario = $request->input('usuario');
        $registro->cantidad = $request->cantidad;
        $registro->valorAdquisicion = $request->valorAdquisicion;
        $registro->fechaAdquisicion = $request->fechaAdquisicion;
        //$registro->noMotor = $request->input('noMotor');
        //$registro->direccion = $request->input('direccion');
        //$registro->placa = $request->input('placa');
        $registro->pathImage = $request->path.'/'.$request->categoria.'/'.$request->categoria;
        $registro->save();
        Pactivofijos::where('id', $registro->id)->update(['pathImage'=>$request->path.'/'.$request->categoria.'/'.$request->categoria.'/'.$registro->id]);
        return response()->json($request->categoria.'/'.$request->categoria.'/'.$registro->id, 200);
    }
    
    public function uploadPhotosActivos(Request $request)
    {
        //$categoria = Ccategoria::select('nombreCategoria')->where('id', 1)->firstOrFail();
        //$carpeta = str_replace(' ', '', $categoria->nombreCategoria);

        //$date = str_replace('/', '', $request->name);
        

        Storage::disk('uploads')->makeDirectory('images/activosFijos/'.$request->name);

            $file = $request->file('foto');
            $destinationPath = public_path('/images/activosFijos/'.$request->name);

            $image_resize = Image::make($file);
            $image_resize->resize(800, 800, function($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'. $request->codigo.'.jpeg');

            //$file->move($destinationPath, $request->codigo.'.jpeg');

        return response()->json(true, 200);

        /*if($request->validate(['foto' => 'required|image|mimes:jpeg,png,jpg']))
        {
            $extension = time().'.'.$request->foto->extension(); 
            $image_resize = Image::make($request->foto);
            $image_resize->resize(800, 800, function($constraint) 
            {
                $constraint->aspectRatio();
            })->save('images/activosFijos/'.$carpeta.'/'. $extension);
            return response()->json(true, 200);
        }
        else
            return response()->json(false, 200);
            */
    }

    public function exportarExcelActivos(Request $request)
    {
        return Excel::download(new ActivosFijosExport($request), 'ActivosFijos.xlsx');
    }

    public function getFiltroActivos(Request $request)
    {
        if($request->idSucursal == 0 && $request->idEquipo == 0)
        {
            $activos = Pactivofijos::select('pactivofijos.id', 'csucursal.descripcion', 'ccategoria.nombreCategoria', 
            'csubcategoria.nombreSubcategoria','marca', 'modelo', 'noSerie', 'cantidad', 'valorAdquisicion')
            ->where('pactivofijos.status', 1)
            ->join('csucursal', 'pactivofijos.csucursal_id', '=', 'csucursal.id')
            ->join('ccategoria', 'pactivofijos.ccategoria_id', '=', 'ccategoria.id')
            ->join('csubcategoria', 'pactivofijos.csubcategoria_id', '=', 'csubcategoria.id')->get();
            return response()->json($activos, 200);
        }
        else if($request->idSucursal != 0 && $request->idEquipo == 0)
        {
            $activos = Pactivofijos::select('pactivofijos.id', 'csucursal.descripcion', 'ccategoria.nombreCategoria', 
            'csubcategoria.nombreSubcategoria','marca', 'modelo', 'noSerie', 'cantidad', 'valorAdquisicion')
            ->where('pactivofijos.status', 1)->where('pactivofijos.csucursal_id', $request->idSucursal)
            ->join('csucursal', 'pactivofijos.csucursal_id', '=', 'csucursal.id')
            ->join('ccategoria', 'pactivofijos.ccategoria_id', '=', 'ccategoria.id')
            ->join('csubcategoria', 'pactivofijos.csubcategoria_id', '=', 'csubcategoria.id')->get();
            return response()->json($activos, 200);
        }
        else if($request->idSucursal == 0 && $request->idEquipo != 0)
        {
            $activos = Pactivofijos::select('pactivofijos.id', 'csucursal.descripcion', 'ccategoria.nombreCategoria', 
            'csubcategoria.nombreSubcategoria','marca', 'modelo', 'noSerie', 'cantidad', 'valorAdquisicion')
            ->where('pactivofijos.status', 1)->where('pactivofijos.csubcategoria_id', $request->idEquipo)
            ->join('csucursal', 'pactivofijos.csucursal_id', '=', 'csucursal.id')
            ->join('ccategoria', 'pactivofijos.ccategoria_id', '=', 'ccategoria.id')
            ->join('csubcategoria', 'pactivofijos.csubcategoria_id', '=', 'csubcategoria.id')->get();
            return response()->json($activos, 200);
        }
        else if($request->idSucursal != 0 && $request->idEquipo != 0)
        {
            $activos = Pactivofijos::select('pactivofijos.id', 'csucursal.descripcion', 'ccategoria.nombreCategoria', 
            'csubcategoria.nombreSubcategoria','marca', 'modelo', 'noSerie', 'cantidad', 'valorAdquisicion')
            ->where('pactivofijos.status', 1)->where('pactivofijos.csubcategoria_id', $request->idEquipo)
            ->where('pactivofijos.csucursal_id', $request->idSucursal)
            ->join('csucursal', 'pactivofijos.csucursal_id', '=', 'csucursal.id')
            ->join('ccategoria', 'pactivofijos.ccategoria_id', '=', 'ccategoria.id')
            ->join('csubcategoria', 'pactivofijos.csubcategoria_id', '=', 'csubcategoria.id')->get();
            return response()->json($activos, 200);
        }
    }
}
