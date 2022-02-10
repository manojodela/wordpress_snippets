<?php

/**
 * Template Name:Custom Template
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>

<div class="row" id="custom-template">

    <!-- left-sidebar  -->
    <div class="col-3 col-lg-3 col-md-3 col-sm-6" id="left-sidebar">
        <?php get_template_part('template-parts/recent-posts'); ?>

        <?php
        echo '<h3 id= "search">Search Pages or posts</h3>';
        get_template_part('/searchform') ?>
        <br>
        <br>
    </div>

    <!-- full width content -->
    <div class="col-6 col-lg-6 col-md-6 col-sm-12" id="content">
        <?php
        if (have_posts()) {

            while (have_posts()) {
                the_post();
        ?>
                <article <?php post_class(); ?> id="post-<?php the_ID(); ?>" style=" margin-top: 9rem;">

                    <?php

                    get_template_part('template-parts/entry-header');

                    if (!is_search()) {
                        get_template_part('template-parts/featured-image');
                    }

                    ?>

                    <!-- <div class="post-inner <?php // echo is_page_template('templates/template-full-width.php') ? '' : 'thin'; 
                                                ?> "> -->

                    <div class="entry-content">

                        <?php
                        if (is_search() || !is_singular() && 'summary' === get_theme_mod('blog_content', 'full')) {
                            the_excerpt();
                        } else {
                            the_content(__('Continue reading', 'twentytwenty'));
                        }
                        ?>

                    </div><!-- .entry-content -->

                    <!-- </div>.post-inner -->

                    <div class="section-inner">
                        <?php
                        wp_link_pages(
                            array(
                                'before'      => '<nav class="post-nav-links bg-light-background" aria-label="' . esc_attr__('Page', 'twentytwenty') . '"><span class="label">' . __('Pages:', 'twentytwenty') . '</span>',
                                'after'       => '</nav>',
                                'link_before' => '<span class="page-number">',
                                'link_after'  => '</span>',
                            )
                        );

                        edit_post_link();

                        // Single bottom post meta.
                        twentytwenty_the_post_meta(get_the_ID(), 'single-bottom');

                        if (post_type_supports(get_post_type(get_the_ID()), 'author') && is_single()) {

                            get_template_part('template-parts/entry-author-bio');
                        }
                        ?>


                    </div><!-- .section-inner -->

                    <?php

                    if (is_single()) {

                        get_template_part('template-parts/navigation');
                    }

                    /*
                        * Output comments wrapper if it's a post, or if comments are open,
                        * or if there's a comment number – and check for password.
                        */
                    if ((is_single() || is_page()) && (comments_open() || get_comments_number()) && !post_password_required()) {
                    ?>

                        <div class="comments-wrapper section-inner">

                            <?php comments_template(); ?>

                        </div><!-- .comments-wrapper -->

                    <?php
                    }
                    ?>

                </article>

        <?php   }
        }
        ?>
    </div>

    <!-- </right-sidebar> -->
    <div class="col-3 col-lg-3 col-md-3 col-sm-6" id="right-sidebar">
        <div>
            <?php echo '<h2 id = "sidebar-head">Categories</h2>' ?>
            <br />
            <div>
                <?php dynamic_sidebar('sidebar-5'); ?>
            </div>
        </div>
    </div>

</div>


<?php get_template_part('template-parts/footer-menus-widgets'); ?>

<?php get_footer(); ?>

<style>
    #left-sidebar {
        width: 250px;
        margin: 0 0 1rem 0;
        position: relative;
        top: 9rem;
        height: fit-content;
        background-color: antiquewhite;
    }

    #right-sidebar {
        width: 250px;
        position: relative;
        top: 8rem;
        background-color: antiquewhite;
        height: fit-content;
    }

    #sidebar-head {
        text-decoration: underline;
        font-family: Times New Roman, Times, serif;
        text-align: center;
    }

    #custom-template {
        display: flex;
    }



    #content {
        width: 980px;
        margin: auto;
        background-color: aliceblue;
    }

    .singular .featured-media-inner {

        position: relative;
        left: 0;
        width: auto;
    }

    #search {
        text-align: center;
        text-decoration: underline;
    }

    .search-form {
        display: flex;
        flex-wrap: wrap;
    }

    @media (max-width: 479px) {

        .row {
            width: auto;
            flex-direction: column-reverse;
        }

        #right-sidebar {
            display: none;
        }

        #left-sidebar {
            /* display: none; */
            width: auto;
        }

        #content {
            width: -webkit-fill-available !important;
        }

    }


    @media (max-width: 768px) {

        #custom-template {
            display: flex;
            flex-direction: column-reverse;
            width: -webkit-fill-available !important;
        }
    }

    @media (max-width: 1024px) {

        .col-3,
        .col-6 {
            width: auto;
        }

        #right-sidebar {
            display: none;
        }

        #left-sidebar {
            width: auto;
        }

        .row {
            flex-direction: column-reverse;
        }

        #content {
            width: -webkit-fill-available;
        }

        p.slider-caption-class {
            text-align: center;
        }
    }
</style>