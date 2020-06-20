@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    	<div class="col-md-10">
    		<div class="card">
                <div class="card-header">Editar Imagen</div>
                <div class="card-body">
                	<form action="{{url('/auth/imagenes/'.$image->id)}}" method="post" enctype="multipart/form-data">
                		@csrf
                        @method('PUT')
                		<div class="form-group">
                			<label for="" class="col-form-label">Nombre</label>
                			<div>
                				<input type="text" name="name" class="form-control" value="{{$image['name']}}">
                				
                			</div>
                		</div>
                		<div class="form-group">
                			<label for="" class="col-form-label">Descripción</label>
                			<div>
                				<textarea name="description" id="" cols="30" rows="5" class="form-control">{{$image['description']}}</textarea>
                				<input type="hidden" name="type" value="{{$image->type}}">
                			</div>
                		</div>
                       
                		<div class="imgContainer">
                                                        
                            <div class="form-group">
                                <label for="" class="col-form-label">Imagen <small class="text-muted"></small></label>
                                <div>
                                    <input type="file" accept=".png,.jpg" name="miimagen" class="form-control image-input"  >
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-form-label">Previsualizar</small></label>
                                <div>
                                    <div class="col-md-3">
                                        
                                        
                                           <img src="{{asset('storage/'.$image->url)}}" class="w-100 image-preview" alt="">
                                        
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