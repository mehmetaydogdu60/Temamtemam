<?php
/**
 * Template part for displaying search results
 *
 * @package Samsun
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail( 'samsun-thumbnail' ); ?>
            </a>
        </div>
    <?php endif; ?>

    <header class="entry-header">
        <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

        <?php if ( 'post' === get_post_type() ) : ?>
            <div class="entry-meta">
                <?php
                samsun_posted_on();
                samsun_posted_by();
                ?>
            </div>
        <?php endif; ?>
    </header>

    <div class="entry-content">
        <?php the_excerpt(); ?>
    </div>

    <div class="entry-footer">
        <?php samsun_entry_footer(); ?>
        <a href="<?php the_permalink(); ?>" class="read-more">
            <?php esc_html_e( 'Devamını Oku', 'samsun' ); ?> &rarr;
        </a>
    </div>
</article>
