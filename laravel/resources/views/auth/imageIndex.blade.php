@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    	<div class="col-md-10">
    		<div class="card">
                <div class="card-header">Imagenes</div>
                <div class="card-body">
                	<div class="col-12 text-right mb-3">
                		
                		<a href="{{url('/auth/imagenes/new')}}" class="btn btn-primary">Nueva Imagen</a>
                		
                	</div>
					<table class="table table-striped">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th>Titulo</th>
								<th>Descripcion</th>
								<th>Miniatura</th>
								<th class="text-center">Accion</th>
							</tr>
						</thead>
						<tbody>
							@foreach($images as $image)
							<tr class="valign-middle">
								<td class="text-center">{{ $image->id }}</td>
								<td>{{ $image->name }}</td>
								<td>{{ $image->description }}</td>
								<td><img src="{{ asset('storage/'.$image->url) }}" alt="" height="70"></td>
								<td class="text-center">
									<a class="btn btn-success" href="{{url('/auth/imagenes/'.$image->id.'/edit')}}"><i class="fa fa-pencil-square-o"></i></a>
									<button class="btn btn-danger btnEliminar" data-id="{{$image->id}}"><i class="fa fa-trash"></i></button>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
                	<form id="deleteImage" action="" method="POST">
				        @csrf
				        @method('delete')
				        
				    </form>
                </div>
            </div>
    	</div>
    </div>
</div>
@endsection