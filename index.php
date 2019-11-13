<?php get_header();?>
   <!-- main section -->
   <section class="main">
      <div class="container">

      <?php
      $today = getdate();
         $the_query = new WP_Query( 'posts_per_page=0&ignore_sticky_posts=true');
         if (have_posts() ) : ?>
         <?php while ($the_query->have_posts() ) :  $the_query->the_post(); ?> 
         <div class="col-md-8">
            <div class="title">
               <h2><a href="<?php the_permalink()?>"><?php the_title()?></a></h2>  
               
               <span>Category:
               <?php
                  foreach(get_the_category( ) as $category):
                  $catname = $category->cat_name;?>
                <a href="<?php echo get_category_link($category->term_id);?>"><?php echo $catname.',';?></a></span>
               <?php endforeach; ?>
               
               <span>
               <?php
                 if( the_tags()) {?>
                <a href="<?php echo  get_tag_link($tag->term_id) ;?>"><?php the_tags().',';?></a></span>
                 <?php } ?>
               <!-- <span>Tags:<a href="<?php the_permalink();?>">tag1</a><a href="">tag2</a><a href="">tag3</a><a href="">tag4</a></span> -->
               <span>Author:<a href="<?php the_permalink();?>"><?php echo get_the_author();?></a>
               <?php 
            $archive_year  = get_the_time( 'Y' ); 
            $archive_month = get_the_time( 'm' ); 
            $archive_day   = get_the_time( 'd' ); 
            ?>
                  <span>Date:<a href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ); ?>"><?php echo get_the_date(); ?></a>
                     <p><?php the_excerpt();?></p>
                     <a class="readmore" href="<?php the_permalink();?>">Read More Content....</a>
            </div>
         </div>
         <?php endwhile; ?>
         <?php endif; ?>
         <div class="col-md-3 col-md-offset-1">
            <div class="background">

            </div>
         </div>
      </div>
   </section>
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