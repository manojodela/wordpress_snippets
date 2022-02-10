<script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<?php

/**
 * Displays the post header
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

$entry_header_classes = '';

if (is_singular()) {
	$entry_header_classes .= ' header-footer-group';
}

$terms = get_the_terms($post->ID, 'event_category');
$name;
$link;
if ($terms) {
	foreach ($terms as $term) {
		$name = $term->name;
		$link = get_term_link($term->slug, 'event_category');
	}
}
?>

<header class="entry-header has-text-align-center<?php echo esc_attr($entry_header_classes); ?>">

	<div class="entry-header-inner section-inner medium">

		<?php
		/**
		 * Allow child themes and plugins to filter the display of the categories in the entry header.
		 *
		 * @since Twenty Twenty 1.0
		 *
		 * @param bool Whether to show the categories in header. Default true.
		 */
		$show_categories = apply_filters('twentytwenty_show_categories_in_entry_header', true);




		if (true === $show_categories && has_category()) {
		?>

			<div class="entry-categories">
				<span class="screen-reader-text"><?php _e('Categories', 'twentytwenty'); ?></span>
				<div class="entry-categories-inner">
					<?php the_category(' '); ?>
				</div><!-- .entry-categories-inner -->
			</div><!-- .entry-categories -->
			<?php
		}


		if (is_singular()) {
			if (has_term(array('sports', 'kabbadi', 'seminar'), 'event_category')) { ?>

				<a href="<?php echo $link ?>" target="_blank">
					<h2 class="tx-name"><?php echo $name ?></h2>
				</a>
			<?php } ?>

			<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
			<br>
			<ul>
				<li class="li-meta"><strong>Event Author: </strong><?php echo esc_attr(get_post_meta(get_the_ID(), 'event_author', true)); ?></li>
				<li class="li-meta"><strong>Event Date: </strong><?php echo esc_attr(get_post_meta(get_the_ID(), 'event_date', true)); ?></li>
				<li class="li-meta"><strong>Event Name: </strong><?php echo esc_attr(get_post_meta(get_the_ID(), 'event_name', true)); ?></li>
			</ul>
		<?php
		} else {
			the_title('<h2 class="entry-title heading-size-1"><a href="' . esc_url(get_permalink()) . '">', '</a></h2>');
		}



		$intro_text_width = '';

		if (is_singular()) {
			$intro_text_width = ' small';
		} else {
			$intro_text_width = ' thin';
		}

		if (has_excerpt() && is_singular()) {
		?>

			<!-- <div class="intro-text section-inner max-percentage<?php echo $intro_text_width; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output 
																	?>">
			 <? php // the_excerpt(); 
				?>
			</div> -->

		<?php
		}

		// Default to displaying the post meta.
		twentytwenty_the_post_meta(get_the_ID(), 'single-top');
		?>

	</div><!-- .entry-header-inner -->

</header><!-- .entry-header -->

<style>
	.tx-name {
		margin: 0;
	}

	.li-meta {
		list-style: none;
	}
</style>