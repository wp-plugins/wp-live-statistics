<div class="wrap">
<h2>WP Live Statistics - Online</h2>
<div class="kento-wp-stats-admin">
<script>		
	jQuery(document).ready(function()
		{

			setInterval(function(){
				jQuery.ajax(
						{
					type: 'POST',
					url: wpls_ajax.wpls_ajaxurl,
					data: {"action": "wpls_ajax_online_total"},
					success: function(data)
							{
								jQuery(".onlinecount .count").html(data);
							}
						});	
			}, 5000)
					});
			
</script>
<div class="onlinecount">

<span class="count"></span><br />
Total User Online
</div>


<script>		
	jQuery(document).ready(function()
		{

			setInterval(function(){
				jQuery.ajax(
						{
					type: 'POST',
					url: wpls_ajax.wpls_ajaxurl,
					data: {"action": "wpls_visitors_page"},
					success: function(data)
							{
								jQuery(".visitors").html(data);
							}
						});	
			}, 5000)
					});
			
</script>


<div class="visitors">
</div>


</div>



</div>
