@extends('layouts.front')
@section('content')
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @for($i=0;$i<count($images_slides);$i++)
    <li data-target="#myCarousel" data-slide-to="{{$i}}" class="{{$i==0?'active':''}}"></li>
        @endfor
    </ol>
    <div class="carousel-inner">
        @foreach($images_slides as $key => $slide)
        <div class="carousel-item {{$key==0?'active':''}}">
            <div class="w-100 h-100 img-slide" role="img" style="background:url({{asset('storage/'.$slide->url)}})">
                &nbsp;
            </div>
            <div class="container">
                {{-- <div class="carousel-caption text-left">
                    <h1>Example headline.</h1>
                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
                </div> --}}
            </div>
        </div>
        @endforeach
    </div>
    {{-- <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Anterior</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Siguiente</span>
    </a> --}}
</div>
<div class="container marketing" id="servicios">
    <!-- Three columns of text below the carousel -->
    <div class="row mt-5">
        @foreach($services as $service)
        <div class="col-lg-4">
            <div class="rounded-circle" style="background: {{$service->color}}">
               <img src="{{asset('storage/'.$service->icon)}}" class="w-100" alt="">
            </div>
            <h3>{{$service->name}}</h3>
            <p>{{$service->description }}</p>
            <p class="mt-5"><a class="btn px-4 py-0 btn-custom" href="#contacto" role="button">Cotizar</a></p>
        </div><!-- /.col-lg-4 -->
        @endforeach
    </div><!-- /.row -->
    
</div>
<div class="container" id="nosotros">
    <!-- START THE FEATURETTES -->
    <div class="row mt-5">
        <div class="col-md-7">
            <h2 class=" mb-3">Nosotros</span></h2>
            <p class="lead">{{$general['nosotros']}}</p>
        </div>
        <div class="col-md-5">
            <img src="{{asset('storage/'.$img_nosotros->url)}}" class="w-100" alt="">
        </div>
    </div>
    <hr class="featurette-divider">
</div>
<div class="container" id="contacto">
    <div class="row my-5">
        <div class="col-md-5">
           <h2 class="mb-3">Cotizar</h2> 
           <img src="{{asset('storage/'.$img_cotiza->url)}}" class="w-100 mb-3" alt="">
           <p>{{$general['cotiza']}}</p>
        </div>
        <div class="col-md-7">
            <div class="col-12 bg-light border px-0">
                <div class="top-head bg-custom-muted py-4">
                    <h2 class="text-center">CONTACTANOS YA!!!</h2>
                </div>
                <form action="/" method="post" class="mt-5">
                    <div class="form-group">
                        <div class="col-12 px-5">
                            <input type="text" class="form-control text-uppercase" name="name" placeholder="Nombre">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12 px-5">
                            <input type="text" class="form-control text-uppercase" name="mail" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12 px-5">
                            <input type="text" class="form-control text-uppercase" name="phone" placeholder="Teléfono">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12 px-5">
                            <textarea name="message" id="" cols="30" rows="10" class="form-control text-uppercase" placeholder="Mensaje..."></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12 text-center">
                            <button class="btn btn-custom text-uppercase col-6">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>
    @endsection
