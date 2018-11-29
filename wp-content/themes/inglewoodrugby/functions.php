<?php
require_once('modal/class.Base.php');
require_once('modal/class.Sponsor.php');
require_once('modal/class.People.php');
require_once(STYLESHEETPATH . '/includes/wordpress-tweaks.php');
loadVCTemplates();
add_action( 'wp_enqueue_scripts', 'p_enqueue_styles');
function p_enqueue_styles() {
    wp_enqueue_style( 'bootstrap-css', get_stylesheet_directory_uri() . '/css/bootstrap.min.css?' . filemtime(get_stylesheet_directory() . '/css/bootstrap.min.css'));
    wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/css/font-awesome.min.css?' . filemtime(get_stylesheet_directory() . '/css/font-awesome.css'));
    wp_enqueue_style( 'google_font_montserrat', 'https://fonts.googleapis.com/css?family=Montserrat:400,600,700');
    wp_enqueue_style( 'google_font_open_sans', 'https://fonts.googleapis.com/css?family=Open+Sans:400,600');
    wp_enqueue_style( 'google_font_rock_salt', 'https://fonts.googleapis.com/css?family=Rock+Salt');
    wp_enqueue_style( 'slick', get_stylesheet_directory_uri() . '/includes/slick-carousel/slick/slick.css');
    wp_enqueue_style( 'slick-theme', get_stylesheet_directory_uri() . '/includes/slick-carousel/slick/slick-theme.css');
    wp_enqueue_style( 'understrap-theme', get_stylesheet_directory_uri() . '/style.css?' . filemtime(get_stylesheet_directory() . '/style.css'));
    wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri() . '/js/bootstrap.min.js?' . filemtime(get_stylesheet_directory() . '/js/bootstrap.min.js'), array('jquery'));
    wp_enqueue_script('understap-theme', get_stylesheet_directory_uri() . '/js/theme.js?' . filemtime(get_stylesheet_directory() . '/js/theme.js'), array('jquery'));
    wp_enqueue_script( 'slick', get_stylesheet_directory_uri() . '/includes/slick-carousel/slick/slick.js');
}
function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_filter( 'vc_load_default_templates', 'bfe_vc_load_default_templates' ); // Hook in

add_image_size( 'banner', 2000 );
add_image_size( 'people', 400, 600, true);

add_action('admin_init', 'my_general_section');
function my_general_section() {
    add_settings_section(
        'my_settings_section', // Section ID
        'Custom Website Settings', // Section Title
        'my_section_options_callback', // Callback
        'general' // What Page?  This makes the section show up on the General Settings Page
    );

    add_settings_field( // Option 1
        'phone', // Option ID
        'Phone Number', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed (General Settings)
        'my_settings_section', // Name of our section
        array( // The $args
            'phone' // Should match Option ID
        )
    );

    add_settings_field( // Option 2
        'email', // Option ID
        'Email', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'email' // Should match Option ID
        )
    );

    add_settings_field( // Option 2
        'address', // Option ID
        'Address', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'address' // Should match Option ID
        )
    );

    add_settings_field( // Option 2
        'calendar', // Option ID
        'Events Calendar Link', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'calendar' // Should match Option ID
        )
    );

    add_settings_field( // Option 2
        'established', // Option ID
        'Established Date', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'established' // Should match Option ID
        )
    );

    add_settings_field( // Option 2
        'slogan', // Option ID
        'Slogan', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'slogan' // Should match Option ID
        )
    );

    register_setting('general','phone', 'esc_attr');
    register_setting('general','email', 'esc_attr');
    register_setting('general','address', 'esc_attr');
    register_setting('general','calendar', 'esc_attr');
    register_setting('general','established', 'esc_attr');
    register_setting('general','slogan', 'esc_attr');
}

function my_section_options_callback() { // Section Callback
    echo '';
}

function my_textbox_callback($args) {  // Textbox Callback
    $option = get_option($args[0]);
    echo '<input type="text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
}

function formatPhoneNumber($ph) {
    $ph = str_replace('(', '', $ph);
    $ph = str_replace(')', '', $ph);
    $ph = str_replace(' ', '', $ph);
    $ph = str_replace('+64', '0', $ph);

    return $ph;
}

