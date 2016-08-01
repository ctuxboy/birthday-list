<?php
/**
 * Plugin Name: Birthday List
 * Plugin URI: http://www.webkust.be/
 * Description: Deze plugin activeert een aangepaste categorie (custom taxonomy) Verjaardagslijst, om zo een lijst te kunnen samenstellen. Een lijst met de verjaardagslijsten kun je opvragen via de shortcode [Verjaardagslijsten]
 * Author: Christophe Hollebeke
 * Author URI: http://www.Webkust.be/
 * Version: 0.0.1
 * License: GPLv2
 */

/**
* Changelog
 * version 0.0.1
 */

 // Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

 if ( ! function_exists( 'Verjaardagslijst_taxonomy' ) ) {

// Register Custom Taxonomy
function geboortelijst_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Verjaardagslijsten', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Verjaardagslijst', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Verjaardagslijsten', 'text_domain' ),
		'all_items'                  => __( 'Alle verjaardagslijsten', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'Nieuwe Verjaardagslijst', 'text_domain' ),
		'add_new_item'               => __( 'Nieuwe Verjaardagslijst', 'text_domain' ),
		'edit_item'                  => __( 'Bewerk Verjaardagslijst', 'text_domain' ),
		'update_item'                => __( 'Update Verjaardagslijst', 'text_domain' ),
		'view_item'                  => __( 'Bekijk Verjaardagslijst', 'text_domain' ),
		'separate_items_with_commas' => __( 'Verschillende lijsten scheiden door komma\'s', 'text_domain' ),
		'add_or_remove_items'        => __( 'Verjaardagslijst toevoegen of verwijderen', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Populaire verjaardagslijsten', 'text_domain' ),
		'search_items'               => __( 'Verjaardagslijst zoeken', 'text_domain' ),
		'not_found'                  => __( 'Niet gevonden', 'text_domain' ),
		'no_terms'                   => __( 'Geen lijsten', 'text_domain' ),
		'items_list'                 => __( 'Verjaardagslijsten', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'query_var'                  => 'geboortelijst',
	);
	register_taxonomy( 'verjaardagslijst', array( 'product' ), $args );

}
add_action( 'init', 'verjaardagslijst_taxonomy', 0 );

}

// Add shortcode [geboortelijsten]
function verjaardagslijsten_function() {
	// Taxonomy = verjaardagslijst
	// get the terms of verjaardagslijst
	$terms = get_terms( array(
    'taxonomy' => 'verjaardagslijst',
    'hide_empty' => false,
	) );

	// loop through all terms
	foreach( $terms as $term ) {

  	// if no entries attached to the term
/*  	if( 0 == $term->count )
    	// display only the term name
    	$return_string .='<h3 class="bornlist"><i class="fa fa-chevron-right" aria-hidden="true"></i> ' . $term->name . '</h3>';

  	// if term has more than 0 entries
  	elseif( $term->count > 0 )
    	// display link to the term archive*/
    	$return_string .='<h3 class="birthday-list"> <a href="'. get_term_link( $term ) .'">'. $term->name .'</a></h3>';

	}
	return $return_string;
}
add_shortcode( 'verjaardagslijsten', 'verjaardagslijsten_function' );
// plugins_url( 'myscript.js', __FILE__ );

// We need some CSS
function birthdaylist_css() {
	$babyface = plugins_url( '/images/babyface.png', __FILE__ );
	echo "
	<style type='text/css'>
	h3.bornlist {
		padding-left: 40px;
		margin-top: 1em;
		background: url($babyface) no-repeat left center;
		height: 30px;
	}
	</style>
	";
}
add_action( 'wp_head', 'birthdaylist_css' );
 ?>
