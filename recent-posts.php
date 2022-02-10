 <ul id="slider-id" class="slider-class">
     <?php
        $recent_posts = wp_get_recent_posts(array(
            'numberposts' => 4, // Number of recent posts thumbnails to display
            'post_status' => 'publish' // Show only the published posts
        ));
        echo '<h2 id ="recent"> Recent Posts </h2>  <br>';

        foreach ($recent_posts as $post_item) : ?>
         <li style="list-style: none;" id="list">
             <a href="<?php echo get_permalink($post_item['ID']) ?>">
                 <?php echo get_the_post_thumbnail($post_item['ID'], 'full'); ?>
                 <p class="slider-caption-class"><?php echo $post_item['post_title'] ?></p>
             </a>
         </li>
     <?php endforeach; ?>
 </ul>


 <style>
     #slider-id {
         padding: 10px;
         margin: 10px auto;
     }

     li#list:hover {
         background-color: aliceblue;
     }

     #recent {
         font-size: 28px;
         text-decoration: underline;
         text-align: center;
         margin: 20px auto;
     }

     p.slider-caption-class {
         text-align: left;
         color: black;
         text-decoration: none;
         padding: 6px;
     }

     li#list {
         margin: auto;
     }
 </style>