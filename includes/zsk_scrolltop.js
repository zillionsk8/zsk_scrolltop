jQuery(document).ready(function($){
	$(window).scroll(function(){
        if (jQuery(this).scrollTop() < 500) {
			$('#zskscrolltop').fadeOut("slow");
        } else {
			$('#zskscrolltop').fadeIn("slow");
        }
    });
	$('#zskscrolltop').on('click', function(){
		$('html, body').animate({scrollTop:0}, 1000);
			return false;
		});
});