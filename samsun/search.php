<?php
/**
 * Search Results Template
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
                        <h1 class="page-title">
                            <?php
                            printf(
                                esc_html__( 'Arama Sonuçları: %s', 'samsun' ),
                                '<span>' . get_search_query() . '</span>'
                            );
                            ?>
                        </h1>
                    </header>

                    <?php
                    while ( have_posts() ) :
                        the_post();
                        get_template_part( 'template-parts/content', 'search' );
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
