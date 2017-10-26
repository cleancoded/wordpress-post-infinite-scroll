<?php
/**
 * Install class.
 *
 * Contains code that runs on installation and deletion
 *
 * @package    WordPress_Post_Infinite_Scroll
 * @author     CLEANCODED
 * @since      1.0.0
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2017
 */
 
class cc_Full_Post_Scroll_Install {

	/**
	 * Primary class constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		
		register_activation_hook( cc_FULL_POST_SCROLL_FILE, array( $this, 'activate' ) );
		register_deactivation_hook( cc_FULL_POST_SCROLL_FILE, array( $this, 'deactivate' ) );

	}
	
	/**
	 * Activation
	 *
	 * @since 1.0.0
	 */
	function activate() {

		cc_full_post_scroll()->core->endpoint();
		flush_rewrite_rules();
	}
	
	/**
	 * Deactivation
	 *
	 * @since 1.0.0
	 */
	function deactivate() {
		
		flush_rewrite_rules();
	}
	
}