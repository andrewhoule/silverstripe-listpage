$(document).ready(function(){


/* ==========================================================================
   Toggle Effect on List Categories
   ========================================================================== */
  
if($('.list-content').hasClass('has-toggle')) {
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
    var activeClass = $(this).attr("class").split(' ')[0];
    $('.list-items-wrap.'+activeClass).slideToggle('fast');
     return false;
  });
}


/* ==========================================================================
   Toggle Effect on List Items
   ========================================================================== */
  
if($('.list-content').hasClass('has-list-items-toggle')) {
  $('.list-item-content').hide();
  // Behavior when list item is clicked (slide toggle)
  $('.list-item-trigger').click(function(){
    $(this).parent().parent().siblings().find('.title').removeClass('active');
    $(this).parent().toggleClass('active');
    $(this).parent().parent().siblings().find(".list-item-content").hide();
    $(this).parent().parent().find('.list-item-content').slideToggle('fast');
     return false;
  });
}


}); // End of Doc Ready