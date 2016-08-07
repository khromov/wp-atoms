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

use Khromov\Atom\Shortcode\Atom as Atom_Shortcode;

include 'includes/cpt/atom.php';
include 'includes/taxonomy/atom-category.php';
include 'includes/shortcode/atom.php';
include 'includes/integration/shortcake.php';

add_action('init', function() {
    Atom_Shortcode::init();
});

add_action('register_shortcode_ui', function() {
    Shortcake::init();
});