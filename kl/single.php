<?php
/**
 * Single Post Template
 *
 * @package Samsun
 */

get_header();
?>

<div class="site-content">
    <div class="container">
        <div class="content-area">
            <main id="main" class="site-main">

                <?php
                while ( have_posts() ) :
                    the_post();

                    get_template_part( 'template-parts/content', 'single' );

                    // İlgili Haberler
                    samsun_related_posts( get_the_ID(), 4 );

                    the_post_navigation(
                        array(
                            'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Önceki:', 'samsun' ) . '</span> <span class="nav-title">%title</span>',
                            'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Sonraki:', 'samsun' ) . '</span> <span class="nav-title">%title</span>',
                        )
                    );

                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;

                endwhile;
                ?>

            </main>

            <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php
get_footer();
