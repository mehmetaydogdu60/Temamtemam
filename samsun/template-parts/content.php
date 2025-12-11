<?php
/**
 * Template part for displaying posts
 *
 * @package Samsun
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail( 'samsun-featured' ); ?>
            </a>
        </div>
    <?php endif; ?>

    <header class="entry-header">
        <?php
        if ( is_singular() ) :
            the_title( '<h1 class="entry-title">', '</h1>' );
        else :
            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        endif;

        if ( 'post' === get_post_type() ) :
            ?>
            <div class="entry-meta">
                <?php
                samsun_posted_on();
                samsun_posted_by();
                ?>
            </div>
            <?php
        endif;
        ?>
    </header>

    <div class="entry-content">
        <?php
        if ( is_singular() ) :
            the_content(
                sprintf(
                    wp_kses(
                        __( 'Devamını oku<span class="screen-reader-text"> "%s"</span>', 'samsun' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post( get_the_title() )
                )
            );

            wp_link_pages(
                array(
                    'before' => '<div class="page-links">' . esc_html__( 'Sayfalar:', 'samsun' ),
                    'after'  => '</div>',
                )
            );
        else :
            the_excerpt();
        endif;
        ?>
    </div>

    <?php if ( ! is_singular() ) : ?>
        <div class="entry-footer">
            <?php samsun_entry_footer(); ?>
            <a href="<?php the_permalink(); ?>" class="read-more">
                <?php esc_html_e( 'Devamını Oku', 'samsun' ); ?> &rarr;
            </a>
        </div>
    <?php endif; ?>
</article>
