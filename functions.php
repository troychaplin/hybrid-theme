<?php

function hybrid_register_block_patterns() {
	if ( function_exists( 'register_block_pattern' ) ) {
			register_block_pattern(
					'hybrid-theme/example-layout',
					array(
							'title'       => __( 'Example pattern', 'hybrid-theme' ),
							'description' => _x( 'An example pattern with a header, paragraph and button.', 'Block pattern description', 'hybrid-theme' ),
							'categories' => array( 'hybrid-patterns' ),
							'content'     => '<!-- wp:heading -->
							<h2 class="wp-block-heading">Content Heading</h2>
							<!-- /wp:heading -->
							<!-- wp:paragraph -->
							<p>Add your content here</p>
							<!-- /wp:paragraph -->
							<!-- wp:buttons -->
							<div class="wp-block-buttons"><!-- wp:button -->
							<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Button</a></div>
							<!-- /wp:button --></div>
							<!-- /wp:buttons -->',
					)
			);
	}
}
add_action( 'init', 'hybrid_register_block_patterns' );

function hybrid_register_pattern_categories() {
	if ( function_exists( 'register_block_pattern_category' ) ) {
			register_block_pattern_category(
					'hybrid-patterns',
					array( 'label' => __( 'Hybrid Patterns', 'mytheme' ) )
			);
	}
}
add_action( 'init', 'hybrid_register_pattern_categories' );

