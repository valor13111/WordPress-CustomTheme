<!-- can be used for wordpress hooks, or actual php functions -->
<?php

require_once('class-tgm-plugin-activation.php');

add_action('wp_head', 'save_background_color');
function save_background_color() {
  ?>

  <style type="text/css">
    body {
      background-color: <?php echo get_theme_mod('background_color', '#EEE'); ?>;
      color: <?php echo get_theme_mod('main_text_color'); ?>;
      background-image: url(<?php echo get_theme_mod('background_image'); ?>);
    }
  </style>

  <?php
}

add_action('init', 'create_post_type');
set_post_thumbnail_size(300, 300);
function create_post_type() {
  register_post_type('Custom Post Type',
    array(
      'labels'      =>  array(
        'name'          =>  __('Custom Post Type'),
        'singular_name' =>  __('Custom Post Types')
      ),
      'public'      =>  true,
      'has_archive' =>  true,
      'taxonomies'  =>  array(
        'category',
        'post_tag'),
      'supports'    =>  array(
        'custom-fields',
        'editor',
        'thumbnail'),
    )
  );
}

add_action('customize_register', 'initiate_customizer');
function initiate_customizer($wp_customize) {
  $wp_customize -> add_setting('company_name', array(
    'default'   =>  'Your Company',
    'transport' =>  'refresh',
  ));

  $wp_customize -> add_control(new WP_Customize_Control($wp_customize, 'company_textbox', array(
    'label'     =>  __('Your Company Name', 'complete-theme'),
    'section'   =>  'title_tagline',
    'settings'  =>  'company_name',
  )));

  # adds a new section in the customizer
  $wp_customize -> add_section('company', array(
    'title'     =>  __('Company Info.', 'complete-theme'),
    'priority'  =>  10,
  ));

  # adds a new setting to company info. section
  $wp_customize -> add_setting('company_color', array(
    'default'   =>  '#FF0000',
    'transport' =>  'refresh',
  ));

  # adds the control to see color change in customizer section
  $wp_customize -> add_control(new WP_Customize_Color_Control($wp_customize, 'company_color_control', array(
    'label'     =>  __('Color', 'complete-theme'),
    'section'   =>  'company',
    'settings'  =>  'company_color',
  )));

  $wp_customize -> add_setting('main_text_color', array(
    'default'   =>  '#000000',
    'transport' =>  'refresh'
  ));

  $wp_customize -> add_control(new WP_Customize_Color_Control($wp_customize, 'main_color_control', array(
    'label'     =>  __('Main text color', 'complete-theme'),
    'section'   =>  'colors',
    'settings'  =>  'main_text_color'
  )));

  # --------- special of the day ----------
  $wp_customize -> add_section('special_of_the_day', array(
    'title'     =>  __('Special of the Day', 'complete-theme'),
    'priority'  =>  10
  ));

  $wp_customize -> add_setting('special_of_the_day_colors', array(
    'default'   =>  '#FFFF00',
    'transport' =>  'refresh'
  ));

  $wp_customize -> add_setting('special_of_the_day_food', array(
    'default'   =>  'Our Special is Pizza!',
    'transport' =>  'refresh'
  ));

  $sotd_colors = array(
    'red'       =>  'Red',
    'lime'      =>  'Lime',
    'yellow'    =>  'Yellow'
  );

  asort($sotd_colors);

  $wp_customize -> add_control(new WP_Customize_Control($wp_customize, 'sotd_main_color', array(
    'label'     =>  __('Special of the Day Color', 'complete-theme'),
    'section'   =>  'special_of_the_day',
    'settings'  =>  'special_of_the_day_colors',
    'type'      =>  'radio',
    'choices'   =>  $sotd_colors
  )));

  $wp_customize -> add_control(new WP_Customize_Control($wp_customize, 'sotd_main_food', array(
    'label'     =>  __('Special of the Day Food', 'complete-theme'),
    'section'   =>  'special_of_the_day',
    'settings'  =>  'special_of_the_day_food',
  )));

  # --------- Google Maps ----------
  $wp_customize -> add_section('google_maps', array(
    'title'     =>  __('Your Location', 'complete-theme'),
    'priority'  =>  20
  ));

  $wp_customize -> add_setting('location', array(
    'default'   =>  'Find Your Way Here, Somewhere in the World',
    'transport' =>  'refresh'
  ));

  $wp_customize -> add_control(new WP_Customize_Control($wp_customize, 'google_map', array(
    'label'     =>  __('Location', 'complete-theme'),
    'section'   =>  'google_maps',
    'settings'  =>  'location'
  )));

  # --------- Hours of Operation ----------
  $wp_customize -> add_section('hours', array(
    'title'     =>  'Hours of Operation',
    'priority'  =>  1
  ));

  $wp_customize -> add_setting('hours_open', array(
    'default'   =>  '11:00 AM',
    'transport' =>  'refresh',
  ));

  $wp_customize -> add_setting('hours_close', array(
    'default'   =>  '10:00 PM',
    'transport' =>  'refresh',
  ));

  $hour_opened = array();
  $hour_closed = array();

  for ($i=7; $i < 11; $i++) {
    $hour_opened[$i] = $i;
  }

  for ($i=4; $i < 10; $i++) {
    $hour_closed[$i] = $i;
  }

  $wp_customize -> add_control(new WP_Customize_Control($wp_customize, 'hours_of_operation_opening', array(
    'label'     =>  __('Hours Opening Time', 'complete-theme'),
    'section'   =>  'hours',
    'settings'  =>  'hours_open',
    'type'      =>  'select',
    'choices'   =>  $hour_opened
  )));

  $wp_customize -> add_control(new WP_Customize_Control($wp_customize, 'hours_of_operation_closing', array(
    'label'     =>  __('Hours Closing Time', 'complete-theme'),
    'section'   =>  'hours',
    'settings'  =>  'hours_close',
    'type'      =>  'select',
    'choices'   =>  $hour_closed
  )));
}


