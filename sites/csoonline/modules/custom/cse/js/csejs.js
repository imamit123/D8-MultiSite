/////////////Add your Js here/////////////////
(function() {
    var cx = '011633911254318926645:0p738agrta0';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);

	setTimeout(function(){ 
	var pattern = /[?]q=/;
	var url = location.search;
	if(pattern.test(url))
	{
	  var newVal = url.substring(3, url.length);
	  jQuery('.google_search_text').val(newVal);
	} }, 500);
    jQuery('.reset_google_form').click(function(){
    	jQuery('.google_search_text').val('');
    });
  })();

