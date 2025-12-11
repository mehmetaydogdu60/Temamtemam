<?php
/**
 * Template part for displaying a message when no content is found
 *
 * @package Samsun
 */
?>

<section class="no-results not-found">
    <header class="page-header">
        <h1 class="page-title"><?php esc_html_e( 'Hiçbir Şey Bulunamadı', 'samsun' ); ?></h1>
    </header>

    <div class="page-content">
        <?php
        if ( is_home() && current_user_can( 'publish_posts' ) ) :

            printf(
                '<p>' . wp_kses(
                    __( 'Başlamaya hazır mısınız? <a href="%1$s">İlk yazınızı yazın</a>.', 'samsun' ),
                    array(
                        'a' => array(
                            'href' => array(),
                        ),
                    )
                ) . '</p>',
                esc_url( admin_url( 'post-new.php' ) )
            );

        elseif ( is_search() ) :
            ?>

            <p><?php esc_html_e( 'Üzgünüz, aramanızla eşleşen bir sonuç bulunamadı. Lütfen farklı anahtar kelimelerle tekrar deneyin.', 'samsun' ); ?></p>
            <?php
            get_search_form();

        else :
            ?>

            <p><?php esc_html_e( 'Aradığınız içerik bulunamadı. Lütfen arama kutusunu kullanarak tekrar deneyin.', 'samsun' ); ?></p>
            <?php
            get_search_form();

        endif;
        ?>
    </div>
</section>
