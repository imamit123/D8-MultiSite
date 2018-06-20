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

      /*var loadVideo = $('.video-home .owl-item:first-child').find('.video').text();
      $('.video-wrapper').html(loadVideo);*/
      /*setTimeout(function(){
        $('.video-home .owl-item:first-child').find('img').click();
      }, 2000);*/
      /****** code for owl carousel ********/
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
      /*********** code for adding active class to special tabs *************/
    /*  $(function(){
        jQuery('.field-content a[href^="/node/' + location.pathname.split("/")[2] + '"]').addClass('active');
        var current = location.pathname;
        $('.field-content a').each(function(){
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
       var k = location.pathname.split('/')[3];

      if (k == 'undefined')
      {
        jQuery(jQuery("#specialtabid").find("a.specialbtn:first")).addClass('active')
      }else{
         var current = location.pathname;
            jQuery('#specialtabid a').each(function(){
                  var $this = jQuery(this);
                  // if the current path is like this link, make it active
                  if($this.attr('href').split('/')[3] == k){
                      $this.addClass('active');
                  }
            })       
      }
      });


      /***************** code for loading videos **************/
      /*var video = jQuery(this).siblings('.video').find('a').attr('href');
        video = video.replace('&quot', '');
        jQuery('.video-wrapper').html('<iframe heigh="400" src='+ video + '></iframe>');*/


      /*jQuery('.video-detail .views-row').each(function() {
        var loadVideo1 = jQuery(this).find('.video').text();
        jQuery(this).find('.video-wrapper').html(loadVideo1);
      });*/
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

      /************ code for search*************/
      jQuery('.search-icon').click(function() {
        jQuery(this).toggleClass('active');
        jQuery(this).siblings('form').toggleClass('active');
      });
    }
  };

$(".analyticsclick").click(function(){
        // title = $('.title-text span').text();
        ga('send', 'event', 'CW', 'Click',document.title);
  
    });

  /* js for convert video script into iframe */
  $(window).load(function() {
    // var loadVideo2 = $('.video-detail .views-row').find('.video').text();
    // $('.video-wrapper').html(loadVideo2);

    jQuery('.video-landing .views-row').each(function() {
      var loadVideo1 = jQuery(this).find('.video').text();
      jQuery(this).find('.video-wrapper').html(loadVideo1);
    });
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
});

jQuery(window).load(function() {
  jQuery('.video-home .owl-item:first-child').find('img').click();
  var header_height = jQuery('header').height();
  jQuery('.as-localnav-placeholder').height(header_height);
});

jQuery(document).ready(function(){
  /****** code for loading  video on click ************/
      jQuery('.video-home .img').click(function() {
        var video = jQuery(this).siblings('.video').find('a').attr('href');
        //video = video.slice(0, -5);
        video = video.replace('&quot', '');
        jQuery('.video-wrapper').html('<iframe src='+ video + '></iframe>');
      });
      var loadvideo = jQuery('.video-detail .views-row').find('.video').find('a').attr('href');
      //loadvideo = loadvideo.slice(0, -5);
      loadvideo = loadvideo.replace('&quot', '');
      jQuery('.video-wrapper').html('<iframe height="400" src='+ loadvideo + '></iframe>');
});
