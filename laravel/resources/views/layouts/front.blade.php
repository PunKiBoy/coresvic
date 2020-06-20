<!DOCTYPE html>
<html lang="en">
@include('layouts.section.head')
<body>
	<div class="container-fluid p-0" style="padding-top: 3em!important;">
	@include('layouts.section.navbar')
	@yield('content')
	</div>
	@include('layouts.section.footer')

	@if($general['whatsapp']!='')	
	<div id="button-whatsapp" class="position-fixed">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#modalChatW">
                {{--  --}}
                <span>
                    <div id="whatsapp-icon">
                    </div>
                </span>
            </a>
        </div>
            <div class="modal fade" id="modalChatW">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <img src="{{asset('imgs/logo.png')}}" class="rounded-circle mr-2" alt="Cinque Terre" width="32" height="32"> 
                            <span class="modal-title h4">{{env('APP_NAME')}}</span>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Hola ¿En qué podemos ayudarte?</p>
                        </div>
                        <div class="modal-footer pb-0">
                            <div class="col-12">
                                <div class="row align-items-center">
                                    
                                        <input type="text" class="form-control" id="txtWhaAddon" value="Hola {{ env('APP_NAME')}}">
                                    
                                        <a id="aWhaAddon" href="https://api.whatsapp.com/send?phone=51{{ $general['whatsapp'] }}&text=Hola {{ env('APP_NAME')}}" target="_BLANK">
                                        <img src="{{asset('sendButtons.png')}}"  class="w-100" alt="">
                                        </a>
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
	@endif
@include('layouts.section.scripts')
</body>
</html>