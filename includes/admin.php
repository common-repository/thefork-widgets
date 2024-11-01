<?php
/*
Backend options
*/

defined('ABSPATH') or die("Bye bye");




/*             Register scripts
------------------------------------------ */

add_action( 'admin_enqueue_scripts', 'tfw_admin_assets' );
add_action( 'wp_enqueue_scripts', 'tfw_admin_assets' );


function tfw_admin_assets() {
         wp_register_script(
                'tfw-cript',
                plugins_url('../js/jqueryCrypt.js', __FILE__),
                array('jquery'),
                '1',
                true
        );
        wp_enqueue_script(
                'tfw-admin',
                plugins_url('../js/admin.js', __FILE__),
                array('tfw-cript', 'jquery' ),
                '1',
                true
        );

}

/*             Admin styles
------------------------------------------ */
add_action('admin_enqueue_scripts', 'tfw_admin_styles');

function tfw_admin_styles() {
          wp_enqueue_style('admin-styles',   plugins_url('../css/admin.css', __FILE__ ) );

       
}


add_action('wp_enqueue_scripts', 'tfw_view_styles');

function tfw_view_styles() {
          wp_enqueue_style('view-styles',   plugins_url('../css/view.css', __FILE__ ) );
       
}




/*             Admin menu
------------------------------------------ */

add_action('admin_menu', 'tfw_plugin_menu');

function tfw_plugin_menu() {
        add_menu_page( 'The Fork widgets', __('TheFork' , 'thefork-widgets'), 'read','plugin-options', 'tfw_plugin_options',TFW_URL.'/img/logo-thefork-white_16x16.png' );
        add_submenu_page('plugin-options', 'The Fork - Booking iframe', __('Embedded booking calendar' , 'thefork-widgets') ,'read','plugin-options','tfw_plugin_options'); // Modifico submenu para iframe
        add_submenu_page( 'plugin-options', 'The Fork - Booking button', __('Booking button' , 'thefork-widgets') , 'read', 'booking-button', 'tfw_button_admin' ); // añado submenu
        add_submenu_page('plugin-options','The Fork - Get your ID', __('Get your ID' , 'thefork-widgets') ,'read','get-id','tfw_sub_get_id_options');
}




/*           Iframe page functions 
-------------------------------------------*/

function tfw_plugin_options() {

      if (!current_user_can('edit_posts'))  {
              wp_die( __('You are not able to see this page', 'thefork-widgets' ) );
      }

    ?>
 <div class='tfw-wrap'>
          <div class='tfw-get-widget-left'>
            <h3 class=""><?php _e("How to install the widget iframe using shortcodes", 'thefork-widgets' ); ?>:</h3>
            <ul>
                <li><?php _e("- Paste your restaurant ID", 'thefork-widgets' ); ?></li>
                <li><?php _e("- Select language", 'thefork-widgets' ); ?></li>
                <li><?php _e("- Update" , 'thefork-widgets' ); ?></li>
                <li><?php _e("- Copy the shortcode" , 'thefork-widgets' ); ?></li>
                <li><?php _e("- Paste the shortcode in the page editor as many times you want" , 'thefork-widgets' ); ?></li>
            </ul><br> 

            <div class='tfw-form'>
                      <h2><?php _e("Iframe setup" , 'thefork-widgets' ); ?></h2>  
                      <table class="tfw-table">
                        <tr>
                          <td><span><?php _e("Restaurant UID: " , 'thefork-widgets' ); ?></span></td>
                          <td><input type='text' name='tfw-uidValue' id='tfw-uidValue' class="tfw-input"  pattern="^\d+$" maxlength="7" placeholder=" ex: 313711" />
</td>
                        </tr>

                      </table>
                      <table class="tfw-table">
                        <tr class="tfw-table-language"><td><span><?php _e("Country: " , 'thefork-widgets' ); ?></span></td>
                          <td>
                            <select id="tfw-lngValue" name="tfw-lngValue" class="form-control" >
                                    <!-- <option value="" class="tfw-dropdown-header">Country</option> -->
                                    <option value="de_AT" >Österreich</option> 
                                    <option value="en_AU" >Australia</option>
                                    <option value="nl_BE" >België - NL</option>
                                    <option value="fr_BE" >Belgique - FR</option>
                                    <option value="fr_CH" >Suisse - FR</option> 
                                    <option value="de_CH" >Schweiz - DE</option>
                                    <option value="de_DE" >Deutschland</option> 
                                    <option value="fr_FR" >France</option>
                                    <option value="en_GB" >England</option> 
                                    <option value="it_IT" >Italia</option>
                                    <option value="nl_NL" >Nederland</option>
                                    <option value="pt_PT" >Portugal</option>
                                    <option value="sv_SE" >Sverige</option> 
                                    <option value="en_US" >EEUU</option>
                                    <option value="es_ES" >España</option>
                          </select>
                          </td>
                        </tr>

                      </table>
                      <p class="submit">
                        <input type="button" id="tfw-submit" class="tfw-button tfw-input" value=<?php _e( "UPDATE" , 'thefork-widgets' ); ?> disabled/>
                      </p>
                      <p class="shortcode">
                          <input name="tfw-shortcode" id="tfw-shortcode" class="tfw-input" placeholder="Shortcode" />
                      </p>
              </div>           
          </div>
          <div class="tfw-preview"><h2 class="tfw-title"><?php _e("PREVIEW" , 'thefork-widgets' ); ?></h2><div id="tfw-preview"></div></div>
    </div>
                
<?php }

