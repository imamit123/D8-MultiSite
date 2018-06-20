(function ($, Drupal) {
  Drupal.behaviors.myModuleBehavior = {
    attach: function (context, settings) {
      jQuery('.hamburger').click(function() {
        jQuery('.tabs-content').toggleClass('active');
      });
      $("#btn-close").click(function(){
      $(".block-google-ads-front").hide();
        document.cookie = "setAds=home";
      });
      $('.video-home .img').click(function() {
        var video = $(this).siblings('.video').children('.field-content').text();
        video = video.trim();
        $('.video-wrapper').html(video);
      });
      /*setTimeout(function(){
        $('.video-home .owl-item:first-child').find('img').click();
      }, 3000);*/
      /*var loadVideo = $('.video-home .owl-item:first-child').find('.video').text();
      $('.video-wrapper').html(loadVideo);*/
      $('.slider').owlCarousel({
          loop:true,
          margin:10,
          nav:true,
          items: 1,
          navigation:true,
          navigationText:["prev","next"],
          prevText:"prev",
          nextText:"next"
      });
 /*     $(function(){
        jQuery('.field-content a[href^="/node/' + location.pathname.split("/")[2] + '"]').addClass('active');
        var current = location.pathname;
        $('.tabs-content .field-content a').each(function(){
            var $this = $(this);
            // if the current path is like this link, make it active
            if($this.attr('href').indexOf(current) == 0){
                $this.addClass('active');
            }
        })
        var tabsAttr = jQuery('#tabs-attr').attr('data-attr');
        jQuery('#tabs-attr a').css('background',tabsAttr);
      });*/

      $(function(){
      var k = location.pathname.split('/')[2];

      if (k == 'undefined')
      {
        jQuery(jQuery("#specialtabid").find("a.specialbtn:first")).addClass('active')
      }else{
         var current = location.pathname;
            jQuery('#specialtabid a').each(function(){
               var $this = jQuery(this);
               // if the current path is like this link, make it active
               if($this.attr('href').split('/')[2] == k){
                   $this.addClass('active');
                  }
            })       
       }
      });
      /*********** added for hamburger menu desktop ******************/
        jQuery('#menu-hamburger', context).click(function(event) {
            event.preventDefault();
            event.stopPropagation();
            jQuery('.collapse__menu').toggle();
        });
        jQuery('body', context).click(function() {
            var submenu = jQuery('.collapse__menu');
            if(submenu.is(":visible")) {
                submenu.hide();
            }
        });


      jQuery('.video-landing .views-row').each(function() {
      var loadVideo1 = jQuery(this).find('.video').text();
      jQuery(this).find('.video-wrapper').html(loadVideo1);
    });
    }
  };

  $(window).load(function(){

    /* js for convert video script into iframe */
    var loadVideo2 = $('.video-detail .views-row').find('.video').text();
    $('.video-wrapper').html(loadVideo2);

    jQuery('.video-landing .views-row').each(function() {
      var loadVideo1 = jQuery(this).find('.video').text();
      jQuery(this).find('.video-wrapper').html(loadVideo1);
    });
     /*to remove date feild in winner profiles based on URL*/
    if(window.location.href.indexOf("/award-winners/") > -1) { 
        jQuery('.date').css('font-size','0px').css('display','none'); 
      } 
      else{
        jQuery('.date').css('display','block'); 
      }

  });

$(".analyticsclick").click(function(){
        // title = $('.title-text span').text();
        ga('send', 'event', 'ICW', 'Click',document.title);
  
    });

  /* js for scrol page to top */
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      $('.scrollup').fadeIn();
    } else {
      $('.scrollup').fadeOut();
    }
    var scroll = jQuery(this).scrollTop();
    var header = jQuery('.ad__section').outerHeight();
    if (scroll >= header) {
      jQuery("header").addClass("fixed");
    }
    else {
      jQuery("header").removeClass("fixed");
    }
  });

  $('.scrollup').click(function () {
    $("html, body").animate({
      scrollTop: 0
    }, 600);
    return false;
  });
})(jQuery, Drupal);

jQuery( document ).ajaxComplete(function() {
  jQuery('.ad1').not(':first').remove();
  jQuery('.ad2').not(':first').remove();
});

jQuery(window).load(function() {
  jQuery('.video-home .owl-item:first-child').find('img').click();
  var header_height = jQuery('header').height();
  jQuery('.as-localnav-placeholder').height(header_height);
});
