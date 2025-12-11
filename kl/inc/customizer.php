<?php
/**
 * Theme Customizer
 *
 * @package Samsun
 */

function samsun_customize_register( $wp_customize ) {

    // Add Color Section
    $wp_customize->add_section( 'samsun_colors', array(
        'title'    => __( 'Tema Renkleri', 'samsun' ),
        'priority' => 30,
    ) );

    // Primary Color
    $wp_customize->add_setting( 'samsun_primary_color', array(
        'default'           => '#e30613',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'samsun_primary_color', array(
        'label'    => __( 'Ana Renk', 'samsun' ),
        'section'  => 'samsun_colors',
        'settings' => 'samsun_primary_color',
    ) ) );

    // Secondary Color
    $wp_customize->add_setting( 'samsun_secondary_color', array(
        'default'           => '#1a1a1a',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'samsun_secondary_color', array(
        'label'    => __( 'İkincil Renk', 'samsun' ),
        'section'  => 'samsun_colors',
        'settings' => 'samsun_secondary_color',
    ) ) );

    // Accent Color
    $wp_customize->add_setting( 'samsun_accent_color', array(
        'default'           => '#ffd700',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'samsun_accent_color', array(
        'label'    => __( 'Vurgu Rengi', 'samsun' ),
        'section'  => 'samsun_colors',
        'settings' => 'samsun_accent_color',
    ) ) );

    // Text Color
    $wp_customize->add_setting( 'samsun_text_color', array(
        'default'           => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'samsun_text_color', array(
        'label'    => __( 'Metin Rengi', 'samsun' ),
        'section'  => 'samsun_colors',
        'settings' => 'samsun_text_color',
    ) ) );

    // Link Color
    $wp_customize->add_setting( 'samsun_link_color', array(
        'default'           => '#e30613',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'samsun_link_color', array(
        'label'    => __( 'Link Rengi', 'samsun' ),
        'section'  => 'samsun_colors',
        'settings' => 'samsun_link_color',
    ) ) );

    // Footer Section
    $wp_customize->add_section( 'samsun_footer', array(
        'title'    => __( 'Footer Ayarları', 'samsun' ),
        'priority' => 40,
    ) );

    // Footer Text
    $wp_customize->add_setting( 'samsun_footer_text', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ) );

    $wp_customize->add_control( 'samsun_footer_text', array(
        'label'    => __( 'Footer Metni', 'samsun' ),
        'section'  => 'samsun_footer',
        'settings' => 'samsun_footer_text',
        'type'     => 'textarea',
    ) );

    // Layout Section
    $wp_customize->add_section( 'samsun_layout', array(
        'title'    => __( 'Düzen Ayarları', 'samsun' ),
        'priority' => 50,
    ) );

    // Container Width
    $wp_customize->add_setting( 'samsun_container_width', array(
        'default'           => '1200',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'samsun_container_width', array(
        'label'       => __( 'Container Genişliği (px)', 'samsun' ),
        'section'     => 'samsun_layout',
        'settings'    => 'samsun_container_width',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 960,
            'max'  => 1920,
            'step' => 10,
        ),
    ) );

    // Sidebar Position
    $wp_customize->add_setting( 'samsun_sidebar_position', array(
        'default'           => 'right',
        'sanitize_callback' => 'samsun_sanitize_sidebar_position',
    ) );

    $wp_customize->add_control( 'samsun_sidebar_position', array(
        'label'    => __( 'Sidebar Konumu', 'samsun' ),
        'section'  => 'samsun_layout',
        'settings' => 'samsun_sidebar_position',
        'type'     => 'radio',
        'choices'  => array(
            'left'  => __( 'Sol', 'samsun' ),
            'right' => __( 'Sağ', 'samsun' ),
        ),
    ) );

    // Typography Section
    $wp_customize->add_section( 'samsun_typography', array(
        'title'    => __( 'Tipografi', 'samsun' ),
        'priority' => 60,
    ) );

    // Base Font Size
    $wp_customize->add_setting( 'samsun_font_size', array(
        'default'           => '16',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'samsun_font_size', array(
        'label'       => __( 'Ana Font Boyutu (px)', 'samsun' ),
        'section'     => 'samsun_typography',
        'settings'    => 'samsun_font_size',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 12,
            'max'  => 24,
            'step' => 1,
        ),
    ) );
}
add_action( 'customize_register', 'samsun_customize_register' );

/**
 * Sanitize Sidebar Position
 */
function samsun_sanitize_sidebar_position( $input ) {
    $valid = array( 'left', 'right' );

    if ( in_array( $input, $valid, true ) ) {
        return $input;
    }

    return 'right';
}

/**
 * Render Custom CSS
 */
function samsun_customizer_css() {
    $primary_color     = get_theme_mod( 'samsun_primary_color', '#e30613' );
    $secondary_color   = get_theme_mod( 'samsun_secondary_color', '#1a1a1a' );
    $accent_color      = get_theme_mod( 'samsun_accent_color', '#ffd700' );
    $text_color        = get_theme_mod( 'samsun_text_color', '#333333' );
    $link_color        = get_theme_mod( 'samsun_link_color', '#e30613' );
    $container_width   = get_theme_mod( 'samsun_container_width', '1200' );
    $font_size         = get_theme_mod( 'samsun_font_size', '16' );
    $sidebar_position  = get_theme_mod( 'samsun_sidebar_position', 'right' );

    ?>
    <style type="text/css">
        :root {
            --primary-color: <?php echo esc_attr( $primary_color ); ?>;
            --secondary-color: <?php echo esc_attr( $secondary_color ); ?>;
            --accent-color: <?php echo esc_attr( $accent_color ); ?>;
            --text-color: <?php echo esc_attr( $text_color ); ?>;
        }

        body {
            font-size: <?php echo esc_attr( $font_size ); ?>px;
            color: <?php echo esc_attr( $text_color ); ?>;
        }

        a {
            color: <?php echo esc_attr( $link_color ); ?>;
        }

        .container {
            max-width: <?php echo esc_attr( $container_width ); ?>px;
        }

        <?php if ( 'left' === $sidebar_position ) : ?>
        .content-area {
            grid-template-columns: 350px 1fr;
        }
        .widget-area {
            order: -1;
        }
        <?php endif; ?>
    </style>
    <?php
}
add_action( 'wp_head', 'samsun_customizer_css' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function samsun_customize_preview_js() {
    wp_enqueue_script( 'samsun-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), SAMSUN_VERSION, true );
}
add_action( 'customize_preview_init', 'samsun_customize_preview_js' );