function tfw_sub_get_widget_options() {
     
      if (!current_user_can('edit_posts'))  {
              wp_die( __('You are not able to see this page', 'thefork-widgets' ) );
      }

    ?>
                
<?php }

/*           UID page functions 
-------------------------------------------*/
function tfw_sub_get_id_options() {

      if (!current_user_can('edit_posts'))  {
              wp_die( __('You are not able to see this page', 'thefork-widgets' ) );
      }

    ?>
    <div class='tfw-wrap'>
        <div class='tfw-get-id-left'>
          <h3 class=""><?php _e("How to locate your identification number:" , 'thefork-widgets' ); ?></h3>
          <ul>
              <li><?php _e("- Access to" , 'thefork-widgets'  ); ?> <a href="https://www.thefork.com/" target="blank">TheFork</a>.</li>
              <li><?php _e("- Search for your restaurant", 'thefork-widgets' ); ?></li>
              <li><?php _e("- Copy the number at the end of the URL inside the Restaurant´s File:" , 'thefork-widgets'); ?></li>
              <li>https://www.thefork.com/restaurant/restaurant-name-r+<b><?php _e("identification-number" , 'thefork-widgets' ); ?></b></li>
              <li><b>https://www.thefork.com/restaurant/can-luis-r56567</b></li>
                
          </ul><br>
          <p><?php _e("If you cannot find it please contact us at" , 'thefork-widgets' ); ?> <a href="https://www.theforkmanager.com/contact">theforkmanager.com/contact</a><?php _e(" to get your restaurant UID." , 'thefork-widgets' ); ?></p><p><?php _e("Find the complete documentation for your widget here: " , 'thefork-widgets' ); ?> <a target="_blank" href="https://calendarexamples.thefork.com/">https://calendarexamples.thefork.com/</a></p>           
        </div>
    </div>
                
<?php }


