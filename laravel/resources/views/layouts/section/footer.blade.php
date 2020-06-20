<div class="container-fluid px-0 ">
	
	<footer class="bg-custom-muted pt-5">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="col-md-8 col-6">
						<div class="row">
							<img src="{{asset('imgs/logo.png')}}" class="w-100" alt="">
						</div>
						<div class="row">
							<p class="text-uppercase mb-0 h4 font-weight-bolder text-center">{{env('APP_NAME')}}</p>
							<p class="text-center" style="font-size: 0.7rem">{{$general['slogan']}}</p>
						</div>
					<div class="row justify-content-between">
							@if($general['instagram']!='')
							<a class="btn btn-dark" href="{{url($general['instagram'])}}" target="_blank"><i class="fa fa-instagram h5 m-0 p-0"></i></a>
							@endif
							@if($general['facebook']!='')
							<a class="btn btn-dark" href="{{url($general['facebook'])}}" target="_blank"><i class="fa fa-facebook h5 m-0 p-0"></i></a>
							@endif
							@if($general['twitter']!='')
							<a class="btn btn-dark" href="{{url($general['twitter'])}}" target="_blank"><i class="fa fa-twitter h5 m-0 p-0"></i></a>
							@endif
					</div>
						
					</div>
				</div>
				<div class="col-md-3">
					<h4 class="text-uppercase">{{env('APP_NAME')}}</h4>
					<ul class="list-unstyled">
						<li class="py-1"><a class="text-decoration-none text-reset text-uppercase" href="#myCarousel">Inicio</a></li>
						<li class="py-1"><a class="text-decoration-none text-reset text-uppercase" href="#nosotros">Nosotros</a></li>
						<li class="py-1"><a class="text-decoration-none text-reset text-uppercase" href="#servicios">Servicios</a></li>
						{{-- <li class="py-1"><a class="text-decoration-none text-reset text-uppercase" href="javascript:void(0)">Clientes</a></li> --}}
					</ul>
				</div>
				<div class="col-md-3">
					<h4 class="text-uppercase">Servicios</h4>
					<ul class="list-unstyled">
						<li class="py-1"><a class="text-decoration-none text-reset text-uppercase" href="javascript:void(0)">Compra de Residuos Sólidos</a></li>
						<li class="py-1"><a class="text-decoration-none text-reset text-uppercase" href="javascript:void(0)">Manejo De Servicios Sólidos</a></li>
						<li class="py-1"><a class="text-decoration-none text-reset text-uppercase" href="javascript:void(0)">Asesoría y Tratamiento De Residuos Sólidos</a></li>
					</ul>
				</div>
				<div class="col-md-3">
					<h4 class="text-uppercase">Contácto</h4>
					<ul class="list-unstyled">
						<li class="py-1"><a class="text-decoration-none text-reset text-uppercase" href="javascript:void(0)">Teléfono {{$general['telefono']}}</a></li>
						<li class="py-1"><a class="text-decoration-none text-reset text-uppercase" href="javascript:void(0)">Celular {{$general['whatsapp']}}</a></li>
						<li class="py-1"><a class="text-decoration-none text-reset text-uppercase" href="javascript:void(0)">Correo {{$general['email']}}</a></li>
					</ul>
					<p><a class="btn px-4 py-0 btn-custom" href="#contacto" role="button">Contáctanos Ya!</a></p>
				</div>
			</div>
		</div>
	</footer>
</div>