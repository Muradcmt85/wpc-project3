<?php get_header();?>
   <!-- Catagory -->
   <div class="container">
      <div class="row">
      <div class="col-md-12">
      <div class="catagory text-center">

        <?php 
          if(is_category()){ ?>
            <a href="#">Category:</a>
            <span><?php the_category(', '); ?></span>
          <?php
          } elseif(is_tag()){ ?>
            <a href="#">Tag:</a>
            <span><?php the_tags( ' ', ', ', ' ' ); ?></span>
          <?php
          } elseif(is_date()){ ?>
            <a href="#">Date:</a>
            <span><?php the_date(); ?></span>
          <?php
          } 
        ?>
        
      </div>
    </div>
   </div>
   <!-- Title -->
   <div class="container">
      <div class="row">
         <?php if (have_posts() ) : ?>
         <?php while (have_posts() ) :  the_post(); ?>
         <div class="col-md-6">
            <div class="title">
               <div class="col-md-12">
                  <h2><?php the_title()?></h2>
               </div>
               <div class="col-md-6">
                  <a href="">Author:</a>
                  <span><?php the_author()?></span>
               </div>
               <div class="col-md-6">
                  <a href="">Date:</a>
                  <span><?php echo get_the_date('Y,M,D')?></span>
               </div>
               <div class="col-md-12">
                  <p><?php the_excerpt()?></p>
               </div>
               <div class="col-md-12 read-more">
                  <a href="<?php the_permalink()?>">Read More Content....</a>
               </div>
            </div>
         </div>
         <?php endwhile; endif;?>
      </div>
      <!-- category link -->
      <div class="row">
         <div class="col-md-12">
            <div class="category-link">
               <span>Category:</span>
              <?php 
               $categories =  get_categories();
              foreach($categories as $category ){?>
               <a href="<?php echo get_category_link( $category->term_id )?>"> <?php echo $category->name ?> </a>
              <?php } ?>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="tag">
               <span>Tag:</span>
               <?php 
               $tags =  get_tags();
              foreach($tags as $tag ){?>
               <a href="<?php echo get_category_link( $tag->term_id )?>"> <?php echo $tag->name ?> </a>
              <?php } ?>
            </div>
         </div>
      </div>
   </div>

   <?php get_footer();?>