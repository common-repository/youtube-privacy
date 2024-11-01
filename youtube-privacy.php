<?php
/*
Plugin Name: Youtube Privacy
Plugin URI: http://aldarone.fr/integrez-les-videos-youtube-en-https-et-sans-cookie-sur-votre-blog-wordpress/
Description: Ce plugin sert à intégrer les videos youtube en utilisant une iframe, le protocole HTTPS et le domaine nocookie de youtube.
Version: 1.0.1
Author: Alda Marteau-Hardi
Author URI: http://aldarone.fr/
License: GPL2
*/

wp_embed_register_handler('youtube_ssl', '#http://(?:www\.youtube\.com\/watch\?v\=|youtu\.be\/)([a-z0-9_-]+)(?:(?:(?:\?|&)(.+))|(\#t=.+))*#i', 'wp_embed_handler_youtube_ssl');

function wp_embed_handler_youtube_ssl( $matches, $attr, $url, $rawattr ) {
    $options = get_option('yp_options');
    // If the user supplied a fixed width AND height, use it

    if ( !empty($rawattr['width']) && !empty($rawattr['height']) ) {
        $width  = (int) $rawattr['width'];
        $height = (int) $rawattr['height'];
    } else {
        list( $width, $height ) = wp_expand_dimensions( 16, 9, $attr['width'], $attr['height'] );
    }

    $url        = ''.$matches[1];
    $parameters = ''.$matches[2];
    $timestamp  = ''.$matches[3];

    if ( $options['embed'] == 'iframe') {
        $embed = sprintf(
                 '<iframe style="width:%1$spx; height:%2$spx; max-width:100%;" type="text/html" src="https://www.youtube-nocookie.com/embed/%3$s?autohide=1&%4$s%5$s"></iframe>',
                 esc_attr($width),
                 esc_attr($height),
                 esc_attr($url),
                 esc_attr($parameters),
                 esc_attr($timestamp)
             );
    }
    elseif ( $options['embed'] == 'object' ) {
         $embed = sprintf(
                    '<object style="width:%1$spx; height:%2$spx; max-width:100%;" type="text/html" data="https://www.youtube-nocookie.com/embed/%3$s?autohide=1&%4$s%5$s"></object>',
                    esc_attr($width),
                    esc_attr($height),
                    esc_attr($url),
                    esc_attr($parameters),
                    esc_attr($timestamp)
                  );
    }
    else {
         $embed = __('Un probl&egrave;me est survenu');
    }
    return apply_filters('embed_youtube_ssl', $embed, $matches, $attr, $url, $rawattr);
}

// Loading the default options
add_action('admin_init', 'yp_default_option');
function yp_default_option(){
   $default_options = array(
         'embed' => 'object'
      );
   if ( ! get_option('yp_options')){
      update_option('yp_options', $default_options);
   }
}

// Option Page
include_once('yp-options.php');
?>
