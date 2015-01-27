<?php
/*
Plugin Name: WP Live Statistics
Plugin URI: 
Description: 
Version: 1.2
Author: paratheme
Author URI: http://paratheme.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

require_once( plugin_dir_path( __FILE__ ) . 'includes/Browser.php');
require_once( plugin_dir_path( __FILE__ ) . 'includes/geoplugin.class.php');
require_once( plugin_dir_path( __FILE__ ) . 'includes/wpls-functions.php');
require_once( plugin_dir_path( __FILE__ ) . 'includes/wpls-functions-top-query.php');
require_once( plugin_dir_path( __FILE__ ) . 'includes/wpls-shortcodes.php');



define('wpls_plugin_url', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
define('wpls_plugin_dir', plugin_dir_path( __FILE__ ) );
define('wpls_wp_url', 'http://wordpress.org/plugins/wp-live-statistics/' );
define('wpls_pro_url', '' );
define('wpls_demo_url', '' );
define('wpls_conatct_url', 'http://paratheme.com/contact' );
define('wpls_qa_url', 'http://paratheme.com/qa' );
define('wpls_plugin_name', 'WP Live Statistics' );
define('wpls_share_url', 'http://wordpress.org/plugins/wp-live-statistics/' );



function wpls_init_scripts()
	{
		wp_enqueue_script('jquery');

		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_style('wp-live-statistics-style', wpls_plugin_url.'css/style.css');
		wp_enqueue_style('wp-live-statistics-flags', wpls_plugin_url.'css/flags.css');
		wp_enqueue_script('wp-live-statistics-js', plugins_url( '/js/scripts.js' , __FILE__ ) , array( 'jquery' ));
		wp_localize_script( 'wp-live-statistics-js', 'wpls_ajax', array( 'wpls_ajaxurl' => admin_url( 'admin-ajax.php')));
		wp_enqueue_style('jquery-ui', wpls_plugin_url.'css/jquery-ui.css');
		
		//ParaAdmin
		wp_enqueue_style('ParaAdmin', wpls_plugin_url.'ParaAdmin/css/ParaAdmin.css');
		wp_enqueue_style('ParaIcons', wpls_plugin_url.'ParaAdmin/css/ParaIcons.css');		
		wp_enqueue_script('ParaAdmin', plugins_url( 'ParaAdmin/js/ParaAdmin.js' , __FILE__ ) , array( 'jquery' ));
		
		
		//jquery.jqplot
		wp_enqueue_style('jquery.jqplot', wpls_plugin_url.'css/jquery.jqplot.css');		
		wp_enqueue_script('jquery.jqplot.min', plugins_url( 'js/jquery.jqplot.min.js' , __FILE__ ) , array( 'jquery' ));		
		
		wp_enqueue_script('jqplot.pieRenderer.min', plugins_url( 'js/jqplot.pieRenderer.min.js' , __FILE__ ) , array( 'jquery' ));		
		wp_enqueue_script('jqplot.highlighter.min', plugins_url( 'js/jqplot.highlighter.min.js' , __FILE__ ) , array( 'jquery' ));					
		wp_enqueue_script('jqplot.enhancedLegendRenderer.min', plugins_url( 'js/jqplot.enhancedLegendRenderer.min.js' , __FILE__ ) , array( 'jquery' ));			
		
		wp_enqueue_script('jqplot.dateAxisRenderer.min', plugins_url( 'js/jqplot.dateAxisRenderer.min.js' , __FILE__ ) , array( 'jquery' ));			
		
		wp_enqueue_script('jqplot.canvasTextRenderer.min', plugins_url( 'js/jqplot.canvasTextRenderer.min.js' , __FILE__ ) , array( 'jquery' ));			
				
		wp_enqueue_script('jqplot.canvasAxisTickRenderer.min', plugins_url( 'js/jqplot.canvasAxisTickRenderer.min.js' , __FILE__ ) , array( 'jquery' ));		
		
		wp_enqueue_script('jqplot.canvasAxisLabelRenderer.min', plugins_url( 'js/jqplot.canvasAxisLabelRenderer.min.js' , __FILE__ ) , array( 'jquery' ));			
				
	}
add_action("init","wpls_init_scripts");







register_activation_hook(__FILE__, 'wpls_install');
register_uninstall_hook(__FILE__, 'wpls_uninstall');


function wpls_uninstall()
	{

		$wpls_delete_data = get_option( 'wpls_delete_data' );
		
		
		if($wpls_delete_data=='yes')
			{	
		
				global $wpdb;
				$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}wpls" );
				$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}wpls_online" );
				
				delete_option( 'wpls_version' );
				delete_option( 'wpls_delete_data' );
				delete_option( 'wpls_customer_type' );
			}
		

		
		

		
	}
	
	
	
function wpls_install()
	{
		
		global $wpdb;
		
        $sql = "CREATE TABLE IF NOT EXISTS " . $wpdb->prefix . "wpls"
                 ."( UNIQUE KEY id (id),
					id int(100) NOT NULL AUTO_INCREMENT,
					session_id	VARCHAR( 255 )	NOT NULL,
					wpls_date	DATE NOT NULL,
					wpls_time	TIME NOT NULL,
					wpls_endtime	TIME NOT NULL,
					userid	VARCHAR( 50 )	NOT NULL,
					event	VARCHAR( 50 )	NOT NULL,
					browser	VARCHAR( 50 )	NOT NULL,
					platform	VARCHAR( 50 )	NOT NULL,
					ip	VARCHAR( 20 )	NOT NULL,
					city	VARCHAR( 50 )	NOT NULL,
					region	VARCHAR( 50 )	NOT NULL,
					countryName	VARCHAR( 50 )	NOT NULL,
					url_id	VARCHAR( 255 )	NOT NULL,
					url_term	VARCHAR( 255 )	NOT NULL,
					referer_doamin	VARCHAR( 255 )	NOT NULL,
					referer_url	TEXT NOT NULL,
					screensize	VARCHAR( 50 ) NOT NULL,
					isunique	VARCHAR( 50 ) NOT NULL,
					landing	VARCHAR( 10 ) NOT NULL

					)";
		$wpdb->query($sql);
		
		
		
        $sql2 = "CREATE TABLE IF NOT EXISTS " . $wpdb->prefix . "wpls_online"
                 ."( UNIQUE KEY id (id),
					id int(100) NOT NULL AUTO_INCREMENT,
					session_id VARCHAR( 255 ) NOT NULL,
					wpls_time  DATETIME NOT NULL,
					userid	VARCHAR( 50 )	NOT NULL,
					url_id	VARCHAR( 255 )	NOT NULL,
					url_term	VARCHAR( 255 )	NOT NULL,
					city	VARCHAR( 50 )	NOT NULL,
					region	VARCHAR( 50 )	NOT NULL,
					countryName	VARCHAR( 50 )	NOT NULL,
					browser	VARCHAR( 50 )	NOT NULL,
					platform	VARCHAR( 50 )	NOT NULL,
					referer_doamin	VARCHAR( 255 )	NOT NULL,
					referer_url	TEXT NOT NULL
					)";
		$wpdb->query($sql2);
		

		$wpls_version= "1.2";
		update_option('wpls_version', $wpls_version); //update plugin version.
		
		$wpls_customer_type= "free"; //customer_type "free"
		update_option('wpls_customer_type', $wpls_customer_type); //update plugin customer type.



		}



function wpls_visit()
	{
		
	// date time data
	$wpls_date = wpls_get_date();
	$wpls_time = wpls_get_time();
	$wpls_datetime = wpls_get_datetime();	
	$wpls_endtime = $wpls_datetime;
	
	//device data
	$browser = new Browser_wpls();
	$platform = $browser->getPlatform();
	$browser = $browser->getBrowser();
	$screensize = wpls_get_screensize();
	
	// geo data
	$ip = $_SERVER['REMOTE_ADDR'];
	$geoplugin = new geoPlugin();
	$geoplugin->locate();
	$city = $geoplugin->city;
	$region = $geoplugin->region;
	$countryName = $geoplugin->countryCode;

	//referer data
	$referer = wpls_get_referer();
	$referer = explode(',',$referer);
	$referer_doamin = $referer['0'];
	$referer_url = $referer['1'];


	// url and page data
	$userid = wpls_getuser();
	$url_id_array = wpls_geturl_id();
	$url_id_array = explode(',',$url_id_array);
	$url_id = $url_id_array['0'];
	$url_term = $url_id_array['1'];
	
	$event = "visit";
	
	$isunique = wpls_get_unique();
	$landing = wpls_landing();
	$wpls_session_id = wpls_session();
	
	
	global $wpdb;
	$table = $wpdb->prefix . "wpls";
		
	$wpdb->query( $wpdb->prepare("INSERT INTO $table 
								( id, session_id, wpls_date, wpls_time, wpls_endtime, userid, event, browser, platform, ip, city, region, countryName, url_id, url_term, referer_doamin, referer_url, screensize, isunique, landing )
			VALUES	( %d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s )",
						array	( '', $wpls_session_id, $wpls_date, $wpls_time, $wpls_endtime, $userid, $event, $browser, $platform, $ip, $city, $region, $countryName, $url_id, $url_term, $referer_doamin, $referer_url, $screensize, $isunique, $landing )
								));
		
		


$table = $wpdb->prefix . "wpls_online";	
$result = $wpdb->get_results("SELECT * FROM $table WHERE session_id='$wpls_session_id'", ARRAY_A);
$count = $wpdb->num_rows;


 

	if($count==NULL)
		{
			$wpdb->query( $wpdb->prepare("INSERT INTO $table 
								( id, session_id, wpls_time, userid, url_id, url_term, city, region, countryName, browser, platform, referer_doamin, referer_url) VALUES	(%d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
							array( '', $wpls_session_id, $wpls_datetime, $userid, $url_id, $url_term, $city, $region, $countryName, $browser, $platform, $referer_doamin, $referer_url)
								));
		}
	else
		{
			$wpdb->query("UPDATE $table SET wpls_time='$wpls_datetime', url_id='$url_id', referer_doamin='$referer_doamin', referer_url='$referer_url' WHERE session_id='$wpls_session_id'");
		}


					
	}

add_action('wp_head', 'wpls_visit');




// trace login email
function login_with_email_address($username) {
        $user = get_user_by('email',$username);
        if(!empty($user->user_login))
                $username = $user->user_login;
        return $username;
}
add_action('wp_authenticate','login_with_email_address');

function change_username_wps_text($text){
       if(in_array($GLOBALS['pagenow'], array('wp-login.php'))){
         if ($text == 'Username'){$text = 'Username / Email';}
            }
                return $text;
         }
add_filter( 'gettext', 'change_username_wps_text' );

















add_action('admin_init', 'wpls_options_init' );
add_action('admin_menu', 'wpls_menu_init');


function wpls_options_init(){
	register_setting('wpls_options', 'wpls_version');
	register_setting('wpls_options', 'wpls_customer_type');	
	register_setting('wpls_options', 'wpls_delete_data');

    }

function wpls_settings(){
	include('wpls-settings.php');
	}
	
	
function wpls_dashboard(){
	include('wpls-dashboard.php');
	}
		
	
	
function wpls_admin_online(){
	include('wpls-admin-online.php');
	}

function wpls_admin_visitors(){
	include('wpls-admin-visitors.php');
	}

function wpls_admin_geo(){
	include('wpls-admin-geo.php');
	}

function wpls_admin_filter(){
	include('wpls-admin-filter.php');
	}




function wpls_menu_init() {





	add_menu_page(__('WP Live Stats - Settings','wpls'), __('WP Live Stats','wpls'), 'manage_options', 'wpls_settings', 'wpls_settings');

	add_submenu_page('wpls_settings', __('WPLS Dashboard','menu-wpls'), __('Dashboard','menu-wpls'), 'manage_options', 'wpls_dashboard', 'wpls_dashboard');


	add_submenu_page('wpls_settings', __('Live Visitors','menu-wpls'), __('Live Visitors','menu-wpls'), 'manage_options', 'wpls_admin_online', 'wpls_admin_online');
	
	add_submenu_page('wpls_settings', __('Visitors','menu-wpls'), __('Visitors','menu-wpls'), 'manage_options', 'wpls_admin_visitors', 'wpls_admin_visitors');	
	
	//add_submenu_page('wpls_settings', __('Top Geo','menu-wpls'), __('Top Geo','menu-wpls'), 'manage_options', 'wpls_admin_geo', 'wpls_admin_geo');
	
	add_submenu_page('wpls_settings', __('Filter','menu-wpls'), __('Filter Stats','menu-wpls'), 'manage_options', 'wpls_admin_filter', 'wpls_admin_filter');		
		
	
}

?>