@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Panel de Control</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3>Bienvenido {{Auth::user()->name}}</h3>
                    <p>Aqui podrás administrar tu Página Web</p>
                    <div class="row justify-content-center">
                        <div class="col-md-3 col-6 text-center">
                            <a href="{{url('/auth/general')}}" class="h1 text-light text-decoration-none">
                                <div class="icon bg-primary w-100 pt-4 rounded">
                                    <i class="fa fa-cogs"></i>
                                    <p>Generales</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-6 text-center">
                            <a href="{{url('/auth/servicios')}}" class="h1 text-light text-decoration-none">
                                <div class="icon bg-danger w-100 pt-4 rounded">
                                    <i class="fa fa-server"></i>
                                    <p>Servicios</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-6 text-center">
                            <a href="{{url('/auth/imagenes')}}" class="h1 text-light text-decoration-none">
                                <div class="icon bg-warning w-100 pt-4 rounded">
                                    <i class="fa fa-picture-o"></i>
                                    <p>Imagenes</p>
                                </div>
                            </a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
