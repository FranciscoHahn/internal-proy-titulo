@extends('layout.layout')
@section('content')
    <section class="vh-100" style="background-color: whitesmoke;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <h3 class="mb-5">Siglo 21 - Empleados</h3>
                            <form method="POST" action="././ingresar">
                                <div class="form-outline mb-4">
                                    <input type="email" id="email" name="email"
                                        class="form-control form-control-lg"/>
                                    <label class="form-label" for="typeEmailX-2">Correo electrónico</label>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" name="password" id="password" id="typePasswordX-2"
                                        class="form-control form-control-lg" />
                                    <label class="form-label" for="typePasswordX-2">Contraseña</label>
                                </div>
                                @csrf
                                @if (isset($mensaje))
                                    <div class="p-3 mb-2 bg-dark bg-gradient text-white rounded">
                                        <strong>{{$mensaje}}</strong>
                                    </div>
                                @endif

                                <button class="btn btn-primary btn-lg btn-block" type="submit">Ingresar</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
