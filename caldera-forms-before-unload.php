<?php
/**
 * Plugin Name: Caldera Forms Before Unload
 * Description: Adds a setting in the Form Settings tab to warn the user when closing the browser window while the form is processing.
 * Version: 0.1
 * Author: Andrei Mondoc
 * Author URI: https://github.com/mecachisenros
 * Plugin URI: https://github.com/mecachisenros/caldera-forms-before-unload
 * GitHub Plugin URI: mecachisenros/caldera-forms-before-unload
 */

class Caldera_Forms_Before_Unload {

	/**
	 * Version.
	 * @since 0.1
	 * @var string $version
	 */
	public $version = '0.1';

	/**
	 * Plugin path.
	 * @since 0.1
	 * @var string $path
	 */
	private $path;

	/**
	 * Plugin url.
	 * @since 0.1
	 * @var string $url
	 */
	private $url;

	/**
	 * Script handle.
	 * @since 0.1
	 * @var string $handle
	 */
	private $handle = 'caldera-forms-before-unload';

	/**
	 * Constructor.
	 * @since 0.1
	 */
	public function __construct() {
		// plugin path
		$this->path = plugin_dir_path( __FILE__ );
		// plugin url
		$this->url = plugin_dir_url( __FILE__ );
		// initiliaze
		add_action( 'caldera_forms_core_init', [ $this, 'register_hooks' ] ); 
	}

	/**
	 * Register hooks.
	 * @since 0.1
	 */
	public function register_hooks() {
		// register setting
		add_action( 'caldera_forms_general_settings_panel', [ $this, 'register_setting' ] );
		// register script
		add_action( 'caldera_forms_assets_registered', [ $this, 'register_assets' ] );
		// enqueue script
		add_action( 'caldera_forms_render_get_form', [ $this, 'maybe_enqueue_assets' ] );
	}

	/**
	 * Add setting field to form Settings tab.
	 * @since 0.2
	 * @param array $form The form cofig
	 */
	public function register_setting( $form ) {

		ob_start();
		include $this->path . 'settings/before-unload.php';
		$setting = ob_get_clean();
		echo $setting;

	}

	/**
	 * Register assets.
	 * @since 0.1
	 * @param array $script_style_urls The Caldera Forms scripts and styles urls
	 */
	public function register_assets( $script_style_urls ) {
		wp_register_script( $this->handle, $this->url . 'assets/before-unload.js', [ 'jquery' ], $this->version, true );
	}

	/**
	 * Enqueues assets.
	 * @since 0.1
	 * @param array $form The form config
	 * @return array $form The form config
	 */
	public function maybe_enqueue_assets( $form ) {

		if ( isset( $form['before_unload_enabled'] ) )
			wp_enqueue_script( $this->handle );

		return $form;

	}

}

// initialize plugin
new Caldera_Forms_Before_Unload;
