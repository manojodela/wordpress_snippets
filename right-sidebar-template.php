<?php
/**
 * Template Name: Right Sidebar Template
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<div class="row">

    <div class="col-10" style="float: left;">

        <!-- content -->
        <main id="site-content" role="main">

            <?php

            if (have_posts()) {

                while (have_posts()) {
                    the_post(); ?>

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
            <?php
                }
            }

            ?>

        </main>

    </div>

    <!-- right sidebar -->
    <div class="col-2" id="right-sidebar" style="margin-top: 12rem;">
       
        <?php dynamic_sidebar('right-sidebar'); ?>
    </div>

</div>

<?php get_template_part('template-parts/footer-menus-widgets'); ?>

<?php get_footer(); ?>













<style>
    #sidebar-head {
        text-decoration: underline;
        font-family: Times New Roman, Times, serif;
        text-align: center;
    }

    .widget {
        list-style: none;
    }

    #right-sidebar {
        background-color: antiquewhite;
    }

    .singular .featured-media-inner {
        position: relative;
        left: auto;
        width: 100vw;
    }

    @media (max-width: 768px) {

        #right-sidebar {
            width: auto;
            margin-top: 0 !important;

        }

        .col-10 {
            width: 100%;
            margin: auto;
            padding: 1rem;
        }

        article {
            margin-top: 0 !important;
        }
    }


    ul.wp-block-latest-posts__list {
        margin: 0 !important;
        padding: inherit;
    }


    .wp-block-latest-posts__list {
        width: fit-content !important;
        margin: 0;
    }

    .widget_recent_entries a {
        display: block;
        color: white !important;
        text-decoration: none !important;
        position: relative;
        text-align: center;
        background-color: black;
        box-shadow: 0px 0px 4px black;
        padding: 12px;
        font-size: 15px;
        font-weight: normal;
    }

    .widget_recent_entries a::after {
        content: "";
        background: white;
        mix-blend-mode: exclusion;
        width: calc(100% + 20px);
        height: 0;
        position: absolute;
        bottom: -4px;
        left: -10px;
        transition: all .3s cubic-bezier(0.445, 0.05, 0.55, 0.95);
    }

    .widget_recent_entries a:hover::after {
        height: calc(100% + 8px);
    }
</style>