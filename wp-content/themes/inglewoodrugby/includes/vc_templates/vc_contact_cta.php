<?php
vc_map( array(
    "name" => __("Contact CTA"),
    "base" => "contact_cta",
    "category" => __('Content'),
    'icon' => 'icon-wpb-single-image',
    'description' => 'Contact CTA',
    "params" => array(
        array(
            "type" => "attach_images",
            "heading" => __("CTA Images"),
            "param_name" => "images",
        )
    )
));
add_shortcode('contact_cta', 'contactCTA');
function contactCTA($atts) {
    $args = shortcode_atts( array(
        'images' => ''
    ), $atts);
    $images = explode(',',$args['images']);
    shuffle($images);
    $img = wp_get_attachment_image_src($images[0], 'banner');
    $bannerImage = $img[0];
    //print_r($images);

    $html = '
    <div class="contact-cta-wrapper">
        <img src="' . $bannerImage . '" alt="" />
        <div class="banner-text-wrapper">
            <p>Play the game</p>
            <a href="' . get_page_link(54) . '" class="btn btn-primary">Join our club</a>
        </div>
    </div>';

    return $html;
}