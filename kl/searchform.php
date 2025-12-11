<?php
/**
 * Search Form Template
 *
 * @package Samsun
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label>
        <span class="screen-reader-text"><?php echo esc_html_x( 'Ara:', 'label', 'samsun' ); ?></span>
        <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Ara&hellip;', 'placeholder', 'samsun' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
    </label>
    <button type="submit" class="search-submit">
        <span class="screen-reader-text"><?php echo esc_html_x( 'Ara', 'submit button', 'samsun' ); ?></span>
        <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
            <path d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" />
        </svg>
    </button>
</form>
