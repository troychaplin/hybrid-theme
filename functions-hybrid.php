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
					array( 'label' => __( 'Hybrid Patterns', 'hybrid-theme' ) )
			);
	}
}
add_action( 'init', 'hybrid_register_pattern_categories' );


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


/**
 * Adds theme support for various features.
 *
 * This function is hooked to the 'after_setup_theme' action and adds support for:
 * - Responsive embeds
 * - Disabling custom colors
 * - Disabling custom gradients
 * - Disabling custom font sizes
 *
 * @return void
 */
function hybrid_add_theme_supports() {
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'disable-custom-colors' );
	add_theme_support( 'disable-custom-gradients' );
	add_theme_support( 'disable-custom-font-sizes' );
}
add_action( 'after_setup_theme','hybrid_add_theme_supports' );


/**
 * Adds theme support for various features and settings.
 *
 * This function adds support for:
 * - Wide alignment
 * - Custom line height
 * - Custom spacing
 * - Custom units (rem, em, px, vw, vh)
 * - Editor color palette with predefined colors:
 *   - Dusty Blue (#367cb3)
 *   - Faded Brown (#7a6a53)
 * - Editor gradient presets with predefined gradients:
 *   - Dusty to Faded (linear-gradient(135deg, #367cb3 0%, #7a6a53 100%))
 * - Editor font sizes with predefined sizes:
 *   - Small (12px)
 *   - Medium (18px)
 *
 * Note: This function cannot be used alongside a theme.json file.
 *
 * @package HybridTheme
 */
function hybrid_add_theme_supports_no_themejson() {
	// Cannot use alongside a theme.json file
	add_theme_support( 'align-wide' );
	add_theme_support( 'custom-line-height' );
	add_theme_support( 'custom-spacing' );

	add_theme_support( 'custom-units', array( 'rem', 'em', 'px', 'vw', 'vh' ) );

	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => __( 'Dusty Blue', 'hybrid-theme' ),
        'slug'  => 'dusty-blue',
        'color' => '#367cb3',
			),
			array(
				'name'  => __( 'Faded Brown', 'hybrid-theme' ),
        'slug'  => 'faded-brown',
        'color' => '#7a6a53',
			),
		)
	);

	add_theme_support(
		'editor-gradient-presets',
		array(
			array(
				'name'     => __( 'Dusty to Faded', 'hybrid-theme' ),
				'gradient' => 'linear-gradient(135deg, #367cb3 0%, #7a6a53 100%)',
				'slug'     => 'dusty-to-faded',
			),
		)
	);

	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name' => 'Small',
				'slug' => 'small',
				'size' => 12
			),
			array(
				'name' => 'Medium',
				'slug' => 'medium',
				'size' => 18
			),
		)
	);
}
// add_action( 'after_setup_theme','hybrid_add_theme_supports_no_themejson' );