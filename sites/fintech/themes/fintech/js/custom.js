(function ($, Drupal, drupalSettings) {
  Drupal.behaviors.myModuleBehavior = {
    attach: function (context, settings) {
      jQuery('.js-pager__items a').addClass('btn text-uppercase mx-auto text-center btn-secondary cus-loadmore');
      $('.carousel.view-display-id-block_6 .view-content').owlCarousel({
          loops:true,
          nav:true,
          navigation:true,
          navigationText: [
             "<i class='fa fa-arrow-circle-left' aria-hidden='true'></i>",
             "<i class='fa fa-arrow-circle-right' aria-hidden='true'></i>"
          ],
          items: 1,
          itemsDesktop : [1199, 1],
          itemsDesktopSmall : [979, 1],
          itemsTablet : [768, 1],
          itemsMobile : [479, 1]
          });
      $('.carousel-1.view-display-id-block_4 .view-content').owlCarousel({
          loops:true,
          nav:true,
          navigation:true,
          navigationText: [
             "<i class='fa fa-arrow-circle-left' aria-hidden='true'></i>",
             "<i class='fa fa-arrow-circle-right' aria-hidden='true'></i>"
          ],
          items: 5,
          itemsDesktop : [1199, 4],
          itemsDesktopSmall : [979, 3],
          itemsTablet : [768, 3],
          itemsMobileLandscape : [767, 2],
          itemsMobile : [479, 1]
          })
      jQuery('.mini-submenu').on('click',function() { 
        jQuery(this).parents('.navbar ').siblings('.collapse__menu').find('.list-group').toggle('slide');
      });
      jQuery('.collapse__menu ul.menu').append("<span class='float-right' id='slide-submenu'><i class='fa fa-times'></i></span>");
      jQuery('#slide-submenu').on('click',function() { 
        jQuery(this).closest('.list-group').fadeOut('slide',function(){});
      });
      jQuery('.mobile_search_icon').click(function (e) {
        e.stopPropagation();
        jQuery('.search-mobile').slideToggle();  
      });
      jQuery('img').removeAttr('width').removeAttr('height');
    }
  }
})(jQuery, Drupal, drupalSettings);

jQuery(document).ready(function($) {
  var alterClass = function() {
    var ww = document.body.clientWidth;
    if (ww < 544) {
      $(".listingdiv .views-row:nth-child(odd) .cus-img").removeClass("push-sm-6");
      $(".listingdiv .views-row:nth-child(odd) .cus-text").removeClass("pull-sm-6");
      $(".listingdiv.adv-board .views-row:nth-child(even) .cus-img").removeClass("push-sm-6");
      $(".listingdiv.adv-board .views-row:nth-child(even) .cus-text").removeClass("pull-sm-6");
      $('#navbarsExampleDefault .cus-navbar').hide();
    } else if (ww >= 545) {
      $(".listingdiv.adv-board .views-row:nth-child(even) .cus-img").addClass("push-sm-6");
      $(".listingdiv.adv-board .views-row:nth-child(even) .cus-text").addClass("pull-sm-6");
      $(".listingdiv .views-row:nth-child(odd) .cus-img").addClass("push-sm-6");
      $(".listingdiv .views-row:nth-child(odd) .cus-text").addClass("pull-sm-6");
      $(".listingdiv.adv-board .views-row:nth-child(odd) .cus-img").removeClass("push-sm-6");
      $(".listingdiv.adv-board .views-row:nth-child(odd) .cus-text").removeClass("pull-sm-6");
    };
  };
  $(window).resize(function(){
    alterClass();
  });
  //Fire it when the page first loads:

    alterClass();

  $( document ).ajaxComplete(function( event, request, settings ) {
   alterClass();
  });
});
