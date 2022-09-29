@extends('layouts.plantilla')

    @section('contenido')

        <h1>Panel de administración de Tickets</h1>

        @if ( session('mensaje') )
            <div class="alert alert-success">
                {{ session('mensaje') }}
            </div>
        @endif

        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Ticket Nombre</th>
                    <th>Cliente</th>
                    <th>Categoría</th>
                    <th>Descripcion</th>
                    <th>Ticket Estado</th>
                    <th>Imagen</th>
                    <th colspan="2">
                        <a href="/agregarTicket" class="btn btn-dark">
                            Agregar
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
            @foreach ($tickets as $ticket)


                <tr>
                    <td> {{ $ticket->ticketNombre }} </td>
                    <td>{{ $ticket->relCliente->clienteNombre }}</td>
                    <td> {{ $ticket->relCategoria->catNombre }} </td>
                    <td> {{ $ticket->ticketDescripcion }} </td>
                    <td> {{ $ticket->ticketEstado }}</td>
                    <td>
                        <img src="/fotos/{{ $ticket->ticketImagen }}" class="img-thumbnail" alt="">
                    </td>
                    <td>
                        <a href="/modificarTicket" class="btn btn-outline-secondary">
                            Modificar
                        </a>
                    </td>
                    <td>
                        <a href="/eliminarTicket/{{ $ticket->idTicket }}" class="btn btn-outline-secondary">
                            Eliminar
                        </a>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
        {{ $tickets->links() }}

    @endsection
