<?php
add_action( 'init', 'cptui_register_my_cpts_atom' );
function cptui_register_my_cpts_atom() {
    $labels = array(
        "name" => __( 'Atoms' ),
        "singular_name" => __( 'Atom' ),
    );

    $args = array(
        "label" => __( 'Atoms' ),
        "labels" => $labels,
        "description" => "Content Blocks for WordPress",
        "public" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "has_archive" => true,
        "show_in_menu" => true,
        "exclude_from_search" => true,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array( "slug" => "atom", "with_front" => true ),
        "query_var" => true,
        "menu_icon" => "dashicons-share-alt",
        "supports" => array( "title", "thumbnail", "comments", "revisions", "author" ),
    );
    register_post_type( "atom", $args );

// End of cptui_register_my_cpts_atom()
}
