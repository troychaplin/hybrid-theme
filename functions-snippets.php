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
// function reorder_block_categories( $categories ) {
// 	// Define the new category order with custom titles where needed.
// 	$new_category_order = [
// 		[ 'slug' => 'text', 'title' => 'Text Elements' ],
// 		[ 'slug' => 'media' ],
// 		[ 'slug' => 'embed' ],
// 		[ 'slug' => 'design', 'title' => 'Design & Layout' ],
// 		// [ 'slug' => 'widgets' ],
// 		// [ 'slug' => 'theme' ],
// 		// [ 'slug' => 'reusable' ],
// 	];

// 	// Get the default titles and slugs for the core block categories.
// 	$get_core_block_categories = array_column( $categories, 'title', 'slug' );

// 	// Check if the new category order has custom titles, fallback to default titles.
// 	foreach ( $new_category_order as &$new_category ) {
// 		$new_category['title'] = $new_category['title'] ?? $get_core_block_categories[ $new_category['slug'] ] ?? 'Untitled';
// 	}

// 	// Create an array of slugs from the new category order.
// 	$new_category_slugs = array_column( $new_category_order, 'slug' );

// 	// Filter out the remaining block categories that are not in the new order.
// 	$remaining_core_categories = array_filter( $categories, function ( $category ) use ( $new_category_slugs ) {
// 		return ! in_array( $category['slug'], $new_category_slugs, true );
// 	});

// 	// Merge the new category order with the remaining categories.
// 	return array_merge( $new_category_order, $remaining_core_categories );
// }
// add_filter( 'block_categories_all', 'example_block_category', 10, 2 );


/**
 * Reorders the block categories based on a predefined order.
 *
 * @param array $categories The original array of block categories.
 * @return array The reordered array of block categories.
 */
function reorder_block_categories_only($categories)
{
	// Define the new category order.
	$new_category_order = [
		'media',
		'text',
		'custom-category',
		'embed',
		'design',
	];

	// Create a map of the new order for sorting.
	$order_map = array_flip($new_category_order);

	// Sort the categories based on the new order.
	usort($categories, function ($a, $b) use ($order_map) {
		$order_a = $order_map[$a['slug']] ?? PHP_INT_MAX;
		$order_b = $order_map[$b['slug']] ?? PHP_INT_MAX;

		return $order_a <=> $order_b;
	});

	return $categories;
}

add_filter('block_categories_all', 'reorder_block_categories_only', 10, 2);
