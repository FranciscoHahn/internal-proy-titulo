@extends('layout.layout')
@section('content')
@include('layout.navegacion')

    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container pt-4">
            <div class="d-flex justify-content-between">
                <h3 class="me-3">Administración de preparaciones</h3>
                <a href="#" class="btn btn-primary btn-rounded"><i
                        class="fas fa-drumstick-bite"></i>&nbsp;Agregar
                    nueva preparación</a>
            </div>
            @if (isset($mensaje))
                <div class="rounded bg-success text-white mt-2 px-2">
                    {{ $mensaje }}
                </div>
            @endif
            <div class="mt-2">
                <table class="table align-middle mb-0 bg-white table-sm">
                    <thead class="table-dark">
                      <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Activo</th>
                        <th>Categoría</th>
                        <th>Imagen</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($preparaciones as $preparacion)
                      <tr>
                        <td>{{ $preparacion->id }}</td>
                        <td>{{ $preparacion->nombre }}</td>
                        <td>{{ $preparacion->descripcion }}</td>
                        <td>{{ $preparacion->precio }}</td>
                        <td>{{ $preparacion->activo }}</td>
                        <td>{{ $preparacion->categoria }}</td>
                        <td>{{ $preparacion->link_image_auxiliar}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  
            </div>





        </div>
    </main>
@endsection
