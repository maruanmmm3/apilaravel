<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubirController extends Controller
{
    public function subirFile(Request $request)
    {
        if ($request->hasFile('file')){ //Si en el reques hay un archivo
            $file = $request->file('file');
            $filename = $file->getClientOriginalName(); //Obtener el Nombre original

            $filename = pathinfo($filename, PATHINFO_FILENAME);//OBTENER EL NOMBRE SIN LA EXTENCION
            $name_file = str_replace(" ","_", $filename);//Remplazar todo espacio con un "_"

            $extension = $file->getClientOriginalExtension();//Obtener la extencion del archivo

            $picture = date('His') . '-' . $name_file . '.' . $extension; //Concatenear FECHA + GION + NOMBREESPACIOS + . + LA EXTENCION
            $file->move(public_path('files/'), $picture); //Mover el archivo a public-files

            return response()->json(["mensaje" => "Image Subida" ]);

        } else{

            return response()->json(["mensaje" => "Error"]);
        }
    }
}