function topMenu() {
    $html = '
    <ul>
        <li><a href="' . get_option('calendar') . '" target="_blank"><span class="fa fa-calendar"></span>Events Calendar</a></li>
        <li><a href="' . get_page_link(390) . '"><span class="fa fa-user"></span></a></li>
        <li><a class="fa fa-shopping-cart" href="#"></a></li>
    </ul>';

    return $html;
}

function getImageID($image_url)
{
    global $wpdb;
    $sql = 'SELECT ID FROM ' . $wpdb->prefix . 'posts WHERE guid = "' . $image_url . '"';
    $result = $wpdb->get_results($sql);

    return $result[0]->ID;
}

function our_people_shortcode() {
    $html = '
    <div class="our-people-wrapper">
        <h2>Our People</h2>
        <div class="inner-wrapper">
        
        </div>
    </div>';

    return $html;
}
add_shortcode('our_people', 'our_people_shortcode');

function club_records_shortcode() {
    $html = '
    <div class="row club-records-wrapper">
        <div class="col-xl-12">
            <h2>Club Records</h2>
        </div>
    </div>';

    return $html;
}
add_shortcode('club_records', 'club_records_shortcode');

function sponsors_shortcode() {
    $html = '
    <div class="sponsor-wrapper gold inner-wrapper">
        <h3>Gold club sponsor</h3>
        <div class="sponsors">';
        foreach(getSponsors(1) as $sponsor) {
            $html .= '<div><a href="' . $sponsor->getLink() . '" target="_blank">' . $sponsor->output() . '</a></div>';
        }
        $html .= '</div>
    </div>
    <div class="sponsor-wrapper silver inner-wrapper">
        <h3>Silver club sponsors</h3>
        <div class="sponsors">';
    foreach(getSponsors(2) as $sponsor) {
        if($sponsor->getLink() <> "") {
            $html .= '<div><a href="' . $sponsor->getLink() . '" target="_blank">' . $sponsor->output() . '</a></div>';
        } else {
            $html .= '<div>' . $sponsor->output() . '</div>';
        }
    }
    $html .= '
        </div>
    </div>
    <div class="sponsor-wrapper bronze inner-wrapper">
        <h3>Bronze club sponsors</h3>
        <div class="sponsors">';
    foreach(getSponsors(3) as $sponsor) {
        if($sponsor->getLink() <> "") {
            $html .= '<div><a href="' . $sponsor->getLink() . '" target="_blank">' . $sponsor->output() . '</a></div>';
        } else {
            $html .= '<div>' . $sponsor->output() . '</div>';
        }
    }
    $html .= '        
    </div>';

    return $html;
}
add_shortcode('sponsors', 'sponsors_shortcode');

function getSponsors($type) {
    $sponsors = Array();
    $posts_array = get_posts([
        'post_type' => 'sponsor',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'ID',
        'order' => 'ASC',
        'meta_query' => [
            [
                'key' => 'wpcf-sponsor-type',
                'value' => $type
            ]
        ]
    ]);
    foreach ($posts_array as $post) {
        $sponsor = new Sponsor($post);
        $sponsors[] = $sponsor;
    }
    return $sponsors;
}
function getOurPeople() {
    $people = Array();
    $posts_array = get_posts([
        'post_type' => 'people',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'ID',
        'order' => 'ASC'
    ]);
    foreach ($posts_array as $post) {
        $person = new People($post);
        $people[] = $person;
    }
    return $people;
}

function ourPeople_shortcode() {
    $people = getOurPeople();
    shuffle($people);
    $html = '
    <div class="our-people-wrapper">
        <h2>Our People</h2>
        <div class="person-wrapper">';
        foreach ($people as $person) {
            $imageid = getImageID($person->getImage());
            $img = wp_get_attachment_image_src($imageid, 'people');
            $html .= '
            <div>
                <div class="inner-wrapper">
                    <div class="flex-item">
                        <div class="image-wrapper">
                            <img src="' . $img[0] . '" alt="' . $person->getTitle . '" />
                        </div>
                    </div>
                    <div class="flex-item">
                        <h3>' . $person->getTitle() . '</h3>
                        ' . $person->getContent() . '
                    </div>
                </div>    
            </div>';
        }
        $html .= '
        </div>
    </div>';

    return $html;
}
add_shortcode('our_people', 'ourPeople_shortcode');
