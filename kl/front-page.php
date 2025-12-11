<?php
/**
 * Front Page Template - Ana Sayfa
 *
 * @package Samsun
 */

get_header();
?>

<div class="site-content front-page">
    
    <!-- Hero / Slider Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-grid">
                <?php
                // Ana slider için en son haberler
                $hero_query = new WP_Query( array(
                    'posts_per_page' => 1,
                    'post_status'    => 'publish',
                    'meta_key'       => '_thumbnail_id',
                ) );

                if ( $hero_query->have_posts() ) :
                    while ( $hero_query->have_posts() ) : $hero_query->the_post();
                ?>
                    <div class="hero-main">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="hero-image">
                                <?php the_post_thumbnail( 'full' ); ?>
                                <div class="hero-overlay"></div>
                            </div>
                        <?php endif; ?>
                        <div class="hero-content">
                            <div class="hero-category">
                                <?php
                                $categories = get_the_category();
                                if ( ! empty( $categories ) ) {
                                    echo '<span class="category-badge">' . esc_html( $categories[0]->name ) . '</span>';
                                }
                                ?>
                            </div>
                            <h2 class="hero-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <div class="hero-meta">
                                <span class="hero-date"><?php echo get_the_date(); ?></span>
                                <span class="hero-author"><?php the_author(); ?></span>
                            </div>
                            <div class="hero-excerpt">
                                <?php echo wp_trim_words( get_the_excerpt(), 25 ); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="hero-button">Haberi Oku</a>
                        </div>
                    </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>

                <!-- Yan haberler -->
                <div class="hero-side">
                    <?php
                    $side_query = new WP_Query( array(
                        'posts_per_page' => 4,
                        'offset'         => 1,
                        'post_status'    => 'publish',
                    ) );

                    if ( $side_query->have_posts() ) :
                        while ( $side_query->have_posts() ) : $side_query->the_post();
                    ?>
                        <article class="hero-side-item">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="hero-side-image">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail( 'thumbnail' ); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="hero-side-content">
                                <h3 class="hero-side-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <span class="hero-side-date"><?php echo get_the_date(); ?></span>
                            </div>
                        </article>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Son Dakika Haberleri -->
    <section class="breaking-news">
        <div class="container">
            <div class="breaking-news-wrapper">
                <span class="breaking-label">SON DAKİKA</span>
                <div class="breaking-news-slider">
                    <?php
                    $breaking_query = new WP_Query( array(
                        'posts_per_page' => 5,
                        'tag'            => 'son-dakika',
                    ) );

                    if ( $breaking_query->have_posts() ) :
                        while ( $breaking_query->have_posts() ) : $breaking_query->the_post();
                    ?>
                        <div class="breaking-news-item">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </div>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        // Fallback - eğer "son-dakika" tag'i yoksa son haberler
                        $fallback_query = new WP_Query( array( 'posts_per_page' => 5 ) );
                        while ( $fallback_query->have_posts() ) : $fallback_query->the_post();
                    ?>
                        <div class="breaking-news-item">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </div>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Ana İçerik Alanı -->
    <div class="container main-content-area">
        <div class="content-grid">
            
            <!-- Sol Kolon - Haberler -->
            <main class="main-column">
                
                <!-- Öne Çıkan Haberler Bölümü -->
                <section class="featured-section">
                    <h2 class="section-title">
                        <span>Öne Çıkan Haberler</span>
                    </h2>
                    <div class="featured-grid">
                        <?php
                        $featured_query = new WP_Query( array(
                            'posts_per_page' => 6,
                            'offset'         => 5,
                        ) );

                        if ( $featured_query->have_posts() ) :
                            while ( $featured_query->have_posts() ) : $featured_query->the_post();
                        ?>
                            <article class="featured-post">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="featured-post-image">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail( 'medium_large' ); ?>
                                        </a>
                                        <span class="post-category">
                                            <?php
                                            $categories = get_the_category();
                                            if ( ! empty( $categories ) ) {
                                                echo esc_html( $categories[0]->name );
                                            }
                                            ?>
                                        </span>
                                    </div>
                                <?php endif; ?>
                                <div class="featured-post-content">
                                    <h3 class="featured-post-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>
                                    <div class="featured-post-excerpt">
                                        <?php echo wp_trim_words( get_the_excerpt(), 15 ); ?>
                                    </div>
                                    <div class="featured-post-meta">
                                        <span class="post-date"><?php echo get_the_date(); ?></span>
                                        <span class="post-views">
                                            <i class="icon-eye"></i> <?php echo samsun_get_post_views( get_the_ID() ); ?>
                                        </span>
                                    </div>
                                </div>
                            </article>
                        <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                </section>

                <!-- Kategorilere Göre Haberler -->
                <?php
                $categories = get_categories( array(
                    'orderby'    => 'count',
                    'order'      => 'DESC',
                    'number'     => 4,
                    'hide_empty' => true,
                ) );

                foreach ( $categories as $category ) :
                ?>
                    <section class="category-section">
                        <h2 class="section-title">
                            <span><?php echo esc_html( $category->name ); ?></span>
                            <a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" class="section-more">
                                Tümünü Gör →
                            </a>
                        </h2>
                        <div class="category-posts">
                            <?php
                            $cat_query = new WP_Query( array(
                                'cat'            => $category->term_id,
                                'posts_per_page' => 4,
                            ) );

                            if ( $cat_query->have_posts() ) :
                                $post_index = 0;
                                while ( $cat_query->have_posts() ) : $cat_query->the_post();
                                    $post_index++;
                                    $post_class = ( $post_index === 1 ) ? 'category-post-large' : 'category-post-small';
                            ?>
                                <article class="category-post <?php echo esc_attr( $post_class ); ?>">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <div class="category-post-image">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail( $post_index === 1 ? 'large' : 'medium' ); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    <div class="category-post-content">
                                        <h3 class="category-post-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        <?php if ( $post_index === 1 ) : ?>
                                            <div class="category-post-excerpt">
                                                <?php echo wp_trim_words( get_the_excerpt(), 20 ); ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="category-post-meta">
                                            <span class="post-date"><?php echo get_the_date(); ?></span>
                                        </div>
                                    </div>
                                </article>
                            <?php
                                endwhile;
                                wp_reset_postdata();
                            endif;
                            ?>
                        </div>
                    </section>
                <?php endforeach; ?>

            </main>

            <!-- Sağ Sidebar -->
            <aside class="sidebar-column">
                
                <!-- Popüler Haberler -->
                <div class="widget widget-popular">
                    <h3 class="widget-title">Popüler Haberler</h3>
                    <div class="popular-posts">
                        <?php
                        $popular_query = new WP_Query( array(
                            'posts_per_page' => 5,
                            'meta_key'       => 'post_views_count',
                            'orderby'        => 'meta_value_num',
                            'order'          => 'DESC',
                        ) );

                        if ( $popular_query->have_posts() ) :
                            $counter = 1;
                            while ( $popular_query->have_posts() ) : $popular_query->the_post();
                        ?>
                            <article class="popular-post-item">
                                <span class="popular-number"><?php echo $counter; ?></span>
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="popular-post-image">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail( 'thumbnail' ); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <div class="popular-post-content">
                                    <h4 class="popular-post-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h4>
                                    <span class="popular-post-date"><?php echo get_the_date(); ?></span>
                                </div>
                            </article>
                        <?php
                            $counter++;
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                </div>

                <!-- Kategoriler Widget -->
                <div class="widget widget-categories">
                    <h3 class="widget-title">Kategoriler</h3>
                    <ul class="category-list">
                        <?php
                        wp_list_categories( array(
                            'title_li'   => '',
                            'show_count' => true,
                            'orderby'    => 'count',
                            'order'      => 'DESC',
                            'number'     => 10,
                        ) );
                        ?>
                    </ul>
                </div>

                <!-- Etiketler Widget -->
                <div class="widget widget-tags">
                    <h3 class="widget-title">Popüler Etiketler</h3>
                    <div class="tag-cloud">
                        <?php
                        $tags = get_tags( array(
                            'orderby' => 'count',
                            'order'   => 'DESC',
                            'number'  => 20,
                        ) );

                        foreach ( $tags as $tag ) :
                        ?>
                            <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="tag-item">
                                <?php echo esc_html( $tag->name ); ?>
                                <span class="tag-count"><?php echo $tag->count; ?></span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php
                // Diğer sidebar widget'ları
                if ( is_active_sidebar( 'sidebar-1' ) ) {
                    dynamic_sidebar( 'sidebar-1' );
                }
                ?>

            </aside>

        </div>
    </div>

</div>

<?php
get_footer();
