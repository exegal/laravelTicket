<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Cliente;
use App\Models\Categoria;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Generacion de listado de tickets + relaciones a la tabla Clientes y Categorias(Relaciones en el Model)
        $tickets = Ticket::with('relCliente','relCategoria')->paginate(5);
        //dd($tickets); Para ver el resultado de esa consulta a DB
        //retornamos vista con datos
        return view('adminTickets',['tickets'=> $tickets] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //obtenemos listado de marcas y categoras
        $clientes = Cliente::all();
        $categorias = Categoria::all();

        //Le pasamos los datos a la vista
        return view ('agregarTicket',
                        [
                        'clientes'=> $clientes,
                        'categorias'=>$categorias
                        ]
                        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validacion
        $this->validar($request);

        //subir imagen
        $ticketImagen = $this->subirImagen($request);

        //instanciar + guardar


        //redirigir con mensaje de ok

    }
    public function validar(Request $request)
    {
        $request->validate(
            [
                'ticketNombre'=>'required|min:3|max:70',
                'ticketDescripcion'=>'required|min:3|max:150',
                'ticketEstado'=>'required|integer|min:1',
                'ticketImagen'=>'mimes:jpg,jpeg,png,gif,svg,webp|max:2048'
            ],
            [
                'ticketNombre.required'=>'Complete el campo Nombre',
                'ticketNombre.min'=>'Complete el campo Nombre con al menos 3 caractéres',
                'ticketNombre.max'=>'Complete el campo Nombre con 70 caractéres como máxino',
                'ticketDescripcion.required'=>'Complete el campo Presentación',
                'ticketDescripcion.min'=>'Complete el campo Presentación con al menos 3 caractéres',
                'ticketDescripcion.max'=>'Complete el campo Presentación con 150 caractérescomo máxino',
                'ticketEstado.required'=>'Complete el campo Stock',
                'ticketEstado.integer'=>'Complete el campo Stock con un número entero',
                'ticketEstado.min'=>'Complete el campo Stock con un número positivo',
                'ticketImagen.mimes'=>'Debe ser una imagen',
                'ticketImagen.max'=>'Debe ser una imagen de 2MB como máximo'
            ]
        );
    }

    /*
    Metodo que sube una imagen y devuelve un string con el nombre del archivo
    @return string $ticketImagen
    */

    public function subirImagen(Requiest $request)
    {
        //si no enviaron archivo
        $ticketImagen = 'noDisponible.jpg';

        //si enviaron archivo
        if( $request->file('ticketImagen') )
        {
            $ticketImagen = time().'.'.$request->file('ticketImagen')->clientExtension();
        }

        //subir imagen a directorio productos
        $request->file('ticketImagen')
                            ->move(public_path('fotos/'), $ticketImagen);

        return $ticketImagen;
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    public function confirmarBaja($idTicket){

        $Ticket = Ticket::with('relCliente','relMarca')->find($idTicket);
        return view('eliminarTicket', ['ticket'=> $Ticket] );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket= Ticket::find($request->input('idTicket'));//request trae datos get post y cookies en este caso usamos el metodo INPUT
        $ticketNombre = $tickett->ticketNombre;
        //$Ticket->delete();
        return redirect('/adminTickets')
                        ->with('mensaje', 'Ticket:'.$ticketNombre.' eliminado correctamente');
    }
}
