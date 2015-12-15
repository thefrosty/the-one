<?php

namespace TheOne\Inc;

/**
 * Class Core
 * @package TheOne\Inc
 */
class Core {

	private static $instance;

	public static $theme_dir;
	public static $theme_uri;

	const THEME_VERSION = '1.2.0';
	const THEME_NAME = 'the-one';
	const THEME_PREFIX = 'theone_';

	/**
	 * Setup the theme.
	 *
	 * @return self
	 */
	public static function setup() {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self;

			self::$theme_dir = trailingslashit( get_template_directory() );
			self::$theme_uri = trailingslashit( get_template_directory_uri() );
			self::$instance->actions();
			self::$instance->filters();
			self::$instance->includes();
		}

		return self::$instance;
	}

	/**
	 *
	 */
	private function actions() {

		add_action( 'init', array( $this, 'register_nav_menu' ) );
		add_action( 'tgmpa_register', array( $this, 'tgmpa_register' ) );
		add_action( 'widgets_init', array( $this, 'widgets_init' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_head', array( $this, 'search_form_insert' ) );
		add_action( 'wp_footer', array( $this, 'loading_html' ) );
	}

	/**
	 *
	 */
	private function filters() {

		add_filter( 'body_class', array( $this, 'body_class' ) );
		add_filter( 'excerpt_length', array( $this, 'excerpt_length' ) );
		add_filter( 'excerpt_more', array( $this, 'excerpt_more' ) );
		add_filter( 'widget_text', 'do_shortcode' );
		add_filter( 'hybrid_site_title', array( $this, 'hybrid_site_title') );
	}

	/**
	 *
	 */
	private function includes() {

		/* Add custom styles from customizer saved settings. */
		require self::$theme_dir . 'inc/custom-css.php';

		/* Customizer additions. */
		require self::$theme_dir . 'inc/customizer/customizer.php';

		/* Implement Custom Header feature. */
		require self::$theme_dir . 'inc/custom-header.php';

		/* Custom functions, independent of theme templates. */
		require self::$theme_dir . 'inc/extras.php';

		/* Load this theme's social media sharing functions, scripts, and template tags. */
		require self::$theme_dir . 'inc/sharing/sharing.php';

		/* Custom template tags for this theme. */
		require self::$theme_dir . 'inc/Functions/template-tags.php';

		require self::$theme_dir . 'inc/Libraries/class-tgm-plugin-activation.php';
	}

	/**
	 *********************
	 ****** ACTIONS ******
	 *********************
	 */

	/**
	 * Register navigation menus.
	 */
	public function register_nav_menu() {

		register_nav_menu( 'primary', esc_html_x( 'Primary', 'nav menu location', 'the-one' ) );
		register_nav_menu( 'secondary', esc_html_x( 'Secondary', 'nav menu location', 'the-one' ) );
		register_nav_menu( 'social', esc_html_x( 'Social', 'nav menu location', 'the-one' ) );
	}

	/**
	 * Register the required plugins for this theme.
	 *
	 * The variable passed to tgmpa_register_plugins() should be an array of plugin
	 * arrays.
	 *
	 * This function is hooked into tgmpa_init, which is fired within the
	 * TGM_Plugin_Activation class constructor.
	 */
	public function tgmpa_register() {

		$plugins = array(
			array(
				'name'      => 'GitHub Updater',
				'slug'      => 'github-updater',
				'source'    => 'https://github.com/afragen/github-updater/archive/5.3.1.zip',
				'required'  => false,
			),
		);

		$config = array(
			'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'parent_slug'  => 'themes.php',            // Parent menu slug.
			'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
		);

		tgmpa( $plugins, $config );
	}

	/**
	 * Register widget areas.
	 */
	public function widgets_init() {

		register_sidebar( array(
				'name'          => __( 'Footer 1', 'the-one' ),
				'id'            => 'sidebar-1',
				'description'   => '',
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
		) );
		register_sidebar( array(
				'name'          => __( 'Footer 2', 'the-one' ),
				'id'            => 'sidebar-2',
				'description'   => '',
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
		) );
		register_sidebar( array(
				'name'          => __( 'Footer 3', 'the-one' ),
				'id'            => 'sidebar-3',
				'description'   => '',
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
		) );
		register_sidebar( array(
				'name'          => __( 'Footer 4', 'the-one' ),
				'id'            => 'sidebar-4',
				'description'   => '',
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
		) );
		register_sidebar( array(
				'name'          => __( 'Footer 5', 'the-one' ),
				'id'            => 'sidebar-5',
				'description'   => '',
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
		) );
	}

	/**
	 * Enqueue scripts and styles.
	 */
	public function enqueue_scripts() {

		/* Load active theme's style.css. */
		wp_enqueue_style( is_child_theme() ? 'child-style' : 'style', get_stylesheet_uri(), array() );

		/* If using a child theme, auto-load the parent theme style. */
		if ( is_child_theme() ) {
			wp_enqueue_style( 'style', self::$theme_uri . 'style.css', array( 'style' ) );
		}

		/* Enqueue custom style for media player */
		wp_enqueue_style( 'theone-mediaelement', self::$theme_uri . 'css/mediaelement.css', array( 'wp-mediaelement', 'style' ), self::THEME_VERSION );

		/* Google fonts */
		wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=PT+Mono|PT+Serif:400,700,400italic,700italic', array( 'style' ) );

		/* Icon font: Font Awesome */
		wp_enqueue_style( 'font-awesome', self::$theme_uri . 'css/font-awesome.css', array( 'style' ), '', 'screen' );

		/* Loaders */
		wp_enqueue_style( 'loaders', self::$theme_uri . 'css/loaders.min.css', array( 'style' ), '0.1.1', 'screen' );

		/* AJAX */
		wp_register_script( 'scrollto', self::$theme_uri . 'js/scrollto.js', array( 'jquery' ), '1.4.4', true );
		wp_register_script( 'history-js', self::$theme_uri . 'js/history.js', array( 'jquery', 'scrollto' ), '1.8b2', true );
		wp_register_script( 'ajaxify', self::$theme_uri . 'js/ajaxify.js', array( 'jquery', 'history-js' ), '1.0.1', true );

		/* Underscores skip link fix */
		wp_enqueue_script( 'skip-link-focus-fix', self::$theme_uri . 'js/skip-link-focus-fix.js', array(), '20151029', true );

		/* theme-specific scripts. */
		wp_enqueue_script( self::THEME_NAME, self::$theme_uri . 'js/theme.js', array( 'jquery', 'ajaxify' ), self::THEME_VERSION, true );

		/* Comment reply */
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	/**
	 * Get user choice then add search form to related action hook.
	 */
	public function search_form_insert() {

		/* Get insert location */
		$search_form_placement = esc_attr( get_theme_mod( 'theone_search_form_insert', 'none' ) );

		if ( 'none' === $search_form_placement ) {
			return;
		} else {
			add_action( self::THEME_PREFIX . sanitize_key( $search_form_placement ), array( $this, 'search_form' ) );
		}
	}

	/**
	 * Wrapper function for get_search_form() to pass it to action hooks.
	 *
	 * @return string
	 */
	public function search_form() {
		echo '<div class="search-wrap">' . get_search_form( false ) . '</div>';
	}

	/**
	 *
	 */
	public function loading_html() {
		include self::$theme_dir . 'views/loading.php';
	}

	/**
	 *********************
	 ****** FILTERS ******
	 *********************
	 */

	/**
	 * Filter the body class.
	 */
	public function body_class(  $classes ) {

		if ( is_singular() ) {
			$classes[] = 'single';
		}

		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		return $classes;
	}

	/**
	 * Modifies the excerpt more
	 *
	 * @param $length
	 *
	 * @return int
	 */
	public function excerpt_length( $length ) {
		return 20;
	}

	/**
	 * Modifies the excerpt more
	 *
	 * @return string
	 */
	public function excerpt_more( $more ) {
		return '<a class="moretag read-more-link" href="'. get_permalink() . '">&#133;</a>';
	}

	/**
	 * Returns a modified linked title.
	 *
	 * @param string $title The linked site title.
	 *
	 * @return string
	 */
	public function hybrid_site_title( $title ) {
		return str_replace( '<a', '<a class="text-link"', $title );
	}

}
