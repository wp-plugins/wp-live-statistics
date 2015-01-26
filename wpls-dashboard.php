<div class="wrap">
    <div class="para-settings">
        <div class="para-dashboard">
        	<div class="dash-box">
                <div class="dash-box-title"><span class="para-icons user-crowd">Visitor Online</span></div>
                <div class="dash-box-info">Estimate total visitor online right now on your website. <?php echo wpls_get_datetime(); ?></div>
                <div class="total-online">0</div>
                
                
                
				<?php
                    $wpls_refresh_time = get_option( 'wpls_refresh_time' );	
                    
                    if(!empty($wpls_refresh_time))
                        {
                            if($wpls_refresh_time < 3000)
                                {
                                    $wpls_refresh_time = '3000';
                                }
                            else
                                {
                                $wpls_refresh_time = $wpls_refresh_time;
                                }
                            
                        }
                    else
                        {
                            $wpls_refresh_time = '3000';
                        }
                
                ?>

				<script>		
                    jQuery(document).ready(function($)
                        {
                
                            setInterval(function(){
                                $.ajax(
                                        {
                                    type: 'POST',
                                    url: wpls_ajax.wpls_ajaxurl,
                                    data: {"action": "wpls_ajax_online_total"},
                                    success: function(data)
                                            {
                                                $(".total-online").html(data);
                                            }
                                        });	
                            }, <?php echo $wpls_refresh_time; ?>)
                                    });
                            
                </script> 
                
         
            </div>
            
            
            
            
            
            
			<div class="dash-box">
                <div class="dash-box-title"><span class="para-icons user-crowd">Total Visitor</span></div>
                <div class="dash-box-info">Estimate total visitor session. </div>
                <div class="total-session"><?php echo wpls_TotalSession("session_id"); ?></div>
            </div>  
            
            
			<div class="dash-box">
                <div class="dash-box-title"><span class="para-icons user-crowd">Unique Visitor</span></div>
                <div class="dash-box-info">Estimate unique visitor. </div>
                <div class="unique-visitor"><?php echo wpls_UniqueVisitor("ip"); ?></div>
            </div>  
            
			<div class="dash-box">
                <div class="dash-box-title"><span class="para-icons user-crowd">Unique Page View</span></div>
                <div class="dash-box-info">Estimate unique page view. </div>
                <div class="unique-visitor"><?php echo wpls_UniquePageView("isunique"); ?></div>
            </div>              
            
            
            
            
            
        	<div class="dash-box">
            	<div class="dash-box-title"><span class="para-icons os-windows">Top OS</span></div>
            	<div class="dash-box-info">Stats based on top operating system.</div>
            
            <div id="TopOS" style="height:350px;width:100%; "></div>
            <script>
				jQuery(document).ready(function($){
				  var data =
				  			[
								<?php echo wpls_TopOS("platform"); ?>
							];
							
				  var TopOS = $.jqplot ('TopOS', [data],
					{

					  	seriesDefaults: {
						// Make this a pie chart.

						shadow:false,
						renderer: $.jqplot.PieRenderer,
						rendererOptions: {
							showDataLabels: true,
						  // Put data labels on the pie slices.
						  // By default, labels show the percentage of the slice.

						}
					  },
					  
						highlighter: {
							show: true,
							sizeAdjust: 1,
							tooltipOffset: 9
						},
					  
					  legend: {
							show:true,
							location: 's',
							renderer: $.jqplot.EnhancedLegendRenderer,
							rendererOptions:
								{
								numberColumns: 3,
								disableIEFading: false,
								border: 'none',
								},
							},
						grid: {
							background: 'transparent',
							borderWidth: 0,
							shadow: false,
							
							},
						highlighter: {show: true,formatString:'%s',tooltipLocation:'n',useAxesFormatters:false,},
							
					}
				  );

				  
				});
			</script>
            
            
            </div>
            
        	<div class="dash-box">
            <div class="dash-box-title"><span class="para-icons device-monitor">Top Screen Size</span></div>
            <div class="dash-box-info">Top device screen size.</div>
            <div id="TopScreenSize" style="height:350px;width:100%; "></div>
            
            <script>
				jQuery(document).ready(function($){
				  var data =
				  			[
								<?php echo wpls_TopScreenSize("screensize"); ?>
							];
							
				  var TopOS = $.jqplot ('TopScreenSize', [data],
					{




					  	seriesDefaults: {
						// Make this a pie chart.

						shadow:false,
						renderer: $.jqplot.PieRenderer,
						rendererOptions: {
							showDataLabels: true,
						  // Put data labels on the pie slices.
						  // By default, labels show the percentage of the slice.

						}
					  },
					  
						highlighter: {
							show: true,
							sizeAdjust: 1,
							tooltipOffset: 9
						},
					  
					  legend: {
							show:true,
							location: 's',
							renderer: $.jqplot.EnhancedLegendRenderer,
							rendererOptions:
								{
								numberColumns: 3,
								disableIEFading: false,
								border: 'none',
								},
							},
						grid: {
							background: 'transparent',
							borderWidth: 0,
							shadow: false,
							
							},
						highlighter: {show: true,formatString:'%s',tooltipLocation:'n',useAxesFormatters:false,},
							
					}
				  );

				  
				});
			</script>
            
           
            
            </div>            
            
            
        	<div class="dash-box">
            <div class="dash-box-title"><span class="para-icons browser-firefox">Top Browsers</span></div>
            <div class="dash-box-info">Top broswer by view count.</div>
            <div id="TopBrowsers" style="height:350px;width:100%; "></div>
            
            <script>
				jQuery(document).ready(function($){
				  var data =
				  			[
								<?php echo wpls_TopBrowsers("browser"); ?>
							];
							
				  var TopOS = $.jqplot ('TopBrowsers', [data],
					{




					  	seriesDefaults: {
						// Make this a pie chart.

						shadow:false,
						renderer: $.jqplot.PieRenderer,
						rendererOptions: {
							showDataLabels: true,
						  // Put data labels on the pie slices.
						  // By default, labels show the percentage of the slice.

						}
					  },
					  
						highlighter: {
							show: true,
							sizeAdjust: 1,
							tooltipOffset: 9
						},
					  
					  legend: {
							show:true,
							location: 's',
							renderer: $.jqplot.EnhancedLegendRenderer,
							rendererOptions:
								{
								numberColumns: 3,
								disableIEFading: false,
								border: 'none',
								},
							},
						grid: {
							background: 'transparent',
							borderWidth: 0,
							shadow: false,
							
							},
						highlighter: {show: true,formatString:'%s',tooltipLocation:'n',useAxesFormatters:false,},
							
					}
				  );

				  
				});
			</script>
            
           
            
            </div>
            
        	<div class="dash-box">
            <div class="dash-box-title"><span class="para-icons page">Top Page Terms</span></div>
            <div class="dash-box-info">Top link category.</div>
            <div id="TopPageTerms" style="height:350px;width:100%; "></div>
            
            <script>
				jQuery(document).ready(function($){
				  var data =
				  			[
								<?php echo wpls_TopPageTerms("url_term"); ?>
							];
							
				  var TopOS = $.jqplot ('TopPageTerms', [data],
					{




					  	seriesDefaults: {
						// Make this a pie chart.

						shadow:false,
						renderer: $.jqplot.PieRenderer,
						rendererOptions: {
							showDataLabels: true,
						  // Put data labels on the pie slices.
						  // By default, labels show the percentage of the slice.

						}
					  },
					  
						highlighter: {
							show: true,
							sizeAdjust: 1,
							tooltipOffset: 9
						},
					  
					  legend: {
							show:true,
							location: 's',
							renderer: $.jqplot.EnhancedLegendRenderer,
							rendererOptions:
								{
								numberColumns: 3,
								disableIEFading: false,
								border: 'none',
								},
							},
						grid: {
							background: 'transparent',
							borderWidth: 0,
							shadow: false,
							
							},
						highlighter: {show: true,formatString:'%s',tooltipLocation:'n',useAxesFormatters:false,},
							
					}
				  );

				  
				});
			</script>
            
            </div>            
            
            
        	<div class="dash-box">
            <div class="dash-box-title"><span class="para-icons globe">Top Countries</span></div>
            <div class="dash-box-info">Top country by view count.</div>
            <div id="TopCountries" style="height:350px;width:100%; "></div>
            
            <script>
				jQuery(document).ready(function($){
				  var data =
				  			[
							<?php echo wpls_TopCountries("countryName"); ?>
							];
							
				  var TopOS = $.jqplot ('TopCountries', [data],
					{




					  	seriesDefaults: {
						// Make this a pie chart.

						shadow:false,
						renderer: $.jqplot.PieRenderer,
						rendererOptions: {
							showDataLabels: true,
						  // Put data labels on the pie slices.
						  // By default, labels show the percentage of the slice.

						}
					  },
					  
						highlighter: {
							show: true,
							sizeAdjust: 1,
							tooltipOffset: 9
						},
					  
					  legend: {
							show:true,
							location: 's',
							renderer: $.jqplot.EnhancedLegendRenderer,
							rendererOptions:
								{
								numberColumns: 3,
								disableIEFading: false,
								border: 'none',
								},
							},
						grid: {
							background: 'transparent',
							borderWidth: 0,
							shadow: false,
							
							},
						highlighter: {show: true,formatString:'%s',tooltipLocation:'n',useAxesFormatters:false,},
							
					}
				  );

				  
				});
			</script>
            
            </div>
        	<div class="dash-box">
            <div class="dash-box-title"><span class="para-icons map-pin">Top Cities</span></div>
            <div class="dash-box-info">Top city by view count.</div>
            <div id="TopCities" style="height:350px;width:100%; "></div>
            
            <script>
				jQuery(document).ready(function($){
				  var data =
				  			[
							<?php echo wpls_TopCities("city"); ?>
							];
							
				  var TopOS = $.jqplot ('TopCities', [data],
					{




					  	seriesDefaults: {
						// Make this a pie chart.

						shadow:false,
						renderer: $.jqplot.PieRenderer,
						rendererOptions: {
							showDataLabels: true,
						  // Put data labels on the pie slices.
						  // By default, labels show the percentage of the slice.

						}
					  },
					  
						highlighter: {
							show: true,
							sizeAdjust: 1,
							tooltipOffset: 9
						},
					  
					  legend: {
							show:true,
							location: 's',
							renderer: $.jqplot.EnhancedLegendRenderer,
							rendererOptions:
								{
								numberColumns: 3,
								disableIEFading: false,
								border: 'none',
								},
							},
						grid: {
							background: 'transparent',
							borderWidth: 0,
							shadow: false,
							
							},
						highlighter: {show: true,formatString:'%s',tooltipLocation:'n',useAxesFormatters:false,},
							
					}
				  );

				  
				});
			</script>
            
            </div>   
            
        	<div class="dash-box">
            <div class="dash-box-title"><span class="para-icons share-hub">Top Referers</span></div>
            <div class="dash-box-info">Top Referer link.</div>
            <div id="TopReferers" style="height:350px;width:100%; "></div>
            
            <script>
				jQuery(document).ready(function($){
				  var data =
				  			[
							<?php echo wpls_TopReferers("referer_doamin"); ?>
							];
							
				  var TopOS = $.jqplot ('TopReferers', [data],
					{




					  	seriesDefaults: {
						// Make this a pie chart.

						shadow:false,
						renderer: $.jqplot.PieRenderer,
						rendererOptions: {
							showDataLabels: true,
						  // Put data labels on the pie slices.
						  // By default, labels show the percentage of the slice.

						}
					  },
					  
						highlighter: {
							show: true,
							sizeAdjust: 1,
							tooltipOffset: 9
						},
					  
					  legend: {
							show:true,
							location: 's',
							renderer: $.jqplot.EnhancedLegendRenderer,
							rendererOptions:
								{
								numberColumns: 3,
								disableIEFading: false,
								border: 'none',
								},
							},
						grid: {
							background: 'transparent',
							borderWidth: 0,
							shadow: false,
							
							},
						highlighter: {show: true,formatString:'%s',tooltipLocation:'n',useAxesFormatters:false,},
							
					}
				  );

				  
				});
			</script>
            
            </div>
        	<div class="dash-box">
                <div class="dash-box-title"><span class="para-icons page">Top Pages</span></div>
                <div class="dash-box-info">Top page list by view count.</div>
                <?php echo wpls_TopPages("url_id"); ?>
            </div>
            
        	<div class="dash-box">
            <div class="dash-box-title"><span class="para-icons user-group">Top User</span></div>
            <div class="dash-box-info">Top active user(by id) on your site.</div>
            <div id="TopUser" style="height:350px;width:100%; "></div>
            
            <script>
				jQuery(document).ready(function($){
				  var data =
				  			[
							<?php echo wpls_TopUser("userid"); ?>
							];
							
				  var TopOS = $.jqplot ('TopUser', [data],
					{




					  	seriesDefaults: {
						// Make this a pie chart.

						shadow:false,
						renderer: $.jqplot.PieRenderer,
						rendererOptions: {
							showDataLabels: true,
						  // Put data labels on the pie slices.
						  // By default, labels show the percentage of the slice.

						}
					  },
					  
						highlighter: {
							show: true,
							sizeAdjust: 1,
							tooltipOffset: 9
						},
					  
					  legend: {
							show:true,
							location: 's',
							renderer: $.jqplot.EnhancedLegendRenderer,
							rendererOptions:
								{
								numberColumns: 3,
								disableIEFading: false,
								border: 'none',
								},
							},
						grid: {
							background: 'transparent',
							borderWidth: 0,
							shadow: false,
							
							},
						highlighter: {show: true,formatString:'%s',tooltipLocation:'n',useAxesFormatters:false,},
							
					}
				  );

				  
				});
			</script>
            
            </div>
            
            
        </div> <!-- para-dashboard --> 


		
	</div> <!-- para-settings --> 	  
</div>