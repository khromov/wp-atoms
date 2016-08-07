<?php
namespace Khromov\Atom\Shortcode;

class Atom {
    static function init() {
        add_shortcode('atom', array(__CLASS__, 'callback'));
    }

    static function callback($atts, $content) {
        return 'foobar';
    }
}