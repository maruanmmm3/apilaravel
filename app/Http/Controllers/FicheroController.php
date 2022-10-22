<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fichero;

class FicheroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ficheros = Fichero::all();
        return $ficheros;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        if ($request->hasFile('file')){ //Si en el reques hay un archivo
            $fichero = new Fichero();
            $file = $request->file('file');
            $filename = $file->getClientOriginalName(); //Obtener el Nombre original

            $filename = pathinfo($filename, PATHINFO_FILENAME);//OBTENER EL NOMBRE SIN LA EXTENCION
            $name_file = str_replace(" ","_", $filename);//Remplazar todo espacio con un "_"

            $extension = $file->getClientOriginalExtension();//Obtener la extencion del archivo

            $nombrealter = date('His') . '-' . $name_file . '.' . $extension; //Concatenear FECHA + GION + NOMBREESPACIOS + . + LA EXTENCION
            $file->move(public_path('files/'), $nombrealter); //Mover el archivo a public-files

            $fichero->url = $nombrealter;
            $fichero->save();
            

        } else{

            return response()->json(["mensaje" => "Error"]);
        }
        
        /* $fichero->url = $request->url; */

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $fichero = Fichero::destroy($request->id);
        /* Storage::disk('public')->delete('URL'.$request.url()); */
        return $fichero;
    }
}
