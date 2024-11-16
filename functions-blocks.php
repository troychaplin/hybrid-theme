<?php

/**
 * Enqueues the block variations script for the block editor.
 *
 * This function registers and enqueues a JavaScript file that adds custom block variations
 * to the WordPress block editor. The script is dependent on the 'wp-blocks', 'wp-dom-ready',
 * and 'wp-edit-post' scripts provided by WordPress.
 *
 * @since 1.0.0
 */
function hybrid_theme_enqueues() {
	wp_enqueue_script(
			'hybrid-theme-scripts',
			get_template_directory_uri() . '/assets/js/hybrid-theme.js',
			array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' ),
			null,
			true
	);
}
add_action( 'enqueue_block_editor_assets', 'hybrid_theme_enqueues' );


/**
 * Enqueues the block styles for the Hybrid theme.
 *
 * This function registers and enqueues the main stylesheet for the Hybrid theme,
 * ensuring that the stylesheet is loaded with a version number based on the file's
 * last modification time. This helps with cache busting.
 *
 * Additionally, it adds the stylesheet to the block editor to ensure that the
 * editor styles match the front-end styles.
 *
 * @return void
 */
function hybrid_theme_enqueue_styles() {
	wp_enqueue_style(
			'hybrid-theme-styles',
			get_template_directory_uri() . '/assets/css/hybrid-theme.css',
			array(),
			filemtime( get_template_directory() . '/assets/css/hybrid-theme.css' )
	);

	add_editor_style( '/assets/css/hybrid-theme.css' );
}
add_action( 'enqueue_block_assets', 'hybrid_theme_enqueue_styles' );


/**
 * Registers a custom block pattern for the Hybrid theme.
 *
 * This function checks if the `register_block_pattern` function exists and, if so,
 * registers a block pattern with the specified title, description, categories, and content.
 *
 * Block Pattern Details:
 * - Title: Example pattern
 * - Description: An example pattern with a header, paragraph, and button.
 * - Categories: hybrid-patterns
 * - Content: A heading, paragraph, and button block.
 *
 * @since 1.0.0
 */
function hybrid_register_block_patterns() {
	if ( function_exists( 'register_block_pattern' ) ) {
			register_block_pattern(
					'hybrid-theme/example-layout',
					array(
							'title'       => __( 'Example pattern', 'hybrid-theme' ),
							'description' => _x( 'An example pattern with a header, paragraph and button.', 'Block pattern description', 'hybrid-theme' ),
							'categories'  => array( 'hybrid-patterns' ),
							'content'     => '<!-- wp:heading -->
							<h2 class="wp-block-heading">Hybrid Theme Pattern Example</h2>
							<!-- /wp:heading -->
							<!-- wp:paragraph -->
							<p>Introduced in <a href="https://wordpress.org/news/2020/08/eckstine/">WordPress 5.5</a> for both classic and block themes, patterns are predefined block layouts that developers can register or users can create which can then be used to quickly insert into new content and configure. <a href="https://developer.wordpress.org/block-editor/reference-guides/block-api/block-patterns/">Read more about patterns</a>.</p>
							<!-- /wp:paragraph -->
							<!-- wp:buttons -->
							<div class="wp-block-buttons"><!-- wp:button -->
							<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="https://developer.wordpress.org/news/">View WordPress Developer Blog</a></div>
							<!-- /wp:button --></div>
							<!-- /wp:buttons -->',
					)
			);
	}
}
add_action( 'init', 'hybrid_register_block_patterns' );


/**
 * Registers a custom block pattern category for the theme.
 *
 * This function checks if the `register_block_pattern_category` function exists,
 * and if it does, it registers a new block pattern category named 'hybrid-patterns'
 * with the label 'Hybrid Patterns'.
 *
 * @since 1.0.0
 */
function hybrid_register_pattern_categories() {
	if ( function_exists( 'register_block_pattern_category' ) ) {
			register_block_pattern_category(
					'hybrid-patterns',
					array( 'label' => __( 'Hybrid Patterns', 'mytheme' ) )
			);
	}
}
add_action( 'init', 'hybrid_register_pattern_categories' );


/**
 * Registers a custom block style variation for the core/button block.
 *
 * This function adds a new style variation called 'blue-button' to the core/button block.
 * The 'blue-button' style applies a blue background color and white text color to the button.
 *
 * @since 1.0.0
 */
function hybrid_button_styles_variation() {
	register_block_style(
			'core/button',
			array(
					'name'         => 'blue-button',
					'label'        => __('Blue', 'hybrid-theme'),
					'inline_style' => '.wp-block-button.is-style-blue-button .wp-block-button__link { background-color: #0743a3; color: #ffffff; }',
			)
	);
}
add_action( 'init', 'hybrid_button_styles_variation' );


/**
 * Adds support for block template parts in the theme.
 *
 * This function hooks into the 'after_setup_theme' action to add support for
 * block template parts, allowing the theme to utilize block-based templates.
 *
 * @return void
 */
function hybrid_add_template_parts_support() {
	add_theme_support( 'block-template-parts' );
}
add_action( 'after_setup_theme', 'hybrid_add_template_parts_support' );
