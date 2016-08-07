<?php
/*
Plugin Name: Atoms
Plugin URI: http://wordpress.org/extend/plugins/atoms
Description: Content Blocks for WordPress
Version: 1.0
Author: khromov
Author URI: http://khromov.se
License: GPL2
*/

namespace Khromov\Atoms;

use Khromov\Atom\Field\Example as Example_Fields;
use Khromov\Atom\Shortcode\Atom as Atom_Shortcode;

include 'includes/cpt/atom.php';
include 'includes/taxonomy/atom-category.php';
include 'includes/shortcode/atom.php';
include 'includes/integration/shortcake.php';
include 'includes/field/example.php';

class Atoms {
    function __construct() {
        //Load stuff
        add_action('init', function() {
            Atom_Shortcode::init();
        });

        add_action('register_shortcode_ui', function() {
            Shortcake::init();
        });

        add_action('admin_init', function() {
            Example_Fields::init();
        });

        //TODO: Generate UUID upon first publication of Atom for use in Shortcake

        //TODO: Embed standarlone-customizer-controls
        //https://github.com/wp-shortcake/shortcake/issues/585
    }
}

new Atoms();

