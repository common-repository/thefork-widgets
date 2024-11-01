<?php

defined('ABSPATH') or die("Bye bye");


/*    Register Shortcode
------------------------------------------ ---------------------*/ 
function tfw_shortcode_init(){
		add_shortcode( 'tfw-iframe', 'tfw_show_iframe_callback');

}
add_action( 'init', 'tfw_shortcode_init');

/*   Shortcode callback
---------------------------------------------------------------*/
function tfw_show_iframe_callback($atts){
    
    $theHash="";
	
	extract( shortcode_atts(
			array(
				'lang'		=> '',
				'uid'		=> ''
			),
			$atts,
			'tfw-iframe'
		) );


    $strMD5 = md5("CESHTMOTW".$uid);
    $theHash= substr($strMD5, 0, 5);
    $output = ' <iframe class="tfw-widget-iframe" src="https://module.lafourchette.com/'.$lang.'/module/'.$uid.'-'.$theHash.' " ></iframe>';
	return $output;

}






