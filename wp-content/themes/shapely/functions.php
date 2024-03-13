<?php

/**
 * Shapely functions and definitions.
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Shapely
 */
if ( ! function_exists( 'shapely_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function shapely_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Shapely, use a find and replace
		 * to change 'shapely' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'shapely', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Add support for the custom logo functionality
		 */
		add_theme_support(
			'custom-logo', array(
				'height'      => 55,
				'width'       => 135,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		add_theme_support(
			'custom-header', apply_filters(
				'shapely_custom_header_args', array(
					'default-image'      => '',
					'default-text-color' => '000000',
					'width'              => 1900,
					'height'             => 225,
					'flex-width'         => true,
				)
			)
		);

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary'     => esc_html__( 'Primary', 'shapely' ),
				'social-menu' => esc_html__( 'Social Menu', 'shapely' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background', apply_filters(
				'shapely_custom_background_args', array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'shapely-full', 1110, 530, true );
		add_image_size( 'shapely-featured', 730, 350, true );
		add_image_size( 'shapely-grid', 350, 300, true );

		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		add_theme_support( 'customize-selective-refresh-widgets' );

		// Enable Shortcodes in widgets
		add_filter( 'widget_text', 'do_shortcode' );

	}
endif;
add_action( 'after_setup_theme', 'shapely_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function shapely_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'shapely_content_width', 1140 );
}

add_action( 'after_setup_theme', 'shapely_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function shapely_widgets_init() {
	register_sidebar(
		array(
			'id'            => 'sidebar-1',
			'name'          => esc_html__( 'Sidebar', 'shapely' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'id'            => 'sidebar-home',
			'name'          => esc_html__( 'Homepage', 'shapely' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	for ( $i = 1; $i < 5; $i ++ ) {
		register_sidebar(
			array(
				'id'            => 'footer-widget-' . $i,
				'name'          => sprintf( esc_html__( 'Footer Widget %s', 'shapely' ), $i ),
				'description'   => esc_html__( 'Used for footer widget area', 'shapely' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
	}

	if ( shapely_is_woocommerce_activated() ) {
		register_sidebar(
			array(
				'id'            => 'shop-sidebar',
				'name'          => esc_html__( 'Shop Sidebar', 'shapely' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
	}

}

add_action( 'widgets_init', 'shapely_widgets_init' );

/**
 * Hides the custom post template for pages on WordPress 4.6 and older
 *
 * @param array $post_templates Array of page templates. Keys are filenames, values are translated names.
 *
 * @return array Filtered array of page templates.
 */
function shapely_exclude_page_templates( $post_templates ) {

	if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
		unset( $post_templates['page-templates/full-width.php'] );
		unset( $post_templates['page-templates/no-sidebar.php'] );
		unset( $post_templates['page-templates/sidebar-left.php'] );
		unset( $post_templates['page-templates/sidebar-right.php'] );
	}

	return $post_templates;
}

add_filter( 'theme_page_templates', 'shapely_exclude_page_templates' );

/**
 * Enqueue scripts and styles.
 */
function shapely_scripts() {

	// Add Bootstrap default CSS
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );

	// Add Font Awesome stylesheet
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/fontawesome/all.min.css' );

	// Add Google Fonts
	wp_enqueue_style( 'shapely-fonts', '//fonts.googleapis.com/css?family=Raleway:100,300,400,500,600,700&display=swap');

	// Add slider CSS
	wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/assets/css/flexslider.css' );

	//Add custom theme css
	wp_enqueue_style( 'shapely-style', get_stylesheet_uri() );

	wp_enqueue_script( 'shapely-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20160115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( post_type_exists( 'jetpack-portfolio' ) ) {
		wp_enqueue_script( 'jquery-masonry' );
	}

	// Add slider JS
	wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/assets/js/flexslider.min.js', array( 'jquery' ), '20160222', true );

	if ( is_page_template( 'page-templates/template-home.php' ) || is_page_template( 'page-templates/template-widget.php' ) ) {
		wp_enqueue_script( 'shapely-parallax', get_template_directory_uri() . '/assets/js/parallax.min.js', array( 'jquery' ), '20160115', true );
	}
	/**
	 * OwlCarousel Library
	 */
	wp_enqueue_script( 'owl.carousel', get_template_directory_uri() . '/assets/js/owl-carousel/owl.carousel.min.js', array( 'jquery' ), '20160115', true );
	wp_enqueue_style( 'owl.carousel', get_template_directory_uri() . '/assets/js/owl-carousel/owl.carousel.min.css' );
	wp_enqueue_style( 'owl.carousel.theme', get_template_directory_uri() . '/assets/js/owl-carousel/owl.theme.default.css' );

	wp_enqueue_script(
		'shapely-scripts', get_template_directory_uri() . '/assets/js/shapely-scripts.js', array(
			'jquery',
			'imagesloaded',
		), '20180423', true
	);

	/**
	 * @since 1.2.2
	 */
	wp_localize_script(
		'shapely-scripts', 'ShapelyAdminObject',
		array(
			'sticky_header' => get_theme_mod( 'shapely_sticky_header', 1 ),
		)
	);
}

add_action( 'wp_enqueue_scripts', 'shapely_scripts' );

if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load custom nav walker
 */
require get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

/**
 * Load Social Navition
 */
require get_template_directory() . '/inc/socialnav.php';

/**
 * Load related posts
 */
require get_template_directory() . '/inc/class-shapely-related-posts.php';

/**
 * Load the shapely class
 */
require get_template_directory() . '/inc/class-shapely.php';

/**
 * Load the shapely page builder class
 */
require get_template_directory() . '/inc/class-shapely-builder.php';
Shapely_Builder::get_instance();








function add_event_on_contact_form_submit($form_data) {
	$errorLogPath = get_template_directory() . '/google_calendar_error.log';
	error_log('Error creating Google Calendar event: ' . $e->getMessage(), 3, $errorLogPath);
	
    // Check if the contact form submission is successful
    if ($form_data['status'] === 'success') {
        // Load the Google API PHP Client Library
        require_once get_template_directory() . '/googleCalendar/vendor/autoload.php';

        // Set up authentication
        $client = new Google_Client();
        $client->setAuthConfig(get_template_directory() . '/googleCalendar/client_secret_69719740503-js06c3upvf71su59nnkve8e970doouh9.apps.googleusercontent.com.json');
        $client->addScope(Google_Service_Calendar::CALENDAR);

        // Authorize with OAuth 2.0
        $client->fetchAccessTokenWithAssertion();

        // Get access token
        $accessToken = $client->getAccessToken()['access_token'];

        // Get subscribers' email addresses
        $subscribers = get_users(array(
            'role' => 'subscriber',
            'fields' => array('user_email'),
        ));

        // Open log file for writing (append mode)
        // Specify the path to the error log file inside the theme folder
        $errorLogPath = get_template_directory() . '/google_calendar_error.log';

        // Open log file for writing (append mode)
        $logFile = fopen($errorLogPath, 'a');

        // Create the event and log success/failure
        foreach ($subscribers as $subscriber) {
            // Get the title and time from the contact form data
            $title = $form_data['title']; // Assuming 'title' is a field in your contact form
            $startDateTime = $form_data['start_datetime']; // Assuming 'start_datetime' is a field in your contact form
            $endDateTime = $form_data['end_datetime']; // Assuming 'end_datetime' is a field in your contact form
            
            // Create the event
            $result = addEventToGoogleCalendar($accessToken, $title, $startDateTime, $endDateTime, $subscriber->user_email);
            
            // Log the event creation result
            $logMessage = "[" . date('Y-m-d H:i:s') . "] Event for user " . $subscriber->user_email . ": " . ($result ? "Success" : "Failure") . "\n";
            fwrite($logFile, $logMessage);
        }

        // Close the log file
        fclose($logFile);
    }
}

// Hook the function to the 'contact_form_submit' action
add_action('contact_form_submit', 'add_event_on_contact_form_submit');

// Function to add event to Google Calendar
function addEventToGoogleCalendar($accessToken, $summary, $startDateTime, $endDateTime, $attendeeEmail) {
    try {
        $client = new Google_Client();
        $client->setAccessToken($accessToken);

        $service = new Google_Service_Calendar($client);

        $event = new Google_Service_Calendar_Event(array(
            'summary' => $summary,
            'start' => array(
                'dateTime' => $startDateTime,
                'timeZone' => 'Your Time Zone',
            ),
            'end' => array(
                'dateTime' => $endDateTime,
                'timeZone' => 'Your Time Zone',
            ),
            'attendees' => array(
                array('email' => $attendeeEmail),
            ),
        ));

        $calendarId = 'primary'; // You can use 'primary' for the primary calendar of the authenticated user

        // Insert the event
        $event = $service->events->insert($calendarId, $event);
        
        // Log success to a file
        $errorLogPath = get_template_directory() . '/google_calendar_error.log';
        error_log('Success creating Google Calendar event: ' . $event->htmlLink, 3, $errorLogPath);
        
        return true; // Event creation successful
    } catch (Exception $e) {
        // Log error to a file
        $errorLogPath = get_template_directory() . '/google_calendar_error.log';
        error_log('Error creating Google Calendar event: ' . $e->getMessage(), 3, $errorLogPath);
        
        return false; // Event creation failed
	}
}




function add_event_on_post_publish($post_id) {
    if (get_post_status($post_id) === 'publish') {
        // Load the Google API PHP Client Library
        require_once get_template_directory() . '/googleCalendar/vendor/autoload.php';
    
        // Set up authentication
        $client = new Google_Client();
        $client->setAuthConfig(get_template_directory() . '/googleCalendar/client_secret_69719740503-js06c3upvf71su59nnkve8e970doouh9.apps.googleusercontent.com.json');
        $client->addScope(Google_Service_Calendar::CALENDAR);
    
        // Authorize with OAuth 2.0
        $client->fetchAccessTokenWithAssertion();
    
        // Get access token
        $accessToken = $client->getAccessToken()['access_token'];
    
        // Get subscribers' email addresses 
        $subscribers = get_users(array(
            'role' => 'subscriber',
            'fields' => array('user_email'),
        ));
    
        // Open log file for writing (append mode)
        // Specify the path to the error log file inside the theme folder
        $errorLogPath = get_template_directory() . '/google_calendar_error.log';
    
        // Open log file for writing (append mode)
        $logFile = fopen($errorLogPath, 'a');
    
        // Create the event and log success/failure
        foreach ($subscribers as $subscriber) {
            $result = addEventToGoogleCalendarEvent($accessToken, get_the_title($post_id), date('c'), date('c', strtotime('+1 hour')), $subscriber->user_email);
            $logMessage = "[" . date('Y-m-d H:i:s') . "] Event for user " . $subscriber->user_email . ": " . ($result ? "Success" : "Failure") . "\n";
            fwrite($logFile, $logMessage);
        }
        fwrite($logFile, "test");
        // Close the log file
        fclose($logFile);
    }
}

// Hook the function to the 'publish_post' action
add_action('publish_post', 'add_event_on_post_publish', 10, 1);

// Function to add event to Google Calendar
function addEventToGoogleCalendarEvent($accessToken, $summary, $startDateTime, $endDateTime, $attendeeEmail) {
    try {
        $client = new Google_Client();
        $client->setAccessToken($accessToken);

        $service = new Google_Service_Calendar($client);

        $event = new Google_Service_Calendar_Event(array(
            'summary' => $summary,
            'start' => array(
                'dateTime' => $startDateTime,
                'timeZone' => 'Your Time Zone',
            ),
            'end' => array(
                'dateTime' => $endDateTime,
                'timeZone' => 'Your Time Zone',
            ),
            'attendees' => array(
                array('email' => $attendeeEmail),
            ),
        ));

        $calendarId = 'primary'; // You can use 'primary' for the primary calendar of the authenticated user

        $event = $service->events->insert($calendarId, $event);
		$errorLogPath = get_template_directory() . '/google_calendar_error.log';
        error_log('Success creating Google Calendar event: ' . $e->getMessage(), 3, $errorLogPath); // Log error to a file
        return false; // Event creation failed
        echo 'Event created: ' . $event->htmlLink;
        return true; // Event creation successful
    } catch (Exception $e) {
        $errorLogPath = get_template_directory() . '/google_calendar_error.log';
        error_log('Error creating Google Calendar event: ' . $e->getMessage(), 3, $errorLogPath); // Log error to a file
        return false; // Event creation failed
    }
}
