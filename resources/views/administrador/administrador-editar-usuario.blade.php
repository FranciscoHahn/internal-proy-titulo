@extends('layout.layout')
@section('content')
@include('layout.navegacion')
    <!--Main Navigation-->

    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container pt-4">
            <div class="d-flex justify-content-between mt-1">
                <h3 class="me-3">Edición de usuario</h3>
                <a href="{{ route('usuarios') }}" class="btn btn-primary btn-rounded"><i class="fas fa-arrow-left"></i>&nbsp;Volver a
                    usuarios</a>
            </div>
            @if (isset($mensaje))
                @if ($mensaje != 'Modificación Finalizada')
                    <div class="rounded bg-warning text-white mt-2 px-2">
                        {{ $mensaje }}
                        <ul>
                            @foreach ($errores as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <div class="rounded bg-success text-white mt-2 px-2">
                        {{ $mensaje }}
                    </div>
                @endif

            @endif

            <div class="mt-4">
                <form method="POST" action="{{route('edicionusuario')}}">
                    <!-- 2 column grid layout with text inputs for the first and last names -->
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" id="form6Example1" class="form-control" name="nombres" value="{{$datausuario->nombres}}"/>
                                <label class="form-label" for="form6Example1">Nombres</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" id="form6Example2" class="form-control" name="apellidos" value="{{$datausuario->apellidos}}"/>
                                <label class="form-label" for="form6Example2">Apellidos</label>
                            </div>
                        </div>
                    </div>

                    <!-- Text input -->
                    <div class="form-outline mb-4">
                        <input type="text" id="form6Example4" class="form-control" name="username" value="{{$datausuario->username}}"/>
                        <label class="form-label" for="form6Example4">Nombre de usuario</label>
                    </div>

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="email" id="form6Example5" class="form-control" name="email" value="{{$datausuario->email}}"/>
                        <label class="form-label" for="form6Example5">Email</label>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="text" id="form6Example6" class="form-control" name="rut" value="{{$datausuario->run}}"/>
                        <label class="form-label" for="form6Example6">Rut</label>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="number" id="form6Example6" class="form-control" name="telefono" value="{{$datausuario->telefono}}"/>
                        <label class="form-label" for="form6Example6">Teléfono</label>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="password" id="form6Example6" class="form-control" name="password" value="{{$datausuario->password}}"/>
                        <label class="form-label" for="form6Example6">Contraseña</label>
                    </div>
                    <div class="form-outline mb-4">
                        <!-- Default radio -->
                        <label class="form-label" for="">Seleccione Perfil</label>
                        @foreach ($perfiles as $perfil)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="id_perfil" id="flexRadioDefault1"
                                    value="{{ $perfil->id }}" @if ($perfil->id == $datausuario->id_perfil)
                                        checked
                                    @endif/>
                                <label class="form-check-label" for="flexRadioDefault1"> {{ $perfil->nombre }} </label>
                            </div>
                        @endforeach
                    </div>
                    <input type="hidden" name="id" value="{{$datausuario->id}}" />


                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4">Modificar usuario</button>
                </form>

            </div>



        </div>
    </main>
@endsection
