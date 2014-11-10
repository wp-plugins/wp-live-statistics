
jQuery(document).ready(function($)
	{






	$('a').bind('click', function(event) {
		
		//document.cookie="wpls_landing=0; path=/";
		
			//var wpls_online_count = -1;
			jQuery.ajax(
				{
			type: 'POST',
			url: wpls_ajax.wpls_ajaxurl,
			data: {"action": "wpls_offline_visitors"},
			success: function(data)
					{
						
					}
				});	    
		 //event.preventDefault();
		 //event.stopPropagation();
	});




	$(window).bind('beforeunload', function(){
		
		
		
		//document.cookie="wpls_landing=0; path=/";
		
			//var wpls_online_count = -1;
			jQuery.ajax(
				{
			type: 'POST',
			url: wpls_ajax.wpls_ajaxurl,
			data: {"action": "wpls_offline_visitors"},
			success: function(data)
					{
						
					}
		});	
			  
	});





		
		
		
		
	
});	







