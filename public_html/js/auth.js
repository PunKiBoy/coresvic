      function previewImg(input ) {

          const _target = $(input).parents('div.imgContainer').find('.image-preview');

          if (input.files && input.files[0]) {

              var reader = new FileReader();



              reader.onload = function(e) {

                  _target.attr('src', e.target.result);

              }



              reader.readAsDataURL(input.files[0]);

          }

      }
      $(document).ready(function(){

        $(".image-input").on('change', function(e) {
          

            previewImg(this);
        });
        $(".color-input").on('change',function(e){
          $(this).parents('div.imgContainer').find('.color-target').css('background',$(this).val());
        });
        $(".btnEliminar").on('click',function(){
            var _id=$(this).data('id');
            demo.showSwal('confirm',' ','¿Desea eliminar esta imagen?',function(){
                $("#deleteImage").attr('action','/auth/imagenes/'+_id);
                $("#deleteImage").submit();
            });
        });
      })