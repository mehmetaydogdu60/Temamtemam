<?php
/**
 * Footer Template
 *
 * @package Samsun
 */
?>

    <footer id="colophon" class="site-footer">
        <?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) : ?>
            <div class="footer-widgets">
                <div class="container">
                    <div class="footer-widgets">
                        <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                            <div class="footer-widget-area">
                                <?php dynamic_sidebar( 'footer-1' ); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                            <div class="footer-widget-area">
                                <?php dynamic_sidebar( 'footer-2' ); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                            <div class="footer-widget-area">
                                <?php dynamic_sidebar( 'footer-3' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="site-info">
            <div class="container">
                <p>
                    <?php
                    printf(
                        esc_html__( '&copy; %1$s %2$s. Tüm hakları saklıdır.', 'samsun' ),
                        date( 'Y' ),
                        get_bloginfo( 'name' )
                    );
                    ?>
                    <?php if ( get_theme_mod( 'samsun_footer_text' ) ) : ?>
                        <span class="sep"> | </span>
                        <?php echo wp_kses_post( get_theme_mod( 'samsun_footer_text' ) ); ?>
                    <?php else : ?>
                        <span class="sep"> | </span>
                        <?php
                        printf(
                            esc_html__( 'Tema: %1$s - %2$s', 'samsun' ),
                            'Samsun',
                            '<a href="https://dedicode.net">Dedicode</a>'
                        );
                        ?>
                    <?php endif; ?>
                </p>
            </div>
        </div>
    </footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
