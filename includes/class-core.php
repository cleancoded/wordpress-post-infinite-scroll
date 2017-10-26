<?php
/**
 * Core class.
 *
 * Contains core functionality.
 *
 * @package    WordPress_Post_Infinite_Scroll
 * @author     CLEANCODED
 * @since      1.0.0
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2017
 */

class cc_Full_Post_Scroll_Core {

	/**
	 * Primary class constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
		add_action( 'init', array( $this, 'endpoint' ) );
		add_action( 'template_redirect', array( $this, 'template_redirect' ) );

	}

	/**
	 * Enqueue Scripts
	 *
	 * @since 1.0.0
	 */
	public function scripts() {

		// Only enqueue on single posts
		$display = apply_filters( 'cc_full_post_scroll', is_single() );
		if( ! $display )
			return;

		wp_enqueue_script( 'history', cc_FULL_POST_SCROLL_URL . 'assets/js/jquery.history.js', array( 'jquery' ), cc_FULL_POST_SCROLL_VERSION, true );
    wp_enqueue_script( 'scrollspy', cc_FULL_POST_SCROLL_URL . 'assets/js/jquery.scrollspy.min.js', array( 'jquery' ), cc_FULL_POST_SCROLL_VERSION, true );
		wp_enqueue_script( 'cc-full-post-scroll', cc_FULL_POST_SCROLL_URL . 'assets/js/cc-full-post-scroll.js', array( 'jquery', 'history', 'scrollspy' ), cc_FULL_POST_SCROLL_VERSION, true );

		$args = array(
			'container' => '.content',
			'post'      => '.entry',
			'next'      => '.post-navigation a[rel="prev"]',
			'offset'    => 2000,
			'delay'     => 400,
			'debug'     => false,
		);

		$args = apply_filters( 'cc_full_post_scroll_args', $args );
		wp_localize_script( 'cc-full-post-scroll', 'args', $args );

	}

	/**
	 * Rewrite Endpoint
	 *
	 * @since 1.0.0
	 */
	public function endpoint() {

		add_rewrite_endpoint( 'partial', EP_PERMALINK );

	}

	/**
	 * Template Redirect
	 *
	 * @since 1.0.0
	 */
	public function template_redirect() {

		$display = apply_filters( 'cc_full_post_scroll', is_single() );
		if( $display && get_query_var( 'partial' ) ) {

			$template = get_stylesheet_directory() . '/template-parts/content-partial.php';
			$template = apply_filters( 'cc_full_post_scroll_template', $template );
			include $template;
			exit;

		}
	}

}
