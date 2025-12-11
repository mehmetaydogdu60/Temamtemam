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
    
    // Ana sayfa için özel CSS
    if ( is_front_page() ) {
        wp_enqueue_style( 'samsun-front-page', get_template_directory_uri() . '/assets/css/front-page.css', array(), SAMSUN_VERSION );
    }

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
 * Post Views Counter
 */
function samsun_set_post_views( $post_id ) {
    $count_key = 'post_views_count';
    $count = get_post_meta( $post_id, $count_key, true );
    
    if ( $count == '' ) {
        $count = 0;
        delete_post_meta( $post_id, $count_key );
        add_post_meta( $post_id, $count_key, '0' );
    } else {
        $count++;
        update_post_meta( $post_id, $count_key, $count );
    }
}

function samsun_get_post_views( $post_id ) {
    $count_key = 'post_views_count';
    $count = get_post_meta( $post_id, $count_key, true );
    
    if ( $count == '' ) {
        delete_post_meta( $post_id, $count_key );
        add_post_meta( $post_id, $count_key, '0' );
        return '0';
    }
    
    return $count;
}

// Track views on single posts
function samsun_track_post_views( $post_id ) {
    if ( ! is_single() ) return;
    if ( empty( $post_id ) ) {
        global $post;
        $post_id = $post->ID;
    }
    samsun_set_post_views( $post_id );
}
add_action( 'wp_head', 'samsun_track_post_views' );

/**
 * Add Default Categories on Theme Activation
 */
function samsun_create_default_categories() {
    // Check if categories already exist
    if ( get_option( 'samsun_default_categories_created' ) ) {
        return;
    }

    $default_categories = array(
        'Futbol' => array(
            'slug'        => 'futbol',
            'description' => 'Futbol haberleri ve maç sonuçları',
        ),
        'Basketbol' => array(
            'slug'        => 'basketbol',
            'description' => 'Basketbol haberleri ve skorlar',
        ),
        'Voleybol' => array(
            'slug'        => 'voleybol',
            'description' => 'Voleybol haberleri',
        ),
        'Transfer' => array(
            'slug'        => 'transfer',
            'description' => 'Transfer haberleri ve dedikodular',
        ),
        'Samsunspor' => array(
            'slug'        => 'samsunspor',
            'description' => 'Samsunspor haberleri',
        ),
        'Yerel Haberler' => array(
            'slug'        => 'yerel-haberler',
            'description' => 'Samsun yerel spor haberleri',
        ),
    );

    foreach ( $default_categories as $cat_name => $cat_data ) {
        if ( ! term_exists( $cat_name, 'category' ) ) {
            wp_insert_term(
                $cat_name,
                'category',
                array(
                    'slug'        => $cat_data['slug'],
                    'description' => $cat_data['description'],
                )
            );
        }
    }

    update_option( 'samsun_default_categories_created', true );
}
add_action( 'after_switch_theme', 'samsun_create_default_categories' );

/**
 * Create Default Pages on Theme Activation
 */
function samsun_create_default_pages() {
    // Check if pages already exist
    if ( get_option( 'samsun_default_pages_created' ) ) {
        return;
    }

    $default_pages = array(
        array(
            'post_title'   => 'Ana Sayfa',
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_name'    => 'ana-sayfa',
        ),
        array(
            'post_title'   => 'Hakkımızda',
            'post_content' => 'Samsunspor ve Samsun spor haberleri hakkında bilgi.',
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_name'    => 'hakkimizda',
        ),
        array(
            'post_title'   => 'İletişim',
            'post_content' => 'Bizimle iletişime geçin.',
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_name'    => 'iletisim',
        ),
        array(
            'post_title'   => 'Gizlilik Politikası',
            'post_content' => 'Gizlilik politikamız.',
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_name'    => 'gizlilik-politikasi',
        ),
    );

    foreach ( $default_pages as $page_data ) {
        // Check if page doesn't exist
        $page_check = get_page_by_title( $page_data['post_title'] );
        if ( ! isset( $page_check->ID ) ) {
            $page_id = wp_insert_post( $page_data );
            
            // Set Ana Sayfa as front page
            if ( $page_data['post_name'] === 'ana-sayfa' ) {
                update_option( 'page_on_front', $page_id );
                update_option( 'show_on_front', 'page' );
            }
        }
    }

    update_option( 'samsun_default_pages_created', true );
}
add_action( 'after_switch_theme', 'samsun_create_default_pages' );

/**
 * Add Reading Time
 */
function samsun_reading_time() {
    $content = get_post_field( 'post_content', get_the_ID() );
    $word_count = str_word_count( strip_tags( $content ) );
    $reading_time = ceil( $word_count / 200 );

    return $reading_time . ' dk okuma';
}

/**
 * Related Posts
 */
function samsun_related_posts( $post_id, $limit = 4 ) {
    $categories = wp_get_post_categories( $post_id );
    
    if ( empty( $categories ) ) {
        return;
    }

    $args = array(
        'category__in'   => $categories,
        'post__not_in'   => array( $post_id ),
        'posts_per_page' => $limit,
        'orderby'        => 'rand',
    );

    $related_query = new WP_Query( $args );

    if ( $related_query->have_posts() ) :
        echo '<section class="related-posts">';
        echo '<h3 class="related-title">İlgili Haberler</h3>';
        echo '<div class="related-posts-grid">';

        while ( $related_query->have_posts() ) : $related_query->the_post();
            ?>
            <article class="related-post-item">
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="related-post-image">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail( 'medium' ); ?>
                        </a>
                    </div>
                <?php endif; ?>
                <div class="related-post-content">
                    <h4 class="related-post-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                    <span class="related-post-date"><?php echo get_the_date(); ?></span>
                </div>
            </article>
            <?php
        endwhile;

        echo '</div>';
        echo '</section>';

        wp_reset_postdata();
    endif;
}

/**
 * Include Customizer
 */
require get_template_directory() . '/inc/customizer.php';
