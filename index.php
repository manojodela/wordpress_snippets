<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();

$the_post_id = get_the_ID();
$article_terms = wp_get_post_terms($the_post_id, ['category', 'post_tag'])

?>

<main id="site-content" role="main">

	<?php

	$archive_title    = '';
	$archive_subtitle = '';

	if (is_search()) {
		global $wp_query;

		$archive_title = sprintf(
			'%1$s %2$s',
			'<span class="color-accent">' . __('Search:', 'twentytwenty') . '</span>',
			'&ldquo;' . get_search_query() . '&rdquo;'
		);

		if ($wp_query->found_posts) {
			$archive_subtitle = sprintf(
				/* translators: %s: Number of search results. */
				_n(
					'We found %s result for your search.',
					'We found %s results for your search.',
					$wp_query->found_posts,
					'twentytwenty'
				),
				number_format_i18n($wp_query->found_posts)
			);
		} else {
			$archive_subtitle = __('We could not find any results for your search. You can give it another try through the search form below.', 'twentytwenty');
		}
	} elseif (is_archive() && !have_posts()) {
		$archive_title = __('Nothing Found', 'twentytwenty');
	} elseif (!is_home()) {
		$archive_title    = get_the_archive_title();
		$archive_subtitle = get_the_archive_description();
	}

	if ($archive_title || $archive_subtitle) {
	?>

		<header class="archive-header has-text-align-center header-footer-group">

			<div class="archive-header-inner section-inner medium">

				<?php if ($archive_title) { ?>
					<h1 class="archive-title"><?php echo wp_kses_post($archive_title); ?></h1>
				<?php } ?>

				<?php if ($archive_subtitle) { ?>
					<div class="archive-subtitle section-inner thin max-percentage intro-text"><?php echo wp_kses_post(wpautop($archive_subtitle)); ?></div>
				<?php } ?>

			</div><!-- .archive-header-inner -->

		</header><!-- .archive-header -->

	<?php
	}

	if (have_posts()) { ?>

		<div class="row" id="loop" style="float:left; margin-top: 9rem; ">
		<!-- <div class="row" id="loop" > -->

			<?php while (have_posts()) : the_post(); ?>

				<div class="col-4">

					<a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(); ?> </a>
					<br>
					<a href="<?php the_permalink(); ?>" class="title" <?php the_title('<h4>', '</h4>'); ?> </a>
						<br>
						<p class="excerpt" <?php the_excerpt(); ?> </p>

				</div>

			<?php endwhile; ?>

		</div>


		<div class="taxonomy">
			<?php
			if (has_term(array('sports', 'kabbadi', 'seminar'), 'event_category')) {
				$args = array('taxonomy'  => 'event_category',);
				echo wp_list_categories($args); ?>
			<?php wp_reset_postdata();
			} ?>
		</div>

		<?php
		if (is_home()) {
			get_template_part('template-parts/sidebar');
		} else if (get_post_type() === 'post') {
			get_template_part('template-parts/sidebar-post');
		}
	} elseif (is_search()) {
		?>

		<div class="no-search-results-form section-inner thin">

			<?php
			get_search_form(
				array(
					'aria_label' => __('search again', 'twentytwenty'),
				)
			);
			?>

		</div><!-- .no-search-results -->

	<?php
	}

	?>

</main><!-- #site-content -->
<?php get_template_part('template-parts/pagination'); ?>
<?php get_template_part('template-parts/footer-menus-widgets'); ?>



<?php
get_footer();
?>

<style>
	.taxonomy {
		display: contents;
	}

	.row {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(429px, 1fr));
		grid-column-gap: 1rem;
		grid-row-gap: 1rem;
		width: 1200px;
	}

	.col-4 {

		padding: 15px 20px 10px;
	}

	a.title {
		display: initial;
		color: #333;
		text-decoration: none;
		width: 100%;
		font-style: normal;
		font-weight: normal;
		font-stretch: normal;
		font-size: 20px;
		line-height: 30px;
		font-family: gotham-book, Helvetica, Arial, Verdana, sans-serif;
		text-transform: none;
		word-spacing: 1px !important;
		letter-spacing: initial;

	}

	.title:hover {
		text-decoration: none;
		color: #fd5a63;

	}

	a.title {
		background-color: transparent;
	}


	p.excerpt {
		font: normal 18px / 24px "gotham-light",
			Helvetica,
			Arial,
			Verdana,
			sans-serif;
		word-spacing: normal;
		color: #85868c;
		line-height: 30px;

	}

	.cat-item a {
		display: flex;

	}

	li.cat-item {
		list-style: none;
	}

	li.event_category {
		list-style: none;
		display: grid;
		margin-top: 9rem;
	}
</style>


<?php
// $args = array(
// 	'post_type' => 'Events',
// 	'post_status' => 'publish',
// 	'posts_per_page' => 3,
// 	'orderby' => 'title',
// 	'order' => 'ASC',
// );

// $loop = new WP_Query($args);


// while ($loop->have_posts()) : $loop->the_post();
?>



<!-- <div class="col-4">

					<a href="<? php // the_permalink(); 
								?>"> <? php // the_post_thumbnail(); 
										?> </a>
					<br>
					<a href="<? php // the_permalink(); 
								?>" class="title" <? php // the_title('<h4>', '</h4>'); 
													?> </a>
						<br>
						<p class="excerpt" <?php //the_excerpt(); 
											?> </p>

				</div> -->

<?php
//	endwhile;
?>