<?php get_header();?>

<section class="main">
      <div class="container">
         <?php
      if (have_posts() ) : ?>
         <?php while (have_posts() ) :  the_post(); ?> 
         <div class="col-md-8 title">
            <h2><?php the_title();?></h2>
            <span><a href="#"><?php the_category();?></a></span>
            
            <p><?php the_content();?></p>
         <?php endwhile; ?>
         <?php endif; ?>

         <div>
         </div>



<?php get_footer();?>