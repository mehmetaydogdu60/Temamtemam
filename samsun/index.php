<?php
/**
 * Main Template File
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
                if ( have_posts() ) :

                    if ( is_home() && ! is_front_page() ) :
                        ?>
                        <header>
                            <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                        </header>
                        <?php
                    endif;

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