function submenus() {
  wp_deregister_script('jquery');
  wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js", false, null);
  wp_enqueue_script('script-name', get_template_directory_uri(). '/js/submenus.js', array('jquery'), '1.0.0', true);
}

add_action('wp_enqueue_scripts', 'submenus');

add_theme_support('post-thumbnails');
add_theme_support('custom-header');
add_theme_support('custom-background');
add_theme_support('menus');
add_theme_support('post-formats', array('aside', 'image', 'video'));
add_theme_support('title-tag');

register_nav_menus(
  array(
    'header_menu'   => 'Header Menu',
    'footer_menu'   => 'Footer Menu',
    'left_sidebar'  => 'Sidebar Menu',
    'right_sidebar' => 'Right Sidebar Menu'
  )
);

$html5_support = array('search-form', 'comment-form', 'gallery', 'comment-list', 'caption');
add_theme_support('html5', $html5_support);

function the_current_year() {
  $this_year = Date('Y');

  return $this_year;
}

?>

<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Complete Theme
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once dirname( __FILE__ ) . '/path/to/class-tgm-plugin-activation.php';
 */
/*require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';*/

add_action( 'tgmpa_register', 'complete_theme_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function complete_theme_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin bundled with a theme.
		array(
			'name'               => 'TGM Example Plugin', // The plugin name.
			'slug'               => 'tgm-example-plugin', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/lib/plugins/tgm-example-plugin.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),

    // This is an example of how to include a plugin bundled with a theme.
		array(
			'name'               => 'Beaver Builder', // The plugin name.
			'slug'               => 'beaver-builder-lite-version', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/included-plugins/beaver-builder-lite-version.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '1.9.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),

		// This is an example of how to include a plugin from an arbitrary external source in your theme.
		array(
			'name'         => 'TGM New Media Plugin', // The plugin name.
			'slug'         => 'tgm-new-media-plugin', // The plugin slug (typically the folder name).
			'source'       => 'https://s3.amazonaws.com/tgm/tgm-new-media-plugin.zip', // The plugin source.
			'required'     => true, // If false, the plugin is only 'recommended' instead of required.
			'external_url' => 'https://github.com/thomasgriffin/New-Media-Image-Uploader', // If set, overrides default API URL and points to an external URL.
		),

		// This is an example of how to include a plugin from a GitHub repository in your theme.
		// This presumes that the plugin code is based in the root of the GitHub repository
		// and not in a subdirectory ('/src') of the repository.
		array(
			'name'      => 'Adminbar Link Comments to Pending',
			'slug'      => 'adminbar-link-comments-to-pending',
			'source'    => 'https://github.com/jrfnl/WP-adminbar-comments-to-pending/archive/master.zip',
		),

		// This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
			'name'      => 'BuddyPress',
			'slug'      => 'buddypress',
			'required'  => false,
		),

		// This is an example of the use of 'is_callable' functionality. A user could - for instance -
		// have WPSEO installed *or* WPSEO Premium. The slug would in that last case be different, i.e.
		// 'wordpress-seo-premium'.
		// By setting 'is_callable' to either a function from that plugin or a class method
		// `array( 'class', 'method' )` similar to how you hook in to actions and filters, TGMPA can still
		// recognize the plugin as being installed.
		array(
			'name'        => 'WordPress SEO by Yoast',
			'slug'        => 'wordpress-seo',
			'is_callable' => 'wpseo_init',
		),

    array(
      'name'        => 'Beaver Builder - Wordpress Page Builder',
      'slug'        => 'beaver-builder-lite-version',
      'required'    => true,
    ),

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'complete-theme',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

		/*
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'complete-theme' ),
			'menu_title'                      => __( 'Install Plugins', 'complete-theme' ),
			/* translators: %s: plugin name. * /
			'installing'                      => __( 'Installing Plugin: %s', 'complete-theme' ),
			/* translators: %s: plugin name. * /
			'updating'                        => __( 'Updating Plugin: %s', 'complete-theme' ),
			'oops'                            => __( 'Something went wrong with the plugin API.', 'complete-theme' ),
			'notice_can_install_required'     => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'complete-theme'
			),
			'notice_can_install_recommended'  => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'complete-theme'
			),
			'notice_ask_to_update'            => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'complete-theme'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				/* translators: 1: plugin name(s). * /
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'complete-theme'
			),
			'notice_can_activate_required'    => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'complete-theme'
			),
			'notice_can_activate_recommended' => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'complete-theme'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'complete-theme'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'complete-theme'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'complete-theme'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'complete-theme' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'complete-theme' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'complete-theme' ),
			/* translators: 1: plugin name. * /
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'complete-theme' ),
			/* translators: 1: plugin name. * /
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'complete-theme' ),
			/* translators: 1: dashboard link. * /
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'complete-theme' ),
			'dismiss'                         => __( 'Dismiss this notice', 'complete-theme' ),
			'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'complete-theme' ),
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'complete-theme' ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
		*/
	);

	tgmpa( $plugins, $config );
}
