<?php
/**
 * Samsun Theme Functions
 *
 * @package Samsun
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'SAMSUN_VERSION', '1.0.0' );

/**
 * Theme Setup
 */
function samsun_setup() {
    load_theme_textdomain( 'samsun', get_template_directory() . '/languages' );

    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );
    add_theme_support( 'custom-background', array(
        'default-color' => 'ffffff',
    ) );
    add_theme_support( 'custom-header', array(
        'default-image' => '',
        'width'         => 1920,
        'height'        => 500,
        'flex-height'   => true,
        'flex-width'    => true,
    ) );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'editor-styles' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'align-wide' );

    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'samsun' ),
        'footer'  => esc_html__( 'Footer Menu', 'samsun' ),
    ) );

    add_image_size( 'samsun-featured', 1200, 600, true );
    add_image_size( 'samsun-thumbnail', 400, 300, true );
}
add_action( 'after_setup_theme', 'samsun_setup' );

/**
 * Set Content Width
 */
function samsun_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'samsun_content_width', 1200 );
}
add_action( 'after_setup_theme', 'samsun_content_width', 0 );

/**
 * Register Widget Areas
 */
function samsun_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'samsun' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'samsun' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget 1', 'samsun' ),
        'id'            => 'footer-1',
        'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'samsun' ),
        'before_widget' => '<section id="%1$s" class="footer-widget widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget 2', 'samsun' ),
        'id'            => 'footer-2',
        'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'samsun' ),
        'before_widget' => '<section id="%1$s" class="footer-widget widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget 3', 'samsun' ),
        'id'            => 'footer-3',
        'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'samsun' ),
        'before_widget' => '<section id="%1$s" class="footer-widget widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'samsun_widgets_init' );

/**
 * Enqueue Scripts and Styles
 */
function samsun_scripts() {
    wp_enqueue_style( 'samsun-style', get_stylesheet_uri(), array(), SAMSUN_VERSION );
    wp_enqueue_style( 'samsun-main', get_template_directory_uri() . '/assets/css/main.css', array(), SAMSUN_VERSION );

    wp_enqueue_script( 'samsun-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), SAMSUN_VERSION, true );
    wp_enqueue_script( 'samsun-main', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), SAMSUN_VERSION, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'samsun_scripts' );

/**
 * Custom Excerpt Length
 */
function samsun_excerpt_length( $length ) {
    return 40;
}
add_filter( 'excerpt_length', 'samsun_excerpt_length' );

/**
 * Custom Excerpt More
 */
function samsun_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'samsun_excerpt_more' );

/**
 * Add Custom Classes to Body
 */
function samsun_body_classes( $classes ) {
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    if ( is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'has-sidebar';
    } else {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}
add_filter( 'body_class', 'samsun_body_classes' );

/**
 * Pagination
 */
function samsun_pagination() {
    if ( is_singular() ) {
        return;
    }

    global $wp_query;

    if ( $wp_query->max_num_pages <= 1 ) {
        return;
    }

    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );

    if ( $paged >= 1 ) {
        $links[] = $paged;
    }

    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<div class="pagination"><div class="container">';

    if ( get_previous_posts_link() ) {
        printf( '<a href="%s">%s</a>', get_previous_posts_page_link(), '&laquo;' );
    }

    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="current"' : '';
        printf( '<a href="%s"%s>%s</a>', esc_url( get_pagenum_link( 1 ) ), $class, '1' );

        if ( ! in_array( 2, $links ) ) {
            echo '<span>...</span>';
        }
    }

    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="current"' : '';
        printf( '<a href="%s"%s>%s</a>', esc_url( get_pagenum_link( $link ) ), $class, $link );
    }

    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) ) {
            echo '<span>...</span>';
        }

        $class = $paged == $max ? ' class="current"' : '';
        printf( '<a href="%s"%s>%s</a>', esc_url( get_pagenum_link( $max ) ), $class, $max );
    }

    if ( get_next_posts_link() ) {
        printf( '<a href="%s">%s</a>', get_next_posts_page_link(), '&raquo;' );
    }

    echo '</div></div>';
}

/**
 * Posted On Meta
 */
function samsun_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf(
        $time_string,
        esc_attr( get_the_date( DATE_W3C ) ),
        esc_html( get_the_date() ),
        esc_attr( get_the_modified_date( DATE_W3C ) ),
        esc_html( get_the_modified_date() )
    );

    $posted_on = sprintf(
        '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
    );

    echo '<span class="posted-on">' . $posted_on . '</span>';
}

/**
 * Posted By Author
 */
function samsun_posted_by() {
    $byline = sprintf(
        '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
    );

    echo '<span class="byline"> ' . $byline . '</span>';
}

/**
 * Entry Categories
 */
function samsun_entry_footer() {
    if ( 'post' === get_post_type() ) {
        $categories_list = get_the_category_list( esc_html__( ', ', 'samsun' ) );
        if ( $categories_list ) {
            printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'samsun' ) . '</span>', $categories_list );
        }

        $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'samsun' ) );
        if ( $tags_list ) {
            printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'samsun' ) . '</span>', $tags_list );
        }
    }
}

/**
 * Include Customizer
 */
require get_template_directory() . '/inc/customizer.php';
