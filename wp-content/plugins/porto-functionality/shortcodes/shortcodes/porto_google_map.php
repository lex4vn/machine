<?php
// Porto Google Map

add_shortcode('porto_google_map', 'porto_shortcode_google_map');
add_action('wp_enqueue_scripts', 'porto_google_map_script', 1);
add_action('vc_after_init', 'porto_load_google_map_shortcode');
add_action('save_post', 'porto_check_google_map_shortcode', 10, 1);

function porto_check_google_map_shortcode( $post_id ) {
    if (!function_exists('get_current_screen')) return;
    $screen = get_current_screen();
    if ($screen && $screen->base == 'post' && isset( $_POST['content'] ) ) {
        if( stripos( $_POST['content'], '[porto_google_map') !== false ) {
            update_post_meta( $post_id, 'porto_page_use_google_map_api', '1' );
        } else {
            delete_post_meta( $post_id, 'porto_page_use_google_map_api' );
        }
    }
}

function porto_google_map_script() {
    $api = 'https://maps.googleapis.com/maps/api/js';
    wp_register_script("googleapis",$api,null,null,false);
}

function porto_shortcode_google_map( $atts, $content = null ) {

    ob_start();
    if  ($template = porto_shortcode_template( 'porto_google_map' ) ) {
        include $template;
    }
    return ob_get_clean();
}

