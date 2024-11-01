<?php
add_action('admin_menu', 'yp_menu');

function yp_menu(){
   add_options_page(
      'Youtube Privacy options',
      'Youtube Privacy',
      'manage_options',
      'youtube-privacy',
      'yp_options_page'
   );
}

function yp_options_page(){
   if (!current_user_can('manage_options'))  {
      wp_die( __('You do not have sufficient permissions to access this page.') );
   }
   echo '<div class="wrap">
         <h2>Youtube Privacy</h2>
         <form method="post" action="options.php">';
   settings_fields('yp_options');
   do_settings_sections('youtube-privacy');
   echo '<p class="submit">
         <input type="submit" class="button-primary" value="'. __('Save Changes') .'" />
         </p>
         </form>
         </div>';
}

add_action('admin_init', 'yp_admin_init');
function yp_admin_init(){
   register_setting('yp_options', 'yp_options', 'yp_options_validate');

   add_settings_section('yp_main', 'Main Settings', 'yp_main_text', 'youtube-privacy' );
   add_settings_field('yp_embed', 'Choose how the video will be displayed', 'yp_embed_setting', 'youtube-privacy', 'yp_main');
}

function yp_embed_setting(){
   $options = get_option('yp_options');
   if ($options['embed']=='iframe'){
      $embed = array('iframe' => 'selected', 'object' => '');
   }
   else {
      $embed = array('iframe' => '', 'object' => 'selected');
   }
   echo '<select id="yp_embed" name="yp_options[embed]">';
   echo '   <option value="iframe" '.$embed['iframe'].'>iframe</option>';
   echo '   <option value="object" '.$embed['object'].'>object</option>';
   echo '</select>';
   _e(  'Choose iframe if you need to ensure iPhone compatibility. Otherwise choose object');
}


function yp_options_validate($input){
  return $input;
}

?>
