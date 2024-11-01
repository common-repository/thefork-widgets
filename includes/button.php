<?php 

defined('ABSPATH') or die("Bye bye");


/*           Button page functions 
-------------------------------------------*/

add_action('wp_footer', 'tfw_write_button');


function tfw_write_button(){
    if (get_option('tfw_booking_active') == 1) {
        echo '<div class="tfw-floating-button"><a class="tfw-widget-link" href=" https://module.lafourchette.com/' . get_option('tfw_booking_language') . '/module/' . get_option('tfw_restaurantUid') . '-' . tfw_get_the_hash() . '" target="_blank" rel="noopener">' . tfw_get_button_text() . '</a></div>';
    }
}


function tfw_get_button_text(){

    $lang = get_option('tfw_booking_language');

    $textVal='';

    if(strpos($lang, 'es_') !== false) {
        $textVal='Reserva una mesa';

    } else if(strpos($lang, 'it_') !== false) {
        $textVal='Prenota un tavolo';

    } else if(strpos($lang, 'en_') !== false) {
        $textVal='Reserve a table';

    }else if(strpos($lang, 'sv_') !== false) {
        $textVal='Boka bord';

    }else if(strpos($lang, 'nl_') !== false) {
        $textVal='Reserveer een tafel';

    }else if(strpos($lang, 'pt_') !== false) {
        $textVal='Reservar uma mesa';

    }else if(strpos($lang, 'de_') !== false) {
        $textVal='Tisch reservieren';

    }else if(strpos($lang, 'fr_') !== false) {
        $textVal='Réserver une table';

    }else{
        $textVal='Reserve a table';

    }
    return $textVal;
}

function tfw_get_the_hash() {
    $userUID= get_option('tfw_restaurantUid');
    $source= "CESHTMOTW".$userUID;
    $clave=md5($source);
    return substr($clave, 0, 5);
}



