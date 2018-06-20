(function ($) {
  'use strict';

  $(document).ready(function () {
    //$('#node-newsletter-form .field--name-field-site-url').attr('disabled','disabled');
    $("#node-newsletter-form .field--name-field-site-url" ).each(function() {
      $(this).find('input').attr('readonly', true);
    });
    
    // var inputElements = $('.paragraphs-subform').find('.js-text-full');
    //   console.log(inputElements);
    //   inputElements.each(function(index){
    //     if(index == 2){
    //       $(this).hide();
    //     }
    //   })

    $('body').on('blur', '.form-autocomplete', function(e){
      var $news_type = $('#edit-field-select-newsletter-type option:selected').attr('value')
      var $ele = $(this);
      jQuery.ajax({
        url: '../../idg-get-news-content',
        async: true,
        type: 'post',
        data: 'node=' + encodeURIComponent($(this).val())+'&id='+$(this).attr('id')+'&type='+$news_type ,
        //on Successs update fields
        success: function(res){
          // var msg = $.parseJSON(res);
          // if (res.alert !== null){
          //   alert(res.alert);
          // }
          // else{
            //Get parent of this paragraph div paragraphs-subform
            //console.log($(this).parent('.js-form-wrapper'));
            $('.site-url, .site-url-lbl').remove();
            var inputElements = $ele.parents('.paragraphs-subform').find('.js-text-full');
            inputElements.each(function(index){
              if (index == 0){
                $(this).val(res.title);  
              }
              if (index == 1){
                var teaser = $(this);
                $(this).val(res.teaser);
              }
              if (index == 3){
                var teaser = $(this);
                $(this).val(res.GUID);
              }
              if (index == 4){
                var teaser = $(this);
                $(this).val(res.strap_text);
              }

              //if (!$('.site-url').length) {
              var lbl = $('<label>');
              lbl.addClass('site-url-lbl');
              lbl.text("Select Site"); 
              var sel = $('<select/>');//.appendTo('body');
              sel.addClass('site-url');
              sel.append($("<option>").attr('value', 0).text('- Select Site -'));
              $.each( res.urls, function( key, value ) {
                sel.append($("<option>").attr('value', key).text(value));
              })
              var ins_loc = $(this).parents('.field--type-string-long');
              lbl.insertAfter(ins_loc);
              sel.insertAfter(lbl);//}
            })
          // }
        },
        error: function(jqXHR, data, error){
          alert("Apologies. There is some error in the system. " + error );
        }
      });
    })

    $('body').on('change', '.site-url', function(e){
      var url = $('.site-url option:selected').attr('value')
      var inputElements = $(this).parents('.paragraphs-subform').find('.js-text-full');
      //console.log(inputElements);
      inputElements.each(function(index){
        if(index == 2){
          $(this).val(url);
        }
      })
      
    });
    $('.field--name-field-newsletter-title').each(function () {
    $(this).find('input').blur(function () {
    if( $(this).val().length === 0 ) {
     $(this).parents('.field--name-field-newsletter-title').siblings('.field--name-field-site-url').find('input').val('');
  }
});});

  });
})(jQuery);

jQuery(document ).ajaxComplete(function() {
jQuery("#node-newsletter-form .field--name-field-site-url" ).each(function() {
      jQuery(this).find('input').attr('readonly', true);
    });
jQuery('.field--name-field-newsletter-title').each(function () {
    jQuery(this).find('input').blur(function () {
    if( jQuery(this).val().length === 0 ) {
     jQuery(this).parents('.field--name-field-newsletter-title').siblings('.field--name-field-site-url').find('input').val('');
  }
});});
  });

