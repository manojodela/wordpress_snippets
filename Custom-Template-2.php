<?php

/**
 * Template Name: Custom Template 2
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




<div class="row" id="custom-template">

    <!-- full width banner -->
    <div>
        <img src="<?php echo get_field('picture') ?>" alt="img" class="bg-cover">
    </div>

    <!-- content -->
    <div class="col-10 col-lg-10 col-md-10 col-sm-10" id="content">
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
        ?>
                <article <?php post_class(); ?> id="post-<?php the_ID(); ?>" style=" margin-top: 9rem;">
                    <!-- .entry-content -->
                    <div class="entry-content">
                        <?php
                        the_content();
                        ?>
                    </div>
                </article>
        <?php   }
        }
        ?>
    </div>


</div>

<hr>

<!-- gallery services -->
<?php
$images = get_field('gallery');
if ($images) : ?> <h1 class="recent">Gallery</h1>
    <ul class="img-flex">
        <?php foreach ($images as $image) : ?>
            <li class="img-li">
                <a href="<?php echo esc_url($image['url']); ?>">
                    <img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                </a>
                <p class="slider-caption"><?php echo esc_html($image['caption']); ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>


<hr>

<!-- recent posts -->
<div class="col-lg-12 col-md-12 col-sm-12">
    <h1 class="recent">Recent Posts</h1>
    <ul id="slider-id" class="slider-class">
        <?php
        $recent_posts = wp_get_recent_posts(array(
            'numberposts' => 3, // Number of recent posts thumbnails to display
            'post_status' => 'publish' // Show only the published posts
        ));
        foreach ($recent_posts as $post_item) : ?>
            <li>
                <a href="<?php echo get_permalink($post_item['ID']) ?>">
                    <?php echo get_the_post_thumbnail($post_item['ID'], 'full'); ?>

                    <p class="slider-caption-class"><?php echo $post_item['post_title'] ?></p>

                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>


<?php if (have_rows('team')) : ?>
    <ul class="list-group">
        <?php while (have_rows('team')) : the_row();

            $name = get_sub_field('name');
            $biography = get_sub_field('biography');
            $picture = get_sub_field('picture');
            $image = $picture['sizes']['thumbnail'];
            $link = get_sub_field('link');
        ?>
            <li class="list-group-item">
                <img src="<?php echo $image ?>" alt="img" class="acf-img">
                <h2 class="acf-name"><?php echo $name ?></h2>
                <p class="acf-para"> <?php echo $biography ?></p>
                <div class="mid-link">
                    <a href="<?php echo $link['url'] ?>" class="acf-link">View Profile</a>
                </div>
            </li>

        <?php endwhile ?>
    </ul>
<?php endif; ?>




<?php get_template_part('template-parts/footer-menus-widgets'); ?>

<?php get_footer(); ?>

<style>
    ul#slider-id {
        width: 95% !important;
        display: flex;
        margin: auto;
        padding: 20px;
        width: auto;
        flex-wrap: wrap;
        justify-content: center;
        background-color: aliceblue;
    }

    li {
        line-height: 1.5;
        margin: 15px;
        padding: 15px;
        list-style: none;
    }

    p.slider-caption-class {
        font-size: large;
        color: black;
        font-weight: 600;
        text-decoration: none;
        text-transform: capitalize;
        text-align: center;
        padding: 5px;
    }

    img {
        width: 300px;
        height: auto;
    }

    .recent {
        width: auto;
        text-align: center;
        text-decoration: underline;
    }

    #content {
        margin: auto;
    }

    .bg-cover {
        width: 100%;
        height: 100%;
    }

    ul.img-flex {
        width: 95%;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin: auto;
        background-color: aliceblue;

    }

    p.slider-caption {
        width: 250px;
        font-size: 18px;
        text-align: center;
        margin: auto;
        padding: 10px;
    }

    p.slider-caption:hover {
        color: red;
    }

    .img-li:hover {
        color: red;
    }

    div#custom-template {
        margin-top: 8rem;
    }

    .list-group {
        display: flex;
        flex-direction: row;
    }

    img.acf-img {
        margin: 3rem auto;
        box-shadow: 4px 9px 10px;
    }

    h2.acf-name {
        margin: 1rem auto;
        font-size: 26px;
        width: fit-content;
        background: blanchedalmond;
        padding: 10px 40px;
        border-radius: 40%;
    }

    h2.acf-name:hover {
        text-decoration: line-through;
        background-color: black;
        color: red;

    }

    p.acf-para {
        font-size: 18px;
        text-align: center;
        margin: auto;
        padding: 0px;
        height: 380px;
    }

    .mid-link {
        margin: 3rem auto;
    }


    li.list-group-item {
        padding: 15px !important;
        border: outset !important;
    }

    .list-group-item:hover {
        background-color: aliceblue;
        color: black;

    }

    a.acf-link {
        font-size: 22px;
        text-decoration: none;
        background: black;
        padding: 10px 20px;
        border-radius: 25px;
        width: fit-content;
        margin: auto;
        color: #fff;
        font-weight: 700;
        text-transform: lowercase;
    }

    a.acf-link:hover {
        background-color: red;
        color: #fff;
    }

    .acf-img:hover {
        background-color: #F5F5F5;
        color: #708090;
    }

    @media (max-width: 425px) {

        .row {
            margin-top: 6rem !important;
        }

        article {
            margin-top: 2rem !important;
        }


    }
</style>


<!-- full width banner -->
<!-- <div class= "bg">
<img src= '[acf field="picture"]' class= "bg-img" >
</div> -->