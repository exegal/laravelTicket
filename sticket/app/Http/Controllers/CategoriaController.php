<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::paginate(5);
        return view('adminCategorias',['categorias'=> $categorias]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agregarCategoria');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $catNombre = $request->input('catNombre');

        //validacion
        $this->validar($request);
        //guardamos
        $Categoria = new Categoria;
        $Categoria->catNombre = $catNombre;
        $Categoria->save();


        return redirect('/adminCategorias')
                       ->with('mensaje', 'Categoría: '.$catNombre. ' agregada correctamente.');
    }

    //VALIDACION

    public function validar(Request $request){

        //validacion

        $request->validate(
            [
                'catNombre'=>'required|min:2|max:50'
            ],
            [
                'catNombre.required'=>'El campo nombre es obligatorio',
                'catNombre.min'=>'El campo nombre debe tener al menos 2 caracteres',
                'catNombre.max'=>'El campo nombre debe tener 50 caracteres como maximo'
            ]

            );

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
        //obtenemos datos de la categoria
        $Categoria = Categoria::find($id);
        //retornamos la vista del form con esos datos
        return view('modificarCategoria',
                                [
                                    'categoria'=> $Categoria
                                ]

                                    );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //CAPTURAMOS DATOS ENVIADOS POR EL FORM
        $catNombre = $request->input('catNombre');
        //validacion
        $this->validar($request);
        //chequeo para ver si paso la validacion:
               //return 'ok';

        //obtenemos datos desde la DB de la categoria a modificar

        $Categoria = Categoria::find($request->input('idCategoria'));

        //modificamos

            $Categoria->catNombre = $catNombre;
            $Categoria->save();
        //retornamos vista con mensaje de confirmacion

        return redirect('adminCategorias')
                                        ->with('mensaje', 'Categoria: '.$catNombre.' modificada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
