<?php
/**
 * @@title - Admin.
 *
 * @since    1.0.0
 * @author   Sébastien Dumont
 * @category Admin
 * @package  @@title/Admin
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'ALNP_Addon_Name_Admin' ) ) {

	class ALNP_Addon_Name_Admin {

		/**
		 * Constructor
		 *
		 * @access public
		 */
		public function __construct() {
			add_action( 'admin_init', array( $this, 'includes' ) );
			add_filter( 'plugin_row_meta', array( $this, 'plugin_row_meta'), 10, 3 );
		}

		/**
		 * Include any classes we need within admin.
		 *
		 * @access public
		 */
		public function includes() {
			include( dirname( __FILE__ ) . '/class-@@name-check.php' );
			include( dirname( __FILE__ ) . '/class-@@name-feedback.php' );
		}

		/**
		 * Plugin row meta links
		 *
		 * @access public
		 * @param  array  $links Plugin Row Meta
		 * @param  string $file  Plugin Base file
		 * @param  array  $data  Plugin Information
		 * @return array  $links
		 */
		public function plugin_row_meta( $links, $file, $data ) {
			if ( $file == plugin_basename( ALNP_ADDON_PLUGIN_FILE ) ) {
				$links[ 1 ] = sprintf( __( 'Developed By %s', '@@name' ), '<a href="' . $data[ 'AuthorURI' ] . '" aria-label="' . esc_attr__( 'View the Developers Site', '@@name' ) . '">' . $data[ 'Author' ] . '</a>' );

				$row_meta = array(
					'community' => '<a href="' . esc_url( ALNP_ADDON_SUPPORT_URL ) . '" aria-label="' . esc_attr__( 'Get Support from the Community', '@@name' ). '" target="_blank">' . esc_attr__( 'Community Support', '@@name' ) . '</a>',
					'review' => '<a href="' . esc_url( ALNP_ADDON_REVIEW_URL ) . '" aria-label="' . esc_attr( __( 'Review @@title on WordPress.org', '@@name' ) ) . '" target="_blank">' . __( 'Leave a Review', '@@name' ) . '</a>',
				);

				$links = array_merge( $links, $row_meta );
			}

			return $links;
		}

	}

}

return new ALNP_Addon_Name_Admin();