/*           Button page functions 
-------------------------------------------*/
function tfw_button_admin() {

// action when submit
if(
  isset($_POST['tfw_hidden']) && $_POST['tfw_hidden'] == 'Y' && 
  isset($_POST['_wpnonce']) && wp_verify_nonce( $_POST['_wpnonce'], 'update-tfw-settings' )
) {
  
  // check if user can manage options
  if (!current_user_can('manage_options'))
  {
    wp_die(__('You do not have sufficient permissions to manage options for this site.', 'thefork-widgets' ));
  }


  
  $tfw_restaurantUid = sanitize_text_field($_POST['tfw_restaurantUid']);
  update_option('tfw_restaurantUid', $tfw_restaurantUid);

  
  $tfw_booking_active = isset($_POST['tfw_booking_active']) ? 1 : 0;
  update_option('tfw_booking_active', $tfw_booking_active);
  

  $tfw_booking_language = sanitize_text_field($_POST['tfw_booking_language']);
  update_option('tfw_booking_language', $tfw_booking_language);


  ?>
  
  <div class="updated"><p><strong><?php _e('Options saved.' , 'thefork-widgets' ); ?></strong></p></div>
  
  <?php

// action by default. Values for admin form fields
} else {
  
  //Form values from options ddbb
  $tfw_restaurantUid = esc_html(get_option('tfw_restaurantUid'));
  $tfw_booking_active = esc_html(get_option('tfw_booking_active'));
  $tfw_booking_language = esc_html(get_option('tfw_booking_language'));

}

?>


<div>  
  <form class='tfw-form' name="oscimp_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
  <input class="tfw-input" type="hidden" name="tfw_hidden" value="Y">
  <?php wp_nonce_field( 'update-tfw-settings' );?>
  
  <h2><?php _e("Floating button setup" , 'thefork-widgets' ); ?></h2>

  <ul>
      <li><?php _e("- Paste your restaurant ID" , 'thefork-widgets' ); ?></li>
      <li><?php _e("- Select active in order to show or hide the button" , 'thefork-widgets' ); ?></li>
      <li><?php _e("- Select contry" , 'thefork-widgets' ); ?></li>
      <li><?php _e("- Update" , 'thefork-widgets' ); ?></li>
      <li><?php _e("- The fork floating button is now active on your website" , 'thefork-widgets' ); ?></li>
  </ul>  <br>
  <table class="tfw-table">
    <tr>
      <td><span><?php _e("Restaurant UID: " ); ?></span></td>
      <td><input class="tfw-input" placeholder="<?php _e(" ex: 313711" ); ?>" type="text" name="tfw_restaurantUid" value="<?php echo $tfw_restaurantUid; ?>" size="20"></td>
    </tr>
  </table>
    <table class="tfw-table">
      <tr class="tfw-table-active">
        <td><span><?php _e("Active: " , 'thefork-widgets' ); ?></span></td><td><input class="tfw-input" type="checkbox"  name="tfw_booking_active" value="0" <?php checked(  get_option( 'tfw_booking_active' ), '1' ); ?> ></td>
      </tr>

      <tr class="tfw-table-language"><td><span><?php _e("Country: " , 'thefork-widgets' ); ?></span></td>
        <td>
          <select name="tfw_booking_language">

            <option <?php if($tfw_booking_language == "de_AT") echo "selected"; ?> value="de_AT">Österreich</option>            
            <option <?php if($tfw_booking_language == "en_AU") echo "selected"; ?> value="en_AU">Australia</option>
            <option <?php if($tfw_booking_language == "nl_BE") echo "selected"; ?> value="nl_BE">België - NL</option>
            <option <?php if($tfw_booking_language == "fr_BE") echo "selected"; ?> value="fr_BE">Belgique - FR</option>
            <option <?php if($tfw_booking_language == "fr_CH") echo "selected"; ?> value="fr_CH">Suisse - FR</option>
            <option <?php if($tfw_booking_language == "de_CH") echo "selected"; ?> value="de_CH">Schweiz - DE</option>
            <option <?php if($tfw_booking_language == "de_DE") echo "selected"; ?> value="de_DE">Deutschland</option>
            <option <?php if($tfw_booking_language == "fr_FR") echo "selected"; ?> value="fr_FR">France</option>
            <option <?php if($tfw_booking_language == "en_GB") echo "selected"; ?> value="en_GB">England</option>
            <option <?php if($tfw_booking_language == "it_IT") echo "selected"; ?> value="it_IT">Italia</option>
            <option <?php if($tfw_booking_language == "nl_NL") echo "selected"; ?> value="nl_NL">Nederland</option>
            <option <?php if($tfw_booking_language == "pt_PT") echo "selected"; ?> value="pt_PT">Portugal</option>
            <option <?php if($tfw_booking_language == "sv_SE") echo "selected"; ?> value="sv_SE">Sverige</option>
            <option <?php if($tfw_booking_language == "en_US") echo "selected"; ?> value="en_US">EEUU</option>
            <option <?php if($tfw_booking_language == "es_ES") echo "selected"; ?> value="es_ES">España</option>
          </select>
        </td>
      </tr>

    </table>
    <p class="submit">
      <input type="submit" name="Submit"   class="tfw-button tfw-input" value=<?php _e( "UPDATE" , 'thefork-widgets' ); ?> />
    </p>

  </form>
</div>
                
<?php }


