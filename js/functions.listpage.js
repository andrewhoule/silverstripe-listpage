$(document).ready(function(){


/* ==========================================================================
   Toggle Effect on List Categories
   ========================================================================== */
  
var toggleClass = $('.list-content').attr('class').split(' ')[1];
if(toggleClass == "has-toggle") {
	// Hide all items, then show the first list items by default
	$('.list-items-wrap').hide();
	if($(".list-content").hasClass("start-open-toggle")) {
		$('.list-items-wrap:first').show();
		$('.list-items-category:first').addClass('active');
	}
	// Behavior when category is clicked (slide toggle)
	$('.list-items-category a').click(function(){
		$(this).parent().parent().siblings().find('.list-items-category').removeClass('active');
	 	$(this).parent().toggleClass('active');
	 	$(this).parent().parent().siblings().find(".list-items-wrap").hide();
	 	var activeClass = $(this).attr('class');
	 	$('.list-items-wrap.'+activeClass).slideToggle('fast');
	   	return false;
	});
}


}); // End of Doc Ready