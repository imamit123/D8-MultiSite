(function () {
  'use strict';
  Drupal.behaviors.hidejs = {
    attach: function (context, settings) {
		if (jQuery('.messages--error .messages__item:contains("Rebuild permissions")').length > 0) {
			jQuery('.messages--error .messages__item:contains("Rebuild permissions")').remove(); 
		}
		else {
			jQuery(".messages--error").hide();	
		}
    }
  };
}('jQuery'));
