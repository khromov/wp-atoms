<?php
add_action( 'init', 'cptui_register_my_taxes_atom_category' );
function cptui_register_my_taxes_atom_category() {
    $labels = array(
        "name" => __( 'Atom categories' ),
        "singular_name" => __( 'Atom category' ),
    );

    $args = array(
        "label" => __( 'Atom categories' ),
        "labels" => $labels,
        "public" => true,
        "hierarchical" => true,
        "show_ui" => true,
        "query_var" => true,
        "rewrite" => array( 'slug' => 'atom-category', 'with_front' => true,  'hierarchical' => true ),
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "atom-category",
		"show_in_quick_edit" => true,
	);
	register_taxonomy( "atom-category", array( "atom" ), $args );

// End cptui_register_my_taxes_atom_category()
}