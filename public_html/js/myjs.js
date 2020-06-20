$(document).ready(function(){
$('a').click(function() {
	if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
			 && location.hostname == this.hostname) {
     		var $target = $(this.hash);
     		$target = $target.length && $target || $('[name=' + this.hash.slice(1) +']');
     		if ($target.length) {
         		var targetOffset = $target.offset().top;

            console.log($("nav").outerHeight());
         		$('html,body').animate({scrollTop: (targetOffset-$("nav").outerHeight())}, 1500);
         		
       		return false;
    		}
			}
		

	});

});
