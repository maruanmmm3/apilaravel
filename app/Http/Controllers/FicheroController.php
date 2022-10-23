<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fichero;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
        $request->validate([
            'url' => 'required|max:100',
            'url.*' => 'reqired|max:500000'
        ]); 

        $archivos = $request->file('url')->store('public/articles');

        $url = Storage::url($archivos);

        Fichero::create([
            'url' => $url
        ]);

        return response()->json($url); 
   
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
    public function destroy(Fichero $fichero)
    {
        $ruta = str_replace('/storage', 'public', $fichero->url);
        Storage::delete($ruta);

        $fichero->delete();

        
        return $fichero;
    }

    public function multi(Request $request)
    {
        /* $request->validate([
            'file' => 'required|max:2000'
        ]); */

        $archivos = $request->file();
        $urls = array();

        foreach ($archivos as $archivo){

        $url_archivo=$archivo->store('public/articles');

        $url = Storage::url($url_archivo);
        $urls[] = $url;
        Fichero::create([
            'url' => $url
        ]);

        }


        return response()->json($urls); 
        
    }
}
