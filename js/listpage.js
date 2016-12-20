
(function($) {

  // Vars
  var categoryClass = 'list-category';
  var categoryTriggerClass = 'list-items-category a';
  var itemsClass = 'list-items-wrap';
  var itemContentClass = 'list-item-content';
  var itemTriggerClass = 'list-item-trigger';
  var startOpenClass = 'start-open-toggle';
  var $category = $('.' + categoryClass);
  var $categoryTrigger = $('.' + categoryTriggerClass);
  var $categoryContent = $('.list-content');
  var $itemContent = $('.' + itemContentClass);
  var $itemTrigger = $('.' + itemTriggerClass);
  var $items = $('.' + itemsClass);
  var activeClass = 'active';
  var animationSpeed = 300;
  var categoryToggleClass = 'has-toggle';
  var itemToggleClass = 'has-list-items-toggle';

  // Funciton to hide all categorized items
  var closeAllCategorizedItems = function() {
    $category.removeClass(activeClass);
    $categoryTrigger.removeClass(activeClass);
    $items.hide();
  };

  // Function to hide all categorized items siblings
  var closeCategorizedItemsSiblings = function(el) {
    el.parent().parent().siblings().removeClass(activeClass).find('.' + itemsClass).hide();
    el.parent().parent().siblings().find('.' + categoryTriggerClass).removeClass(activeClass);
  };

  // Function to show list categored items
  var openCategorizedItems = function(el) {
    el.addClass(activeClass);
    el.parent().parent().addClass(activeClass);
    el.parent().parent().find('.' + itemsClass).slideDown(animationSpeed);
  };

  // Function to hide list categorized items
  var closeCategorizedItems = function(el) {
    el.removeClass(activeClass);
    el.parent().parent().removeClass(activeClass);
    el.parent().parent().find('.' + itemsClass).slideUp(animationSpeed);
  };

  // Handle toggle of categorized items when trigger is clicked/touched
  $categoryTrigger.on('click', function(e) {
    var $this;
    $this = $(this);
    e.preventDefault();
    closeCategorizedItemsSiblings($this);
    if($this.hasClass(activeClass))
      closeCategorizedItems($this);
    else
      openCategorizedItems($this);
  });

  // Function to hide all items
  var closeAllItems = function() {
    $itemContent.removeClass(activeClass);
    $itemTrigger.removeClass(activeClass);
    $itemContent.hide();
  };

  // Function to open items
  var openItems = function(el) {
    el.addClass(activeClass);
    el.parent().parent().addClass(activeClass);
    el.parent().parent().find('.' + itemContentClass).slideDown(animationSpeed);
  };

  // Function to close items
  var closeItems = function(el) {
    el.removeClass(activeClass);
    el.parent().parent().removeClass(activeClass);
    el.parent().parent().find('.' + itemContentClass).slideUp(animationSpeed);
  };

  // Function to hide all items siblings
  var closeItemsSiblings = function(el) {
    el.parent().parent().siblings().removeClass(activeClass).find('.' + itemContentClass).hide();
    el.parent().parent().siblings().find('.' + itemTriggerClass).removeClass(activeClass);
  };

  // Handle toggle of items when trigger is clicked/touched
  $itemTrigger.on('click', function(e) {
    var $this;
    $this = $(this);
    e.preventDefault();
    closeItemsSiblings($this);
    if($this.hasClass(activeClass))
      closeItems($this);
    else
      openItems($this);
  });

  // Do stuff when the doc is first loaded
  $(document).ready(function() {
    // If categories need a toggle, close them all to start
    if($categoryContent.hasClass(categoryToggleClass)) {
      closeAllCategorizedItems();
      // If we should open the first category, then let's do it
      if($categoryContent.hasClass(startOpenClass)) {
        openCategorizedItems($categoryTrigger.first());
      }
    }
    // If items need a toggle, close them all to start
    if($categoryContent.hasClass(itemToggleClass)) {
      closeAllItems();
    }
  });

})(jQuery);
