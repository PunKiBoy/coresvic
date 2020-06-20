@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    	<div class="col-md-10">
    		<div class="card">
                <div class="card-header">Crear Servicio</div>
                <div class="card-body">
                	<form action="{{url('/auth/servicios')}}" method="post" enctype="multipart/form-data">
                		@csrf
                		<div class="form-group">
                			<label for="" class="col-form-label">Nombre</label>
                			<div>
                				<input type="text" name="name" class="form-control" value="{{old('name')}}">
                				
                			</div>
                		</div>
                		<div class="form-group">
                			<label for="" class="col-form-label">Descripción</label>
                			<div>
                				<textarea name="description" id="" cols="30" rows="5" class="form-control">{{old('description')}}</textarea>
                				
                			</div>
                		</div>
                		<div class="imgContainer">
                            <div class="form-group">
                                <label for="" class="col-form-label">Color</label>
                                <div>
                                    <input type="color" name="color" class="form-control color-input" value="">
                                    
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="" class="col-form-label">Icono <small class="text-muted">(325px * 325px)</small></label>
                                <div>
                                    <input type="file" accept=".png" name="icono" class="form-control image-input" value="{{'icono'}}">
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-form-label">Previsualizar</small></label>
                                <div>
                                    <div class="col-md-3">
                                        
                                        <div class="rounded-circle color-target">
                                           <img src="" class="w-100 image-preview" alt="">
                                        </div>
                                    </div>
                                </div>
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