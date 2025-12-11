<?php
/**
 * 404 Error Page Template
 *
 * @package Samsun
 */

get_header();
?>

<div class="site-content">
    <div class="container">
        <main id="main" class="site-main">

            <section class="error-404 not-found">
                <header class="page-header">
                    <h1 class="page-title"><?php esc_html_e( '404', 'samsun' ); ?></h1>
                    <p><?php esc_html_e( 'Üzgünüz, aradığınız sayfa bulunamadı.', 'samsun' ); ?></p>
                </header>

                <div class="page-content">
                    <p><?php esc_html_e( 'Aradığınız sayfa taşınmış, silinmiş veya hiç var olmamış olabilir.', 'samsun' ); ?></p>

                    <?php get_search_form(); ?>

                    <div class="widget widget_categories">
                        <h2 class="widget-title"><?php esc_html_e( 'Kategoriler', 'samsun' ); ?></h2>
                        <ul>
                            <?php
                            wp_list_categories(
                                array(
                                    'orderby'    => 'count',
                                    'order'      => 'DESC',
                                    'show_count' => 1,
                                    'title_li'   => '',
                                    'number'     => 10,
                                )
                            );
                            ?>
                        </ul>
                    </div>

                    <div class="widget widget_recent_entries">
                        <h2 class="widget-title"><?php esc_html_e( 'Son Yazılar', 'samsun' ); ?></h2>
                        <ul>
                            <?php
                            wp_get_archives(
                                array(
                                    'type'  => 'postbypost',
                                    'limit' => 10,
                                )
                            );
                            ?>
                        </ul>
                    </div>
                </div>
            </section>

        </main>
    </div>
</div>

<?php
get_footer();
