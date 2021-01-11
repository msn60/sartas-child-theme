<?php
/**
 * The main template that your theme works with it.
 *
 * This file is like a plugin for your template. All of functions and classes
 * that you want to use it in your WordPress theme, are inside in this file.
 *
 * @package    MSN_WOODMART_CHILD
 * @version    1.0.1
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 * @link       https://wpwebmaster.ir
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Msn_Woodmart_Child\Inc\Core\Constant;

final class Main_Woodmart_Child_Theme {
	/**
	 * Instance property of Main_Woodmart_Child_Theme Class.
	 *
	 * @access private
	 * @var    Main_Woodmart_Child_Theme $instance create only one instance from plugin primary class
	 * @static
	 */
	private static $instance;

	/**
	 * The unique identifier of this theme.
	 *
	 * @since    1.0.1
	 * @access   protected
	 * @var      string $theme_name The string used to uniquely identify this theme.
	 */
	protected $theme_name;
	/**
	 * The current version of the theme.
	 *
	 * @since    1.0.1
	 * @access   protected
	 * @var      string $theme_version The current version of the theme.
	 */
	protected $theme_version;

	private function __construct() {
		$autoloader_path = 'inc/class-autoloader.php';
		require_once trailingslashit( get_theme_file_path() ) . $autoloader_path;
		Constant::define_constant();

		if ( defined( 'MSN_CHILD_VERSION' ) ) {
			$this->theme_version = MSN_CHILD_VERSION;
		} else {
			$this->theme_version = '1.0.1';
		}

	}

	public function init_theme() {
		$this->register_general_add_action();
	}

	public function register_general_add_action() {
		add_action( 'wp_enqueue_scripts', array( $this, 'register_css_files' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_js_files' ) );
		add_action( 'after_setup_theme', array( $this, 'setup_language_file' ) );
	}

	public function setup_language_file() {
		load_child_theme_textdomain( 'woodmart', MSN_CHILD_LANG );
	}

	public function register_css_files() {
		//wp_enqueue_style( 'msn-child-style', get_theme_file_uri() . '/style.css', array( 'woodmart-style' ), woodmart_get_theme_info( 'Version' ) );
		wp_register_style( 'msn-custom-child-style', MSN_CHILD_CSS . 'custom.css', [], MSN_CHILD_CSS_VERSION );
		wp_enqueue_style( 'msn-custom-child-style' );
	}

	public function register_js_files() {
		//wp_enqueue_script( 'msncustom.script', get_stylesheet_directory_uri() . '/msn-jesm-1-0-0.js', array( 'jquery' ), 2, true );
		wp_register_script( 'msn-custom-child-js', MSN_CHILD_JS . 'custom.js', array(), MSN_CHILD_CSS_VERSION, true );
		wp_enqueue_script( 'msn-custom-child-js' );
	}

	public static function instance() {
		if ( is_null( ( self::$instance ) ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

}

$main_woodmart_child_theme_object = Main_Woodmart_Child_Theme::instance();
$main_woodmart_child_theme_object->init_theme();



