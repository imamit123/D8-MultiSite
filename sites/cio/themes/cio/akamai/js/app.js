jQuery(window).on('load', function () {
	jQuery('body').toggleClass('loader');
	jQuery('.section-1').addClass('active qus1-wrap').find('.qus1').addClass('active animated pulse');
});
// Add business email validator
jQuery.formUtils.addValidator({
    name : 'businessEmail',
    validatorFunction : function(value, $el, config, language, $form) {
if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value))  
		{
		var enteredEmailDomain=value.split('@')[1].split('.')[0].toLowerCase();
		var commonProviders=["aol", "gmail", "hotmail", "yahoo", "email", "ymail", "live", "msn", "rediff", "rediffmail", "outlook", "rocketmail"];
		return commonProviders.indexOf(enteredEmailDomain)==-1;
	}else{return false;}
    },
    errorMessage : 'You have not entered the Business Email',
    errorMessageKey: 'businessEmailNotEntered'
});

// Initiate form validation
    jQuery.validate();

// Score calculation
var $curSection, $curQus, $curAns, qusTimer;

var scoreHandler=function() {
	$curSection = jQuery(this).parents('.page');
	$curQus = jQuery(this).parents('.qus');
	$curAns = $curQus.find('input:checked');
	var $curAnsType = $curAns.prop('type');
	
	//console.log($curQus.data('qus'), $curQus.data('ans'), $curQus.data('score'))
	var $lastActivePagination=jQuery('.page.active:last .ak-pagination');
	var $lastActiveQus=jQuery('.'+jQuery('.page.active:last .ak-pagination li.done:last').data('rel'));
	//console.log($curQus.is($lastActiveQus),$curQus,$lastActiveQus);
	if(jQuery(this).is('.li-btn a')){
		jQuery(this).hide();
	}
	if($curAnsType=="checkbox"){
		var $curQusTotalScore=0;
		$curQus.find("input:checked").each(function(){
			$curQusTotalScore+=$(this).data('score');
		});
		$curQus.data('score', $curQusTotalScore);
		//console.log($curQusTotalScore);
		var ansIDs = $curQus.find("input[type='checkbox']:checked")
	  .map(function() {
		return this.id;
	  })
	  .get()
	  .join();
		$curQus.data('ans', ansIDs);
		var ansVals = $curQus.find("input[type='checkbox']:checked")
			  .map(function() {
				return jQuery("label[for='"+this.id+"']").text();
			  })
			  .get()
			  .join();
		
		$curQus.data('ansVal', ansVals);
		
		//console.log($curQusTotalScore,ansIDs,ansVals);
		
		//var $curAnsSkipTimer=1500;
	}
	else{
		$curQus.data('score', $curAns.data('score'));
		
		$curQus.data('ans', $curAns.attr('id'));
		$curQus.data('ansVal', jQuery("label[for='"+$curAns.attr('id')+"']").text());
		//var $curAnsSkipTimer=500;
	}
			
	//console.log($curAnsType,$curAnsSkipTimer);
	clearTimeout(qusTimer);
	qusTimer=setTimeout(function() {
	if ($curQus.find("input:checked").length) {
			if($curQus.is($lastActiveQus)){
				if ($curQus.next('.qus').length) {
					$lastActivePagination.find('.num').eq($lastActiveQus.index()-1).parent('li').removeClass('active');
					$lastActivePagination.find('.num').eq($lastActiveQus.index()).parent('li').removeClass('progress').delay(10).queue(function(){
						$(this).addClass('progress done active').dequeue();
					});
				}else{
					//$lastActivePagination.find('li.last').eq($lastActiveQus.index()-1).parent('li').removeClass('active');
					$lastActivePagination.find('li.last').removeClass('progress').delay(10).queue(function(){
						$(this).addClass('progress').dequeue();
						$curSection.find('.cable').addClass('play');
					});
				}
			}
			$curQus.trigger("qusChange");
		}
	}, 500);
	//}, $curAnsSkipTimer);
			
	var totalQus=jQuery('.qus').length;
	var totalAnsedQus=jQuery('.qus').filter(function( index ) { return $( this ).data( "ansVal" ); }).length;
	if(totalQus==totalAnsedQus){jQuery('.btn.Submit').removeClass('disable')}
		//console.log(totalQus,totalAnsedQus);
	}
	jQuery('.page .li-btn a').on('click', scoreHandler);
	jQuery('.page input[type="radio"],.qus11 input[type="checkbox"]').on('change', scoreHandler);

	// Checkbox validation
		jQuery('.page input[type="checkbox"]').on('change', function(){
			if(jQuery(this).hasClass('noneOf')){
				var uncheckedEl=$curQus.find("input[type='checkbox']:not(.noneOf)");
				}else{
				var uncheckedEl=$curQus.find("input[type='checkbox'].noneOf");
					}
				uncheckedEl.prop('checked',false);
			
			if ($curQus.find("input:checked").length) {$
				curQus.find('.error-wrap').text('').removeClass('has-error');
			}
			else{
				jQuery(this).prop('checked',true);
				$curQus.find('.error-wrap').text($curQus.find("input:first").data('validationErrorMsg')).addClass('has-error').delay( 2000 ).fadeOut( 500, function() {
					$curQus.find('.error-wrap').text('').show();
				});																									   
			}
		});


		// Transfer to another section and qus
		var $animateEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
		var $prevQusAnimation = 'active animated fadeOutDown';
		var $nextQusAnimation = 'active animated pulse';
		var $curVisual, $prvQus;
		jQuery('.qus').one('qusChange', function() {
			
			$prvQus=$curQus;

			if ($curQus.next('.qus').length) {
				//$curQus.removeClass('active').next('.qus').addClass('active')
				$curQus.addClass($prevQusAnimation).one($animateEnd, function() {
					$curVisual=$curSection.find('.visual');
					$curQus=$curQus.next('.qus');
					$curSection.addClass($curQus.data('qus')+'-wrap').removeClass($prvQus.data('qus')+'-wrap').data('wrapClass',$curQus.data('qus')+'-wrap');
					var $curVisualNextAni=$curQus.data('qus')+'-ani';
					
					$curVisual.removeClass($curVisual.data('prevClass')).addClass($curVisualNextAni).data('prevClass',$curVisualNextAni);
					$(this).removeClass($prevQusAnimation + ' pulse').next('.qus').addClass($nextQusAnimation).one($animateEnd, function() {$(this).removeClass(' animated pulse');});
					//console.log(jQuery('.page.active:last .qus.active').index());
					//jQuery('.page.active:last .ak-pagination .num').eq(jQuery('.page.active:last .qus.active').index()-1).parent('li').addClass('progress active');
				});
			} else if ($curSection.next('.page').length) {
				var $nextSection = $curSection.next('.page');
				$curVisual=$nextSection.find('.visual');
				$curQus=$nextSection.find('.qus:first');
				$nextSection.addClass($curQus.data('qus')+'-wrap').data('wrapClass',$curQus.data('qus')+'-wrap');;
				var $curVisualNextAni=$nextSection.find('.qus:first').data('qus')+'-ani';
				
				$curVisual.removeClass($curVisual.data('prevClass')).addClass($curVisualNextAni).data('prevClass',$curVisualNextAni);
				$nextSection.addClass('active');
				$curQus.addClass($nextQusAnimation);
				//console.log(jQuery('.page.active:last .qus.active').index());
				jQuery('.page.active:last .ak-pagination li.first').addClass('progress').next('li').addClass('progress done active');
				var $nextSectionTop = $nextSection.offset().top-175;
				if(jQuery(window).width()<768){ $nextSectionTop = $nextSection.offset().top;}
				$('html,body').animate({
					scrollTop: $nextSectionTop
				},2000);
			}
			
			
			
			//jQuery('.page.active:last .ak-pagination li').eq(jQuery('.page.active:last .qus.active').index()).addClass('active');

		});
		
		
		// Pagination for each Qus.
		jQuery('.page .ak-pagination ul').on('click','li.done:not(.active)',function(){
			jQuery(this).parent().find('li').removeClass('active');
			jQuery(this).addClass('active');
			jQuery(this).parents('.page').find('.qus').removeClass('active');
			jQuery('.'+jQuery(this).data('rel')).addClass('active');
			
			var $prvQusWrapClass=jQuery(this).parents('.page').data('wrapClass');
			$curQus=jQuery('.'+jQuery(this).data('rel'));
			$curVisual=jQuery(this).parents('.page').find('.visual');
			jQuery(this).parents('.page').addClass($curQus.data('qus')+'-wrap').data('wrapClass',$curQus.data('qus')+'-wrap').removeClass($prvQusWrapClass);
			var $curVisualNextAni=$curQus.data('qus')+'-ani';
					
			$curVisual.removeClass($curVisual.data('prevClass')).addClass($curVisualNextAni).data('prevClass',$curVisualNextAni);
			
		});


		jQuery('select').on('change',function(){ if($(this).hasClass('error')){$(this).blur()}; }).wrap('<div class="input_select"></div>');


		


		// Survey form submission
		jQuery('.btn.Submit:not(.disable)').on('click',function(){
			if (jQuery('.has-error').length==0){
				
				var $stage,$totalScore=0;
				
				$('.qus').each(function(){
					$totalScore+=$(this).data('score');
				});
				jQuery('#total_score').val($totalScore);
				
				if($totalScore<75){
						  $stage='High';
					  }else if($totalScore<=89){
						  $stage='Medium';
					  }else if($totalScore>=90){
						  $stage='Low';
					  }
				jQuery('#user_stage').val($stage);
				jQuery('.stage-txt').text($stage);
				
				
				$('.survey-wrap').hide();
				$('html,body').scrollTop(0);
				$('.user-info-wrap').show();

            }
			return false;
		}).addClass('disable');

// Download Report submission
jQuery('.download.btn').on('click',function(){
  if (jQuery('#fsi_survey').isValid()) {
	  /*var _ajaxWFURL = "reports/wufoo/create.php"; */
	  $.ajax({
		url : "/sendemail.php",
		type: "POST",
		dataType: "json",
		data: $('form').serialize(),						 
		success: function(data){
			data=JSON.parse(data);
			if (data.Success){
				window.location.href = "/sendemail.php";
			}
		}
	});
	  
	  window.location.href = "/sendemail.php";
	  
  }
  return false;
});