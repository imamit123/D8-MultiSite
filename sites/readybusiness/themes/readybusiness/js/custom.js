(function ($, Drupal, drupalSettings) {
  Drupal.behaviors.myModuleBehavior = {
    attach: function (context, settings) {
      $('.popup').prepend('<div id="close-button" class="btn-sm"></div>');
      $('#close-button').on('click', function() {  $('#block-webform-2').fadeOut();});
        $(window).load(function(){
           setTimeout(function(){
              // contact form animations
              $('#block-webform-2').fadeToggle();
           }, 180000);
        });
        $(document).mouseup(function (e) {
          var container = $("#block-webform-2");
          if (!container.is(e.target) // if the target of the click isn't the container...
              && container.has(e.target).length === 0)
          {
              container.fadeOut();
          }
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

	  	$('.menuicon').unbind('click').bind('click', function () {
        $('.main__menu').slideToggle();
        $('.menuicon').toggleClass('open');
      });

	  	jQuery('.page-node-type-common-content .node__content').readmore({
        moreLink: '<div class="coninuereading"><a class="btn" href="#" >Continue reading</a></div>',
        collapsedHeight: 1215,
      });
      /************ code added for analytics ***************/
      var taxoname = drupalSettings.taxo;
      console.log(drupalSettings.taxo);
      $('.coninuereading a').on('click', function() {
         ga('send', 'event', 'Ready Business', 'Click', 'Continue reading –'+ drupalSettings.taxo);
      });
      $('.morelink a').on('click', function() {
         ga('send', 'event', 'Ready Business', 'Click', 'Back to –'+ drupalSettings.taxo);
      });
      $('.linkedin').on('click', function() {
        ga('send', 'event', 'Ready Business', 'Click', drupalSettings.title +'-Linkedin Share');
      });
      $('.facebook-share').on('click', function() {
        ga('send', 'event', 'Ready Business', 'Click', drupalSettings.title + '- Facebook Share');
      });
      $('.twitter').on('click', function() {
        ga('send', 'event', 'Ready Business', 'Click', drupalSettings.title +'- Twitter Share');
      });
      $('.webform-submission-contact_us-form input.button').on('click', function() {
        ga('send', 'event', 'Ready Business', 'Click', 'Ready Business - Contact us');
      });
      $('.block-poll .button').on('click', function() {
        ga('send', 'event', 'Ready Business', 'Click', 'Vote - value');
      });
      $('.webform-submission-newsletter-form input.button').on('click', function() {
        ga('send', 'event', 'Ready Business', 'Click', 'Subscribe Newsletter');
      });
	  }
  }
})(jQuery, Drupal, drupalSettings);
