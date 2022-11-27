<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WL_Test_Theme
 */

?>
<?php
/**
 * Display a list of the most recent news in Boston
 *
 * @class WP_Query https://codex.wordpress.org/Class_Reference/WP_Query
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php
        $taxonomies = get_object_taxonomies('car');
        $fuel = get_post_meta(get_the_ID(), 'hcf_fuel', true);
        $color = get_post_meta(get_the_ID(), 'hcf_color', true);
        $power = get_post_meta(get_the_ID(), 'hcf_power', true);
        $price = get_post_meta(get_the_ID(), 'hcf_price', true);
        $arg = [
            'orderby' => 'term_id',
            'order' => 'ASC'
        ];
        if (is_singular()) :
            the_title('<h1 class="entry-title">', '</h1>');
            $terms = wp_get_object_terms($post->ID, $taxonomies, $arg);

            if (!empty($fuel && $price && $color && $power && $terms)) :
                $taxonomy = array();

                foreach ($terms as $term) {
                    $taxonomy[] = $term->name;
                }
                echo  _e('Country is:', 'wl-test-theme') . $taxonomy[0] . '<br>';
                echo  _e('Brand is:', 'wl-test-theme') . $taxonomy[1] . '<br>';
                echo  _e('Fuel is:', 'wl-test-theme') . $fuel . '<br>';
                echo  _e('Color is:', 'wl-test-theme') . $color . '<br>';
                echo  _e('Power is:', 'wl-test-theme') . $power . '<br>';
                echo  _e('Price is:', 'wl-test-theme') . $price . '<br>';
            endif;
        else :
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
        endif;

        if ('post' === get_post_type()) :
            ?>
            <div class="entry-meta">
                <?php
                wl_test_theme_posted_on();
                wl_test_theme_posted_by();
                ?>
            </div><!-- .entry-meta -->
        <?php endif; ?>
    </header><!-- .entry-header -->

    <?php wl_test_theme_post_thumbnail(); ?>

    <div class="entry-content">
        <?php
        the_content(
            sprintf(
                wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                    __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'wl-test-theme'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post(get_the_title())
            )
        );

        wp_link_pages(
            array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'wl-test-theme'),
                'after' => '</div>',
            )
        );
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php wl_test_theme_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
