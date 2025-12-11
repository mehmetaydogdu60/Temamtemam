<?php
/**
 * Archive Template
 *
 * @package Samsun
 */

get_header();
?>

<div class="site-content">
    <div class="container">
        <div class="content-area">
            <main id="main" class="site-main">

                <?php if ( have_posts() ) : ?>

                    <header class="page-header">
                        <?php
                        the_archive_title( '<h1 class="page-title">', '</h1>' );
                        the_archive_description( '<div class="archive-description">', '</div>' );
                        ?>
                    </header>

                    <?php
                    while ( have_posts() ) :
                        the_post();
                        get_template_part( 'template-parts/content', get_post_type() );
                    endwhile;

                    samsun_pagination();

                else :

                    get_template_part( 'template-parts/content', 'none' );

                endif;
                ?>

            </main>

            <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php
get_footer();
