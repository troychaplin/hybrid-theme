<?php

/**
 * Reorders the block categories in the WordPress editor.
 *
 * This function allows you to define a custom order for the block categories
 * in the WordPress editor, including the ability to set custom titles for
 * specific categories. Categories not included in the custom order will be
 * appended to the end of the list.
 *
 * @param array $categories The default block categories.
 * @return array The reordered block categories.
 */
function reorder_block_categories( $categories ) {
	// Define the new category order with custom titles where needed.
	$new_category_order = [
		[ 'slug' => 'text', 'title' => 'Text Elements' ],
		[ 'slug' => 'media' ],
		[ 'slug' => 'embed' ],
		[ 'slug' => 'design', 'title' => 'Design & Layout' ],
		// [ 'slug' => 'widgets' ],
		// [ 'slug' => 'theme' ],
		// [ 'slug' => 'reusable' ],
	];

	// Get the default titles and slugs for the core block categories.
	$get_core_block_categories = array_column( $categories, 'title', 'slug' );

	// Check if the new category order has custom titles, fallback to default titles.
	foreach ( $new_category_order as &$new_category ) {
		$new_category['title'] = $new_category['title'] ?? $get_core_block_categories[ $new_category['slug'] ] ?? 'Untitled';
	}

	// Create an array of slugs from the new category order.
	$new_category_slugs = array_column( $new_category_order, 'slug' );

	// Filter out the remaining block categories that are not in the new order.
	$remaining_core_categories = array_filter( $categories, function ( $category ) use ( $new_category_slugs ) {
		return ! in_array( $category['slug'], $new_category_slugs, true );
	});

	// Merge the new category order with the remaining categories.
	return array_merge( $new_category_order, $remaining_core_categories );
}

add_filter( 'block_categories_all', 'example_block_category', 10, 2 );
