demo = {

    showSwal: function(type, title, mensaje, procesa = null,pdismiss=null,custom=false) {


        if(type=='input'){
            swal({
                type: 'info',
                input:'textarea',
                title: title,
                text: mensaje,
                buttonsStyling: false,
                confirmButtonClass: 'btn btn-primary',
                confirmButtonText: "Guardar",
                inputPlaceholder: mensaje,
            }).then(function(inputValue) {
                if (inputValue === "") {
                    pdismiss();
                    
                }else{

                    if (procesa != null && typeof procesa =='function') {
                       procesa(inputValue);
                    }else if(procesa != null && typeof procesa !='string'){
                        $.ajax(procesa);
                    }
                }
                
            },function(dismiss){
                if(!pdismiss){

                    demo.showSwal('error', 'Operación cancelada', 'No se realizó ninguna acción.');
                }else{
                    pdismiss()
                }
            });
        }
        else if (type != 'confirm') {

            let _clase = type != 'error' ? type : 'danger';
            swal({
                type: type,
                title: title,
                text: mensaje,
                buttonsStyling: false,
                confirmButtonClass: 'btn btn-' + _clase,
            }).then(function() {
                if (procesa != null) {
                    if (procesa == "cerrarFB") {
                        parent.$.fancybox.close();
                        location.reload();
                    } else if (procesa == 'reload') {
                        location.reload();
                    }else if(typeof procesa == 'function'){
                        procesa();
                    } else {
                        location.replace(procesa);
                        parent.$.fancybox.close();
                    }
                }
            });

        } else {
            let _custom=custom?'custom':'primary';
            swal({
                type: 'question',
                title: title,
                text: mensaje,
                buttonsStyling: false,
                confirmButtonClass: 'btn btn-'+_custom,
                cancelButtonClass: 'btn btn-outline-'+_custom,
                showCancelButton: true,
                cancelButtonText: 'No',
                confirmButtonText: 'Si!',
            }).then(function() {
                    if (typeof procesa == 'string') {

                        demo.showSwal('success', 'Listo!', 'Operación realizada con éxtito.', procesa);
                    }else if(typeof procesa == 'function'){
                        procesa();
                    }else {
                        $.ajax(procesa);

                    }
                }, function(dismiss) {
                    if(!pdismiss){

                        demo.showSwal('error', 'Operación cancelada', 'No se realizó ninguna acción.');
                    }else{
                        pdismiss()
                    }
                }

            );
        }


    },
     initFullCalendar: function(idusuario) {

        if (typeof $calendar != "undefined") {

            console.log($calendar);
            $calendar.fullCalendar('destroy');
            delete $calendar;

        }

        $('#fullCalendar').fullCalendar('destroy');

        $calendar = $('#fullCalendar');

        today = new Date();
        y = today.getFullYear();
        m = today.getMonth();
        d = today.getDate();
        hoy = moment(today).format('YYYY-MM-DD HH:mm');

        $calendar.fullCalendar({

            viewRender: function(view, element) {
                // We make sure that we activate the perfect scrollbar when the view isn't on Month
                if (view.name != 'month') {
                    $(element).find('.fc-scroller').perfectScrollbar();
                }
            },
            header: {
                center: 'title',
                right: 'month,agendaWeek,agendaDay',
                left: 'prev,next,today'
            },
            defaultDate: today,
            selectable: true,
            selectHelper: true,
            views: {
                month: { // name of view
                    titleFormat: 'MMMM YYYY'
                    // other view-specific options here
                },
                week: {
                    titleFormat: " MMMM D YYYY"
                },
                day: {
                    titleFormat: 'D MMM, YYYY'
                }
            },
            editable: true,
            eventLimit: true, // allow "more" link when too many events

            locale: 'es',

            dayClick: function(start, end) {

                $('.tooltip').remove();
                $('#start').val(moment(start).format('DD/MM/YYYY HH:mm:ss'));
                $('#end').val(moment(end).format('DD/MM/YYYY HH:mm:ss'));
                var diaSeleccionado = moment(start).format('DD/MM/YYYY');
                // Open modal to add event
                modal({
                    // Available buttons when adding
                    buttons: {
                        add: {
                            id: 'add-event', // Buttons id
                            css: 'btn-primary', // Buttons class
                            label: 'Agregar' // Buttons label
                        }
                    },
                    //idUser: idusuario,
                    title: 'Crear Cita', // Modal title
                    selectDia: diaSeleccionado
                });
            },
            // color classes: [ event-blue | event-azure | event-green | event-orange | event-red ]
            events: _tpl_ + 'ajax/tpl_llenar_Calendar.php?idusuario=' + idusuario,

            eventRender: function(event, element) {
                //$(element).tooltip({title: event.start});
                if (typeof event.nombre != 'undefined') {
                    //$(element).tooltip({title:'asignado a: '+event.nombre+' '+event.apellidos, container: "body"});
                    $(element).tooltip({ title: event.nota, container: "body" });
                }
                //Add icon to event
                if (event.icon) {
                    element.find(".fc-time").prepend("<i class='" + event.icon + "'></i>");
                }
            },

            /*  eventMouseover: function(calEvent, jsEvent) {
                var tooltip = '<div class="tooltipevent" style="width:100px;height:50px;background:#fff;position:absolute;z-index:10001;">' + calEvent.title + '</div>';
                var $tooltip = $(tooltip).appendTo('body');

                $(this).mouseover(function(e) {
                  $(this).css('z-index', 10000);
                  $tooltip.fadeIn('500');
                  $tooltip.fadeTo('10', 1.9);
                }).mousemove(function(e) {
                  $tooltip.css('top', e.pageY + 10);
                  $tooltip.css('left', e.pageX + 20);
                });
              },*/

            eventMouseout: function(calEvent, jsEvent) {
                $(this).css('z-index', 8);
                $('.tooltip').remove();
            },

            eventClick: function(calEvent, jsEvent, view) {
                $('.tooltip').remove();
                // Set currentEvent variable according to the event clicked in the calendar
                currentEvent = calEvent;

                // Open modal to edit or delete event
                modal({
                    // Available buttons when editing
                    buttons: {
                        delete: {
                            id: 'delete-event',
                            css: 'btn-danger',
                            label: 'Eliminar'
                        },
                        update: {
                            id: 'update-event',
                            css: 'btn-primary',
                            label: 'Actualizar'
                        }
                    },
                    title: 'Editar "' + calEvent.nota + '"',
                    event: calEvent

                });
            },

            eventDrop: function(event, delta, revertFunc, start, end) {

                start = event.start.format('YYYY-MM-DD HH:mm:ss');
                if (event.end) {
                    end = event.end.format('YYYY-MM-DD HH:mm:ss');

                } else {
                    end = start;

                }

                var diainicio = moment(start).format("YYYY-MM-DD 00:00:00");
                var diafin = moment(start).format("YYYY-MM-DD 23:59:59");

                var fInicioO = moment.utc(event.fechaasin).format("YYYY-MM-DD HH:mm:ss"); //fechainicioOrigen
                var fTerminoO = moment.utc(event.end).format("YYYY-MM-DD HH:mm:ss"); //fechaterminoOrigen
                var fechaID = moment(start).format('YYYY-MM-DD HH:mm:ss'); //fechainicioDestino
                var ok;
                /*  if(moment(diainicio).format('YYYY-MM-DD')<moment(hoy).format('YYYY-MM-DD')){
                    //alert('diainicio:'+moment(diainicio).format('YYYY-MM-DD')+'\nHoy:'+moment(hoy).format('YYYY-MM-DD'));
                    demo.showSwal('warning','¡Alerta!','No puede reprogramar citas a una fecha anterior al día de hoy','agenda/citas');
                  }*/

                if (moment(hoy).format('YYYY-MM-DD') < fInicioO && moment(hoy).format('YYYY-MM-DD') < fechaID) {

                    //alert('start1:'+hoy+'\nEnd1:'+fInicioO);
                    // ok=true;

                    if (event.idestado == '2') {
                        demo.showSwal('warning', '¡Alerta!', 'No se pueden mover citas que ya han sido realizadas', 'agenda/citas');
                    } else {
                        $.ajax({
                                url: _tpl_ + '/ajax/tpl_ubigeos.php?tipe=validafechacita',
                                type: 'POST',
                                data: { fechainicio: start, idusuario: idusuario, fechafin: end, empieza: diainicio, termina: diafin, idcita: event.id },
                                async: false
                            })
                            .done(function(data) {
                                console.log(data);
                                if (data == '0') {
                                    $.post(_tpl_ + 'ajax/tpl_ubigeos.php?tipe=cita-dragUpdateEvent', {
                                        id: event.id,
                                        start: start,
                                        end: end,
                                        tiempo: event.tiempo
                                    }, function(result) {

                                        demo.showSwal('success', '¡Éxito!', 'Evento actualizado satisfactoriamente', 'agenda/citas');

                                    });

                                } else {
                                    demo.showSwal('warning', '¡Alerta!', 'Ya existen citas registradas en ese horario', 'agenda/citas');
                                    return false;
                                }
                            });

                    }

                } else {
                    if (moment(hoy).format('YYYY-MM-DD') > fInicioO) {
                        demo.showSwal('warning', '¡Alerta!', 'No se puede reprogramar una cita vencida', 'agenda/citas');
                    } else {
                        //alert('start:'+start+'\nEnd:'+end);
                        demo.showSwal('warning', '¡Alerta!', 'No puede reprogramar citas a una fecha anterior al día de hoy', 'agenda/citas');
                        //alert('start:'+hoy+'\nEnd:'+fInicioO);

                    }
                }




            }
        });

        // Prepares the modal window according to data passed
        function modal(data) {
            //alert('abc');
            // Set modal title
            $('.modal-title').html(data.title);
            // Clear buttons except Cancel
            $('.modal-footer button:not(".btn-default")').remove();
            // Set input values
            $('#title').val(data.event ? data.event.nota : '');
            $('#fechaasin').val(data.event ? moment(data.event.fechaasin).format('DD/MM/YYYY HH:mm:ss') : '');
            $('#contactoedit').val(data.event ? data.event.contactoedit : '');
            $('#observacion').val(data.event ? data.event.observacion : '');
            $('#idestado').val(data.event ? data.event.idestado : '');
            $('#color').val(data.event ? data.event.color : '#3a87ad');
            $('#idusuario').val(idusuario);

            // Create Butttons
            $.each(data.buttons, function(index, button) {
                $('.modal-footer').prepend('<button type="button" id="' + button.id + '" class="btn ' + button.css + '">' + button.label + '</button>')
            })

            if (data.event) {
                $('#boxcontactoedit').slideDown(250);
                $('#boxobservacion').slideDown(250);
                $('#boxestado').slideDown(250);
                $('#boxcontacto').slideUp(250);
                $('#idcita').val(data.event.id);
                $('#finicioO').val(data.event.start);
                $('#fterminoO').val(data.event.end);
                $('#tiposervicio option').removeAttr('selected');
                $('#tiposervicio option[value=' + data.event.idservicio + '-' + data.event.tiempo + ']').attr('selected', 'selected');
                $('#telf_contacto').val(data.event.telefono);
                if (data.event.idestado == '1') {
                    $("#estadocita .pend").prop("selected", "selected");
                    $("#estadocita .real").removeProp("selected");
                } else {
                    $("#estadocita .real").prop("selected", "selected");
                    $("#estadocita .pend").removeProp("selected");
                    $('#update-event').attr('disabled', 'disabled');
                    $('#delete-event').attr('disabled', 'disabled');
                }

                //deshabilitar botones update y delete para fechas anteriores al día actual
                if (moment(data.event.fechaasin).format('YYYY-MM-DD') < moment(hoy).format('YYYY-MM-DD')) {
                    $('#update-event').attr('disabled', 'disabled');
                    $('#delete-event').attr('disabled', 'disabled');
                }

            } else {
                $('#fechaasin').val(data.selectDia + ' 08:30'); //hora que empieza el día
                $('#boxcontacto').slideDown(250);
                $('#boxcontactoedit').slideUp(250);
                $('#boxobservacion').slideUp(250);
                $('#boxestado').slideUp(250);
                $('#tiposervicio option').removeAttr('selected');
            };


            //Show Modal
            $('.modal').modal('show');

        }

    }
}
//###########MODAL CALENDAR CLICK######################
	    // Handle Click on Add Button
    $('.modal').on('click', '#add-event',  function(e){

        if(validator(['title', 'fechaasin'])) {
			var serviciocita=$('#tiposervicio').val().split('-');
			var id_serv = serviciocita[0];
			var timeservicio = serviciocita[1];
			var id_contacto=$('#id_contacto').val();
			var tablaContacto=$('#tabla').val();
			var fecha=formatoFecha($('#fechaasin').val());
			var nota=$('#title').val();
			var idUser=$('#idusuario').val();

			var fechafinal=moment(fecha).add(parseInt(timeservicio),'minutes').format("YYYY-MM-DD HH:mm:ss");
			var diainicio=moment(fecha).format("YYYY-MM-DD 00:00:00");
			var diafin=moment(fecha).format("YYYY-MM-DD 23:59:59");
			

	if(diainicio<moment(hoy).format("YYYY-MM-DD 00:00:00")){
		//alert('diainicio: '+diainicio+'\nHoy'+hoy);
		demo.showSwal('warning','¡Alerta!','No puede crear citas con fechas anteriores al día de hoy');
		//alert('No puede crear citas con fechas anteriores al día de hoy');
	}else if(id_contacto==''){
			demo.showSwal('warning','¡Alerta!','Debe registrar la cita a nombre de un paciente o contacto');
			}
else{

//alert('fechainicio:'+fecha+'\nidusuario:'+idUser+'\nfechafin:'+fechafinal+'\nempieza:'+diainicio+'\ntermina:'+diafin);

		$.ajax({
				url: _tpl_+'/ajax/tpl_ubigeos.php?tipe=validafechacita',
				type: 'POST',
				data: {fechainicio : fecha, idusuario : idUser, fechafin:fechafinal,empieza:diainicio, termina:diafin},
				async:false
			  })
			  .done(function(data) {
				  //alert(data);
				  if(data=='0'){
					  //alert(data);
					   $.post(_tpl_+'ajax/tpl_ubigeos.php?tipe=cita&fech='+fecha+'&not='+nota+'&id_cont='+id_contacto+'&id_tabla='+tablaContacto+'&idserv='+id_serv+'&tiemposervicio='+timeservicio+'&idusuario='+idUser, {
							nota: $('#title').val()

						}, function(result){
              // console.log(result);
							//alert(result);
							$('#modal').modal('hide');
							demo.showSwal('success','¡Éxito!','Evento creado','agenda/citas');

						});
				}else{
				demo.showSwal('warning','¡Alerta!','Ya existen citas registradas en ese horario');
				return false;
				}
				});

}

        }
    });


    // Handle click on Update Button
    $('.modal').on('click', '#update-event',  function(e){
		var idcita=$('#idcita').val();
        if(validator(['title', 'fechaasin'])) {
			var serviciocita=$('#tiposervicio').val().split('-');
			var id_serv = serviciocita[0];
			var timeservicio = serviciocita[1];
			var fecha=formatoFecha($('#fechaasin').val());
			var idUser=$('#idusuario').val();
			var fechaID=moment(fecha).format('YYYY-MM-DD HH:mm:ss');//fechainicioDestino
			var fechafinal=moment(fecha).add(parseInt(timeservicio),'minutes').format("YYYY-MM-DD HH:mm:ss");
			var diainicio=moment(fecha).format("YYYY-MM-DD 00:00:00");
			var diafin=moment(fecha).format("YYYY-MM-DD 23:59:59");
			var fInicioO=moment.utc($('#finicioO').val()).format("YYYY-MM-DD HH:mm:ss");//fechainicioOrigen
			var fTerminoO=moment.utc($('#fterminoO').val()).format("YYYY-MM-DD HH:mm:ss");//fechaterminoOrigen


if(moment(hoy).format('YYYY-MM-DD')<fInicioO && moment(hoy).format('YYYY-MM-DD')<fechaID){

	//alert('fecha:'+fechaID+'\nfechafinal:'+fechafinal+'\ndiainicio:'+diainicio+'\ndiafin:'+diafin+'\nfInicioO:'+fInicioO+'\nfTerminoO:'+fTerminoO);

		$.ajax({
				url: _tpl_+'/ajax/tpl_ubigeos.php?tipe=validafechacita',
				type: 'POST',
				data: {fechainicio : fecha, idusuario : idUser, fechafin:fechafinal,empieza:diainicio, termina:diafin, cita: 'existe',idcita:idcita},
				async:false
			  })
			  .done(function(data) {
				  var ok= false;
				  console.log(data);
				  var statecita=$( "#estadocita" ).val();
				  var fM4Horas=moment(fechafinal).add(4,'hours').format('YYYY-MM-DD HH:mm:ss');
				  var fechaasin=formatoFecha($('#fechaasin').val());
				  var __hours = moment(hoy).diff(moment(fM4Horas), 'hours');

				  if(data=='0'){
					 // alert(data);
					 	if(statecita=='2'){
							
							if(__hours<=0){//ahora-(ftermino+4)<0
								ok=true;
							//console.log('horas:'+__hours);
							}else{
							//	console.log('horas:'+__hours);
								demo.showSwal('warning','¡Alerta!','Ha expirado el tiempo para modificar el estado de la cita','agenda/citas');
							}

						}else{
							ok=true;

						}

						if(ok==true){
									$.post(_tpl_+'ajax/tpl_ubigeos.php?tipe=cita-edit', {
										id: idcita,
										nota: $('#title').val(),
										observacion: $('#observacion').val(),
										fecha: fechaasin,
										estado: $( "#estadocita" ).val(),
										color: $('#color').val(),
										idservicio: serviciocita[0],
										tiemposervicio: serviciocita[1]
									}, function(result){

										demo.showSwal('success','¡Éxito!','Evento actualizado satisfactoriamente','agenda/citas');
										$('#modal').modal('toggle');
										  //alert(result);
								});
						}

				}else{
				demo.showSwal('warning','¡Alerta!','Ya existen citas registradas en ese horario');
				return false;
				}
				});



        }else{

			demo.showSwal('warning','¡Alerta!','No se pueden reprogramar citas a una fecha anterior al día de hoy','agenda/citas');
		//alert('fecha:'+fechaID+'\nfechafinal:'+fechafinal+'\ndiainicio:'+diainicio+'\ndiafin:'+diafin+'\nfInicioO:'+fInicioO+'\nfTerminoO:'+fTerminoO);

		}


	}
    });



    // Handle Click on Delete Button
    $('.modal').on('click', '#delete-event',  function(e){
       /* $.get(_tpl_+'ajax/tpl_ubigeos.php?tipe=cita-delete&id=' + currentEvent.id, function(result){

        });*/
		var idcita=$('#idcita').val();
	demo.showSwal('delete','Está seguro de eliminar esta cita','No podrá deshacer esta operación',_tpl_+'ajax/tpl_ubigeos.php?tipe=cita-delete&id=' + idcita,'cita');
   $('#modal').modal('toggle');
   });


    // Dead Basic Validation For Inputs
    function validator(elements) {
        var errors = 0;
        $.each(elements, function(index, element){
            if($.trim($('#' + element).val()) == '') errors++;
        });
        if(errors) {
            $('.error').html('Por favor ingrese todos los campos');
            return false;
        }
        return true;
    }
