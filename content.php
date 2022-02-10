<?php

/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>

<!-- <article <?php post_class(); ?> id="post-<?php the_ID(); ?>" style="float: left; margin-top: 9rem;"> -->
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>" >

	<?php

	get_template_part('template-parts/entry-header');

	if (!is_search()) {
		get_template_part('template-parts/featured-image');
	}

	?>

	<div class="post-inner <?php echo is_page_template('templates/template-full-width.php') ? '' : 'thin'; ?> ">

		<div class="entry-content">

			<?php
			if (is_search() || !is_singular() && 'summary' === get_theme_mod('blog_content', 'full')) {
				the_excerpt();
			} else {
				the_content(__('Continue reading', 'twentytwenty'));
			}
			?>

		</div><!-- .entry-content -->


	</div><!-- .post-inner -->

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
	if (get_post_type() === 'post') {
		get_template_part('template-parts/sidebar-post');
	}


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

</article><!-- .post -->

<div class="taxonomy">
	<?php
	if (has_term(array('sports', 'kabbadi', 'seminar'), 'event_category')) {
		$args = array('taxonomy'  => 'event_category',);
		echo wp_list_categories($args); ?>
	<?php wp_reset_postdata();
	} ?>
</div>


<style>
	article {
		/* width: 1400px; */
		margin: auto;
	}

	.cat-item a {
		display: flex;

	}

	li.cat-item {
		list-style: none;
	}

	li.event_category {
		list-style: none;
		margin-top: 10rem;
		position: absolute;
		right: 10rem;
		top: 32rem;
	}

	.taxonomy {
		display: contents;
	}
</style>