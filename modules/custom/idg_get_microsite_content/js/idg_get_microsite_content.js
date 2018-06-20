(function ($) {
  'use strict';

  $(document).ready(function () {
    $('body .field--name-field-site-url').hide();
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
        data: 'node=' + $(this).val()+'&id='+$(this).attr('id')+'&type='+$news_type ,
        //on Successs update fields
        success: function(res){
          console.log(res);
          // var msg = $.parseJSON(res);
          // if (res.alert !== null){
          //   alert(res.alert);
          // }
          // else{
            //Get parent of this paragraph div paragraphs-subform
            var inputElements = $ele.parents('.paragraphs-subform').find('.js-text-full');
            inputElements.each(function(index){
              if (index == 0){
                $(this).val(res.title);  
              }
              if (index == 1){
                var teaser = $(this);
                $(this).val(res.teaser);
              }
              //Remo
              // if($('.site-url').length > 0){
                // $('.site-url, .site-url-lbl').remove();
              // }

              var lbl = $('<label>');
              lbl.addClass('site-url-lbl');
              lbl.text("Select URL"); 
              var sel = $('<select/>');//.appendTo('body');
              sel.addClass('site-url');
              sel.append($("<option>").attr('value', 0).text('- Select Site -'));
              $.each( res.urls, function( key, value ) {
                sel.append($("<option>").attr('value', key).text(value));
              })
              var ins_loc = $(this).parents('.field--type-string-long');
              lbl.insertAfter(ins_loc);
              sel.insertAfter(lbl);
            })
          // }
        },
        error: function(jqXHR, data, error){
          alert("Apologies. There is some error in the system. " + error );
        }
      });
    })

    $('body').on('blur', '.site-url', function(e){
      var url = $('.site-url option:selected').attr('value')
      var inputElements = $(this).parents('.paragraphs-subform').find('.js-text-full');
      console.log(inputElements);
      inputElements.each(function(index){
        if(index == 2){
          $(this).val(url);
        }
      })
      
    })
  });
})(jQuery);