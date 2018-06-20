(function () {
  'use strict';
  Drupal.behaviors.scrolljs = {
    attach: function (context, settings) {
    //jQuery('.cio-list').css('display','none');
    jQuery('.list-hideshow').hide();
    jQuery('.publish-drop-wrap').each (function() {
      var $dropdown = jQuery(this);
      jQuery(this).find('.publish-main-drop', $dropdown).click(function() {
       var $div = jQuery("div.list-hideshow", $dropdown);
        $div.toggle();
        jQuery("div.list-hideshow").not($div).hide();
         return false;
      });
    });
//close popup when click outside.
      jQuery(document).click(function(e){
        var p = jQuery(e.target).closest('.publish-drop-wrap').length
        if (!p) {
              jQuery("div.list-hideshow").hide();
        }
    });

    }
  };
}('jQuery'));

// When the user clicks on <div>, open the popup
function myFunction() {
    var popup = document.getElementById("myPopup");
    popup.classList.toggle("show");
}
