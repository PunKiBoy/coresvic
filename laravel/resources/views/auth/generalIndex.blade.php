@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    	<div class="col-md-10">
    		<div class="card">
                <div class="card-header">Configuracion General</div>

                <div class="card-body">
                	<form method="post" action="{{url('/auth/general')}}">
                		@csrf
	                	<h4>Empresa</h4>
	                	<div class="form-group">
	                		<label for="" class="col-form-label">Nombre</label>
	                		<div>
	                			<input type="text" readonly disabled class="form-control" value="{{env('APP_NAME')}}">
	                		</div>
	                	</div>
	                	<div class="form-group">
	                		<label for="" class="col-form-label">Slogan</label>
	                		<div>
	                			<input type="text" name="txt_slogan" class="form-control" value="{{$data['slogan']}}">
	                		</div>
	                	</div>
	                	<div class="form-group">
	                		<label for="" class="col-form-label">Nosotros</label>
	                		<div>
	                			<textarea name="txt_nosotros" class="form-control" id="" cols="30" rows="5">{{$data['nosotros']}}</textarea>
	                		</div>
	                	</div>
	                	<div class="form-group">
	                		<label for="" class="col-form-label">Cotiza</label>
	                		<div>
	                			<textarea name="txt_cotiza" class="form-control" id="" cols="30" rows="5">{{$data['cotiza']}}</textarea>
	                		</div>
	                	</div>
	                	<h4>Contacto</h4>
	                	<div class="form-group">
	                		<label for="" class="col-form-label">Whatsapp</label>
	                		<div>
	                			<input type="text" name="txt_whatsapp" class="form-control" value="{{$data['whatsapp']}}">
	                		</div>
	                	</div>
	                	<div class="form-group">
	                		<label for="" class="col-form-label">Telefono</label>
	                		<div>
	                			<input type="text" name="txt_telefono" class="form-control" value="{{$data['telefono']}}">
	                		</div>
	                	</div>
	                	<div class="form-group">
	                		<label for="" class="col-form-label">Correo Electónico</label>
	                		<div>
	                			<input type="text" name="txt_email" class="form-control" value="{{$data['email']}}">
	                		</div>
	                	</div>
	                	<div class="form-group">
	                		<label for="" class="col-form-label">Instagram URL</label>
	                		<div>
	                			<input type="text" name="txt_instagram" class="form-control" value="{{$data['instagram']}}">
	                		</div>
	                	</div>
	                	<div class="form-group">
	                		<label for="" class="col-form-label">Facebook URL</label>
	                		<div>
	                			<input type="text" name="txt_facebook" class="form-control" value="{{$data['facebook']}}">
	                		</div>
	                	</div>
	                	<div class="form-group">
	                		<label for="" class="col-form-label">Twitter URL</label>
	                		<div>
	                			<input type="text" name="txt_twitter" class="form-control" value="{{$data['twitter']}}">
	                		</div>
	                	</div>
	                	<div class="form-group">
	                		<button class="btn btn-primary">Guardar</button>
	                	</div>
	                </form>
                </div>
            </div>
    	</div>
    </div>
</div>
@endsection