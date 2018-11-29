<?php
vc_map( array(
    "name" => __("Home Banner"),
    "base" => "dn_home_banner",
    "category" => __('Content'),
    'icon' => 'icon-wpb-single-image',
    'description' => 'Banner for the home page',
    "params" => array(
        array(
            "type" => "attach_images",
            "heading" => __("Banner Images"),
            "param_name" => "images",
        )
    )
));
add_shortcode('dn_home_banner', 'homeBanner');
function homeBanner($atts) {
    $args = shortcode_atts( array(
        'images' => ''
    ), $atts);
    $images = explode(',',$args['images']);
    $img = wp_get_attachment_image_src($images[0], 'banner');
    $bannerImage = $img[0];
    //print_r($images);

    $html = '
    <div class="banner-wrapper">
        <img src="' . $bannerImage . '" alt="Inglewood United Rugby Football Club" />
        <div class="banner-text-wrapper">
            <h1>' . get_bloginfo('name') . '</h1>
        </div>
    </div>';

    return $html;
}