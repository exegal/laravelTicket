@extends('layouts.plantilla')

@section('contenido')


        <h1>Alta de un nuevo Ticket</h1>

        <div class="alert bg-light p-3 border">
            <form action="/agregarTicket" method="post" enctype="multipart/form-data">
                @csrf
                Nombre: <br>
                <input type="text" name="ticketNombre" class="form-control">
                <br>
                Cliente: <br>
                <select name="idCliente" class="form-control" required>
                    <option value="">Seleccione un Cliente</option>
                @foreach ($clientes as $cliente)
                     <option value="{{ $cliente->idCliente }}">{{ $cliente->clienteNombre  }}</option>
                @endforeach
                </select>
                <br>
                Categoría: <br>
                <select name="idCategoria" class="form-control" required>
                    <option value="">Seleccione una Categoría</option>

                @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->idCategoria }}">{{ $categoria->catNombre }}</option>
                @endforeach


                </select>
                <br>
                Descripcion: <br>
                <textarea name="ticketDescripcion" class="form-control"></textarea>
                <br>
                Ticket Estado: <br>
                <input type="number" name="ticketEstado" class="form-control">
                <br>
                Imagen: <br>
                <input type="file" name="ticketImagen" class="form-control">
                <br>
                <input type="submit" value="Agregar Producto" class="btn btn-secondary mb-3">
                <a href="/adminProductos" class="btn btn-light mb-3">Volver al panel de Productos</a>
            </form>

        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


   @endsection

