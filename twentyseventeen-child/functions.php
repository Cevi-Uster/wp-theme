<?php
function my_theme_enqueue_styles() {

    $parent_style = 'parent-style'; // This is 'twentyseventeen-style' for the Twenty Seventeen theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',get_stylesheet_directory_uri() . '/style.css', array( $parent_style ), wp_get_theme()->get('Version'));

}

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

// Diese folgende Funktion braucht es für das Kontaktformular, damit die Empfängeradresse
// im Shortcode mitgegeben werden kann. Doku: http://bit.ly/2TZgN79
add_filter( 'shortcode_atts_wpcf7', 'custom_shortcode_atts_wpcf7_filter', 10, 3 );
function custom_shortcode_atts_wpcf7_filter( $out, $pairs, $atts ) {
    $my_attr = 'destination-email';
    if ( isset( $atts[$my_attr] ) ) {
        $out[$my_attr] = $atts[$my_attr];
    }
    return $out;
}

/* 
    Workaround for agenda bug
 
*/
add_action("wp_footer", function(){
    if(is_page('agenda')){
        echo '<script>jQuery(function($){if($("#tribe-events").length){$("#tribe-events").data("featured",1);}});</script>';
    }
 });
 

/* 
    Disable cookie warnings for pages with custom field no_cookie_warning=true
*/
 function custom_cn_cookie_notice_output($output) {

    $url = 'http://' . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'REQUEST_URI' ];
    $current_post_id = url_to_postid( $url );
    $no_cookie_warning = get_post_meta($current_post_id, 'no_cookie_warning', true);
    if (strtolower($no_cookie_warning) == "true"){
        $output = '';
    }
	return $output;
}
add_filter('cn_cookie_notice_output', 'custom_cn_cookie_notice_output')
?>