function porto_load_google_map_shortcode() {

    $custom_class = porto_vc_custom_class();

    vc_map( array(
        "name" => __("Porto Google Map", "porto-shortcodes"),
        "base" => "porto_google_map",
        "class" => "porto_google_map",
        "controls" => "full",
        "show_settings_on_create" => true,
        "icon" => "porto4_vc_google_map",
        "description" => __("Display Google Maps to indicate your location.", "porto-shortcodes"),
        "category" => __( 'Porto', 'porto-shortcodes' ),
        "params" => array(
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Width (in %)", "porto-shortcodes"),
                "param_name" => "width",
                "admin_label" => true,
                "value" => "100%",
                "group" => "General Settings"
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Height (in px)", "porto-shortcodes"),
                "param_name" => "height",
                "admin_label" => true,
                "value" => "300px",
                "group" => "General Settings"
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Map type", "porto-shortcodes"),
                "param_name" => "map_type",
                "admin_label" => true,
                "value" => array(__("Roadmap", "porto-shortcodes") => "ROADMAP", __("Satellite", "porto-shortcodes") => "SATELLITE", __("Hybrid", "porto-shortcodes") => "HYBRID", __("Terrain", "porto-shortcodes") => "TERRAIN"),
                "group" => "General Settings"
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Latitude", "porto-shortcodes"),
                "param_name" => "lat",
                "admin_label" => true,
                "value" => "18.591212",
                "description" => '<a href="http://universimmedia.pagesperso-orange.fr/geo/loc.htm" target="_blank">'.__('Here is a tool','porto-shortcodes').'</a> '.__('where you can find Latitude & Longitude of your location', 'porto-shortcodes'),
                "group" => "General Settings"
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Longitude", "porto-shortcodes"),
                "param_name" => "lng",
                "admin_label" => true,
                "value" => "73.741261",
                "description" => '<a href="http://universimmedia.pagesperso-orange.fr/geo/loc.htm" target="_blank">'.__('Here is a tool','porto-shortcodes').'</a> '.__('where you can find Latitude & Longitude of your location', "porto-shortcodes"),
                "group" => "General Settings"
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Map Zoom", "porto-shortcodes"),
                "param_name" => "zoom",
                "value" => array(
                    __("18 - Default", "porto-shortcodes") => 12, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 13, 14, 15, 16, 17, 18, 19, 20
                ),
                "group" => "General Settings"
            ),
            array(
                "type" => "checkbox",
                "heading" => "",
                "param_name" => "scrollwheel",
                "value" => array(
                    __("Disable map zoom on mouse wheel scroll", "porto-shortcodes") => "disable",
                ),
                "group" => "General Settings"
            ),
            array(
                "type" => "textarea_html",
                "class" => "",
                "heading" => __("Info Window Text", "porto-shortcodes"),
                "param_name" => "content",
                "value" => "",
                "group" => "Info Window",
                "edit_field_class" => "vc_col-xs-12 vc_column wpb_el_type_textarea_html vc_wrapper-param-type-textarea_html vc_shortcode-param",
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Open on Marker Click","porto-shortcodes"),
                "param_name" => "infowindow_open",
                "value" => array(
                    __("Yes","porto-shortcodes") => "on",
                    __("No","porto-shortcodes") => "off",
                ),
                "group" => "Info Window",
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Marker/Point icon", "porto-shortcodes"),
                "param_name" => "marker_icon",
                "value" => array(__("Use Google Default", "porto-shortcodes") => "default",  __("Upload Custom", "porto-shortcodes") => "custom"),
                "group" => "Marker"
            ),
            array(
                "type" => "attach_image",
                "class" => "",
                "heading" => __("Upload Image Icon:", "porto-shortcodes"),
                "param_name" => "icon_img",
                "admin_label" => true,
                "description" => __("Upload the custom image icon.", "porto-shortcodes"),
                "dependency" => Array("element" => "marker_icon","value" => array("custom")),
                "group" => "Marker"
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Street view control", "porto-shortcodes"),
                "param_name" => "streetviewcontrol",
                "value" => array(__("Disable", "porto-shortcodes") => "false", __("Enable", "porto-shortcodes") => "true"),
                "group" => "Advanced"
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Map type control", "porto-shortcodes"),
                "param_name" => "maptypecontrol",
                "value" => array(__("Disable", "porto-shortcodes") => "false", __("Enable", "porto-shortcodes") => "true"),
                "group" => "Advanced"
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Zoom control", "porto-shortcodes"),
                "param_name" => "zoomcontrol",
                "value" => array(__("Disable", "porto-shortcodes") => "false", __("Enable", "porto-shortcodes") => "true"),
                "group" => "Advanced"
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Zoom Control Position", "porto-shortcodes"),
                "param_name" => "zoomcontrolposition",
                "value" => array(
                        __("Right Bottom", "porto-shortcodes") => "RIGHT_BOTTOM",
                        __("Right Top", "porto-shortcodes") => "RIGHT_TOP", 
                        __("Right Center", "porto-shortcodes") => "RIGHT_CENTER",
                        __("Left Top", "porto-shortcodes") => "LEFT_TOP",
                        __("Left Center", "porto-shortcodes") => "LEFT_CENTER", 
                        __("Left Bottom", "porto-shortcodes") => "LEFT_BOTTOM",
                    ),
                "dependency" => Array("element" => "zoomcontrol", "value" => 'true'),
                "group" => "Advanced"
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Dragging on Mobile", "porto-shortcodes"),
                "param_name" => "dragging",
                "value" => array( __("Enable", "porto-shortcodes") => "true", __("Disable", "porto-shortcodes") => "false"),
                "group" => "Advanced"
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Top margin", "porto-shortcodes"),
                "param_name" => "top_margin",
                "value" => array(
                    __("Page (small)", "porto-shortcodes") => "page_margin_top",
                    __("Section (large)", "porto-shortcodes") => "page_margin_top_section",
                    __("None", "porto-shortcodes") => "none"
                ),
                "group" => "General Settings"
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Map Width Override", "porto-shortcodes"),
                "param_name" => "map_override",
                "value" =>array(
                    "Default Width"=>"0",
                    "Apply 1st parent element's width"=>"1",
                    "Apply 2nd parent element's width"=>"2",
                    "Apply 3rd parent element's width"=>"3",
                    "Apply 4th parent element's width"=>"4",
                    "Apply 5th parent element's width"=>"5",
                    "Apply 6th parent element's width"=>"6",
                    "Apply 7th parent element's width"=>"7",
                    "Apply 8th parent element's width"=>"8",
                    "Apply 9th parent element's width"=>"9",
                    "Full Width "=>"full",
                    "Maximum Full Width"=>"ex-full",
                ),
                "description" => __("By default, the map will be given to the Visual Composer row. However, in some cases depending on your theme's CSS - it may not fit well to the container you are wishing it would. In that case you will have to select the appropriate value here that gets you desired output..", "porto-shortcodes"),
                "group" => "General Settings"
            ),
            array(
                "type" => "textarea_raw_html",
                "class" => "",
                "heading" => __("Google Styled Map JSON","porto-shortcodes"),
                "param_name" => "map_style",
                "value" => "",
                "description" => "<a target='_blank' href='http://googlemaps.github.io/js-samples/styledmaps/wizard/index.html'>".__("Click here","porto-shortcodes")."</a> ".__("to get the style JSON code for styling your map.","porto-shortcodes"),
                "group" => "Styling",
            ),
            $custom_class,
        )
    ));

    if(class_exists('WPBakeryShortCode'))
    {
        class WPBakeryShortCode_porto_google_map extends WPBakeryShortCode {
        }
    }
}