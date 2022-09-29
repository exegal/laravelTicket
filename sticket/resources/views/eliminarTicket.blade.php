@extends('layouts.plantilla')

    @section('contenido')

        <h1>Baja de un Ticket</h1>

        <div class="row alert bg-light border-danger col-8 mx-auto p-2">
            <div class="col">
                <img src="/fotos/{{ $ticket->ticketImagen }}" class="img-thumbnail">
            </div>
            <div class="col text-danger align-self-center">
            <form action="/eliminarTicket" method="post">
                @csrf
                @method('delete')
                <h2>{{ $ticket->ticketNombre }}</h2>
                Categoría: {{ $ticket->relCategoria->catNombre }} <br>
                Marca:  {{ $ticket->relCliente->clienteNombre }} <br>
                Presentación: {{ $ticket->ticketDescripcion }} <br>
                Precio: ${{ $ticket->ticketEstado }}

                <input type="hidden" name="idTicket"
                       value="{{ $ticket->idTicket }}">
                <button class="btn btn-danger btn-block my-3">Confirmar baja</button>
                <a href="/adminTicket" class="btn btn-outline-secondary btn-block">
                    Volver a panel
                </a>

            </form>
            </div>
        </form>

            <script>
                /*
                Swal.fire(
                    'Título de la ventana',
                    'descripción de la ventana, blah, blah',
                    'warning'
                )
                */
                Swal.fire({
                    title: '¿Desea eliminar el ticket?',
                    text: "Esta acción no se puede deshacer.",
                    type: 'error',
                    showCancelButton: true,
                    cancelButtonColor: '#8fc87a',
                    cancelButtonText: 'No, no lo quiero eliminar',
                    confirmButtonColor: '#d00',
                    confirmButtonText: 'Si, lo quiero eliminar'
                }).then((result) => {
                    if (!result.value) {
                        //redirección a adminTickets
                        window.location = '/adminTickets'
                    }
                })
            </script>


    @endsection
