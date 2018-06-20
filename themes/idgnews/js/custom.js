/* custom js */
(function ($) {

  jQuery("#views-exposed-form-idg-homepage-content-page-1 #edit-reset").click(function(e){
       e.preventDefault();
       var protocol = window.location.protocol;
       var host = window.location.host;
       var path = '/home';
       window.location.href = protocol + '//' + host + path;
    });

  $('.block-view-drafts .view-content').enscroll();
  $('.block-view-media .view-content').enscroll();
  $('#counted_keywords').enscroll();
/* scroll to top */
$(window).scroll(function () {
  if ($(this).scrollTop() > 100) {
      $('.scrollup').fadeIn();
  } else {
      $('.scrollup').fadeOut();
  }
});

$('.scrollup').click(function () {
  $("html, body").animate({
    scrollTop: 0
  }, 600);
  return false;
});

jQuery("#pikame").PikaChoose({carousel: true, autoPlay: false});
}(jQuery));
