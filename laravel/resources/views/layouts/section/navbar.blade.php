<header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-custom ">
  	<div class="container">
  		
	    <a class="navbar-brand" href="#">
	    	<img src="{{asset('imgs/logo.png')}}" width="70" alt="">
	    {{env('APP_NAME')}}</a>
	    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="navbarCollapse">
	      <ul class="navbar-nav ml-auto">
	        <li class="nav-item ml-5">
	          <a class="nav-link text-uppercase" href="#myCarousel">Inicio <span class="sr-only">(current)</span></a>
	        </li>
	        <li class="nav-item ml-5">
	          <a class="nav-link text-uppercase" href="#nosotros">Nosotros</a>
	        </li>
	        <li class="nav-item ml-5">
	          <a class="nav-link text-uppercase" href="#servicios">Servicios</a>
	        </li>
	        {{-- <li class="nav-item ml-5">
	          <a class="nav-link text-uppercase" href="#clientes">Clientes</a>
	        </li> --}}
	        <li class="nav-item ml-5">
	          <a class="nav-link text-uppercase" href="#contacto">Contacto</a>
	        </li>
	      </ul>
	    </div>
  	</div>
  </nav>
</header>