<?php
namespace Khromov\Atom\Shortcode;

class Atom {
    static function init() {
        add_shortcode('atom', array(__CLASS__, 'callback'));
    }

    static function callback($atts, $content) {
        extract( shortcode_atts( array(
            "id" => '',
            'uuid' => ''
        ), $atts ));

        //TODO: Lookup by UUID postmeta via WP_Query

        return 'Atom: ' . $id;
    }
}