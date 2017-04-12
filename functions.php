<?php

// Enqueue scripts

function amd_load_scripts() {
//	wp_enqueue_script('jqm_js', 'http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js', array('jquery'), '1.2.0');
	wp_enqueue_script('amd-mobile', get_template_directory_uri() . '/js/mobile.js', array('jquery'));
	wp_enqueue_script('amd-slideshow', get_template_directory_uri() . '/js/slideshow.js', array('jquery'));
	
}

add_action('wp_enqueue_scripts', 'amd_load_scripts');


// Add widget support

function amd_widgets_init() {
	register_sidebar( array (
	'name' => __( 'Sidebar Widget Area', 'amd' ),
	'id' => 'primary-widget-area',
	'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
	'after_widget' => "</li>",
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	) );
	
	// New in-page grid widget ara
	register_sidebar( array (
		'name' => __( 'In-Page Grid Area', 'amd' ),
		'id' => 'in-page-widget-area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => "</li>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
}
add_action( 'widgets_init', 'amd_widgets_init' );

// Language suppport, feed links, thumbnails.
function amd_setup() {
	load_theme_textdomain( 'amd', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	register_nav_menu('custom', 'Custom Menu');
}
add_action( 'after_setup_theme', 'amd_setup' );

// Enable font size & font family selects in the editor
if ( ! function_exists( 'wpex_mce_buttons' ) ) {
	function wpex_mce_buttons( $buttons ) {
		array_unshift( $buttons, 'fontsizeselect' ); // Add Font Size Select
		return $buttons;
	}
}
add_filter( 'mce_buttons_2', 'wpex_mce_buttons' );

// Use featured image as background image

function amd_set_background_image($page_id) {
	$post_type = get_post_type($page_id);
	if ($post_type == 'post') {
		$featured_image_id = get_post_thumbnail_id(get_option('page_for_posts'));
	} else {
		$featured_image_id = get_post_thumbnail_id($page_id);
	}
	if (!empty($featured_image_id)) {
		$image_url = wp_get_attachment_image_src($featured_image_id, "Full");
		echo 'style="background-image: url(' . $image_url[0] .'); background-repeat: no-repeat; background-position: right top;"';		
	}
}

// Add flush-left class for images

add_filter('tiny_mce_before_init', 'add_custom_classes');
function add_custom_classes($arr_options) {
	$arr_options['theme_advanced_styles'] = "Flush Left=flushleft;";
	$arr_options['theme_advanced_buttons2_add_before'] = "styleselect";
	return $arr_options;
}

// Check for custom sidebar

function amd_get_custom_sidebar($post_id) {
	
	$home_page_id = get_option('page_on_front');

	$custom_sidebar = '';
	
	$sidebar_content = get_post_meta($post_id, '_amd_bulletlist', true);
	
	if (!empty($sidebar_content)) {
		$custom_sidebar = ($home_page_id != $post_id) ? '<div id="bullet-box"><div id="bullets">' . $sidebar_content . '</div></div>' : '<div id="homepage-callout">' . $sidebar_content . '</div>' ;
	} 
	
	echo $custom_sidebar;
}

// Check for footer quote

function amd_get_footer_quote($post_id) {

	$footer_quote = '';
	
	$footer_quote_content = get_post_meta($post_id, '_amd_footer_quote', true);
	
	if (!empty($footer_quote_content)) {
		$footer_quote = '<div id="quote"><p>' . $footer_quote_content . "</p>";
		$footer_quote .= '<div id="attribute">&mdash; ' . get_post_meta($post_id, '_amd_quote_attribution', true) . '</div>';
		$footer_quote .= '</div>';
	}
	
	echo $footer_quote;
}

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
/* Define the custom box */
add_action( 'add_meta_boxes', 'amd_add_custom_box' );

/* Do something with the data entered */
add_action( 'save_post', 'amd_save_postdata' );

/* Adds a box to the main column on the Post and Page edit screens */
function amd_add_custom_box() {
  add_meta_box( 'amd_bulletlist_box', 'Info Sidebar', 'wp_editor_meta_box', 'page', 'normal', 'high' );
  add_meta_box( 'amd_footer_quote_box', 'Footer Quote', 'footer_quote_meta_box', 'page', 'normal', 'high' );
  add_meta_box( 'amd_quote_attribution_box', 'Quote Attribution', 'quote_attribution_meta_box', 'page', 'normal', 'high' );
}

/* Prints the sidebar bullet list content */
function wp_editor_meta_box( $post ) {

  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'amd_noncename' );

  $field_value = get_post_meta( $post->ID, '_amd_bulletlist', true );
  wp_editor( $field_value, '_amd_bulletlist' );
}

/* Prints the quote at the bottom */

function footer_quote_meta_box( $post ) {
	// Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'amd_noncename' );

  $field_value = get_post_meta( $post->ID, '_amd_footer_quote', true );
  $settings = array('media_buttons' => false, 'textarea_rows' => 5);
  wp_editor( $field_value, '_amd_footer_quote', $settings );
}

function quote_attribution_meta_box( $post ) {
// Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'amd_noncename' );
  $field_value = get_post_meta( $post->ID, '_amd_quote_attribution', true );
  echo "<input type='text' size='30' name='_amd_quote_attribution' value='$field_value'>";

}

/* Comments Number */


function amd_comments_number( $count ) {
	if ( !is_admin() ) {
		global $id;
		$comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
		return count( $comments_by_type['comment'] );
	} else {
		return $count;
	}
}
add_filter( 'get_comments_number', 'amd_comments_number' );

/* WP Title */

function amd_filter_wp_title( $title ) {
	return $title . esc_attr( get_bloginfo( 'name' ) );
}
add_filter( 'wp_title', 'amd_filter_wp_title' );

/* Comment Reply Script */
function amd_enqueue_comment_reply_script() {
	if ( get_option( 'thread_comments' ) ) { 
		wp_enqueue_script( 'comment-reply' ); 
	}
}
add_action( 'comment_form_before', 'amd_enqueue_comment_reply_script' );



/* When the post is saved, saves our custom data */
function amd_save_postdata( $post_id ) {

  // verify if this is an auto save routine. 
  // If it is our form has not been submitted, so we dont want to do anything
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;

  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times
  if ( ( isset ( $_POST['amd_noncename'] ) ) && ( ! wp_verify_nonce( $_POST['amd_noncename'], plugin_basename( __FILE__ ) ) ) )
      return;

  // Check permissions
  if ( ( isset ( $_POST['post_type'] ) ) && ( 'page' == $_POST['post_type'] )  ) {
    if ( ! current_user_can( 'edit_page', $post_id ) ) {
      return;
    }    
  }
  else {
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
      return;
    }
  }

  // OK, we're authenticated: we need to find and save the data
  if ( isset ( $_POST['_amd_bulletlist'] ) ) {
    update_post_meta( $post_id, '_amd_bulletlist', $_POST['_amd_bulletlist'] );
    update_post_meta( $post_id, '_amd_footer_quote', $_POST['_amd_footer_quote'] );
    update_post_meta( $post_id, '_amd_quote_attribution', $_POST['_amd_quote_attribution'] );
  }

}

/*
add_action( 'comment_form_before', 'blankslate_enqueue_comment_reply_script' );
function blankslate_enqueue_comment_reply_script()
{
if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
add_filter( 'the_title', 'blankslate_title' );
function blankslate_title( $title ) {
if ( $title == '' ) {
return '&rarr;';
} else {
return $title;
}
}
add_filter( 'wp_title', 'blankslate_filter_wp_title' );
function blankslate_filter_wp_title( $title )
{
return $title . esc_attr( get_bloginfo( 'name' ) );
}
add_action( 'widgets_init', 'blankslate_widgets_init' );
function blankslate_widgets_init()
{
register_sidebar( array (
'name' => __( 'Sidebar Widget Area', 'blankslate' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}
function blankslate_custom_pings( $comment )
{
$GLOBALS['comment'] = $comment;
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php 
}
*/