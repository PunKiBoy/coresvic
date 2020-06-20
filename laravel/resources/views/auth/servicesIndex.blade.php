@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    	<div class="col-md-10">
    		<div class="card">
                <div class="card-header">Servicios</div>
                <div class="card-body">
                	<div class="col-12 text-right mb-3">
                		@if(count($services)<3)
                		<a href="{{url('/auth/servicios/new')}}" class="btn btn-primary">Nuevo Servicio</a>
                		@endif
                	</div>
					<table class="table table-striped">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th>Titulo</th>
								<th class="text-center">Accion</th>
							</tr>
						</thead>
						<tbody>
							@foreach($services as $service)
							<tr>
								<td class="text-center">{{ $service->id }}</td>
								<td>{{ $service->name }}</td>
								<td class="text-center">
									<a class="btn btn-success" href="{{url('/auth/servicios/'.$service->id.'/edit')}}"><i class="fa fa-pencil-square-o"></i></a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
                	
                </div>
            </div>
    	</div>
    </div>
</div>
@endsection