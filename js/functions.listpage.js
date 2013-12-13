$(document).ready(function(){
  
var toggleClass = $('.list-content').attr('class').split(' ')[1];
if(toggleClass == "has-toggle") {
	// Hide all items, then show the first list items by default
	$('.list-items-wrap').hide();
	$('.list-items-wrap:first').show();
	$('.list-items-category:first').addClass('active');

	// Behavior when category is clicked (slide toggle)
	$('.list-items-category a').click(function(){
		$('.list-items-category').removeClass('active');
		$(this).parent().parent().siblings().find(".list-items-wrap").hide(); // Hide Siblings
		$(this).parent().toggleClass('active');
	    var activeClass = $(this).attr('class');
	    $('.list-items-wrap.'+activeClass).slideToggle('fast');
	   	return false;
	});
}

});