<?php
namespace Khromov\Atoms;

class Shortcake {
    static function init() {
        shortcode_ui_register_for_shortcode( 'atom', array(
            'label'          => esc_html__( __('Atom') ),
            'listItemImage'  => 'dashicons-share-alt',
            'attrs'          => array(
                array(
                    'label'  => esc_html__( __('Select atom') ),
                    'attr'   => 'id',
                    'query'  => array(
                        'post_status' => array('publish'),
                        'post_type' => array('atom')
                    ),
                    'type'   => 'post_select',
                    'description'  => esc_html__( 'Select the Atom you wish to insert')
                )
            )
        ));
    }
}