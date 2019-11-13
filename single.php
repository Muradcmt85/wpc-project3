<?php get_header();?>
   <!-- main -->
   <section class="main">
      <div class="container">
         <?php
      if (have_posts() ) : ?>
         <?php while (have_posts() ) :  the_post(); ?> 
         <div class="col-md-8 title">
            <h2><?php the_title();?></h2>
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
            <span>Date: </span><a href="#"><?php echo get_the_date('Y,M,D'); ?></a>
            <p><?php the_content()?></p>
            <?php 
            $next_post = get_adjacent_post(false, '', false);
            if(!empty($next_post)) {?>
           <?php  echo 'Next Post : '. '<a href="' . get_permalink($next_post->ID) . '" title="' . $next_post->post_title . '">' . $next_post->post_title . '</a>'; ?>
           
            <?php } 
            $prev_post = get_adjacent_post(false, '', true);?>
     <?php if(!empty($prev_post)) {
      echo 'Previous Post : '.'<a href="' . get_permalink($prev_post->ID) . '" title="' . $prev_post->post_title . '">' . $prev_post->post_title . '</a>'; }?>
         </div>
         
         <?php endwhile; ?>
         <?php endif; ?>

         <div class="col-md-offset-1 col-md-3 section-right">
            <h4>Most commented post</h4>
         <?php $wp_query = new WP_Query('orderby=comment_count&ignore_sticky_post=true&posts_per_page=3');
        while ($wp_query->have_posts()) : $wp_query->the_post(); { ?>
            <ul>
               <li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a> (<?php comments_number('1 comment', '1 comment', '% comments'); ?>)</li>
               <!-- <a href="">
                  <li>Lorem ipsum dolor sit amet.</li>
               </a>
               <a href="">
                  <li>Lorem ipsum dolor sit amet consectetur.</li>
               </a>
               <a href="">
                  <li>Lorem ipsum dolor sit amet, consectetur adipisicing.</li>
               </a> -->
            </ul>
    <?php } endwhile; ?>
            <h4>Older post</h4>
            <ul>
            <?php
              $args = array('posts_per_page' => 3,'ignore_sticky_posts'=>true, 'orderby' => 'date','order'=>'ASC' );
              $myQuery = new WP_Query($args);
              $date = '';
              if ( $myQuery->have_posts() ) : while ( $myQuery->have_posts() ) : $myQuery->the_post();
              if ( $date != get_the_date() ) {
                  echo $date;
                  echo '<hr />';
                  $date = get_the_date('Y,M,D');
              }?>
              <a href="<?php the_permalink(  )?>"><li><?php the_title();?></li></a>
             <?php echo '<br />';
              endwhile; endif;
              wp_reset_postdata();?>
               <!-- <a href="">
                  <li>Lorem ipsum dolor sit amet.</li>
               </a> -->
            </ul>
            <h4>Most used category (category name) post</h4>
            <ul>
               <?php
                  $categories = get_the_category();
                  $cat_id     = $categories[0]->term_id;
                  
                  foreach ( $categories as $i => $category ) {
                      echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" >' . esc_html( $category->name ).'</a>';
                      if ( $i < 'count - 1' )
                          echo $separator;
                  }
               
               ?>
               <a href="">
                  <li>Lorem ipsum dolor sit amet.</li>
               </a>
            </ul>
            <h4>Most used category</h4>
            <ul>
               <a href="">
                     <?php     
                        wp_list_categories('number=5&show_count=1&orderby=count&order=AESC&title_li=&hierarchical=0&taxonomy=category') 
                     ?>
               </a>
            </ul>
            <h4>Most used tag</h4>
            <ul>
            <a href="<?php echo  get_tag_link($tag->term_id) ;?>"><li>
               <?php echo wpb_tag_cloud() ;  ?></li>
               </a>
            </ul>
            <h4>Less used category </h4>
            <ul>
            <?php
               $args = array (
               'orderby' => 'count',
               'number' => 3,
               'order' => 'ASC'
               );
               $categories = get_categories($args);

               foreach($categories as $category) : ?>
               <li><a href="<?php echo get_category_link($category->term_id) ?>"><?php echo $category->name; ?></a></li>
               <?php endforeach; ?>

            </ul>
            <h4>Less used tags </h4>
            <ul>
            <?php
            $args = array (
            'orderby' => 'count',
            'number' => 3,
            'order' => 'ASC',
            );
            $tags = get_tags($args);
            foreach($tags as $tag) : ?>
               <li><a href="<?php echo get_tag_link($tag->term_id) ?>"><?php echo $tag->name; ?></a></li>
            <?php endforeach; ?>
            
            </ul>
         </div>
         <div class="col-md-8">
            <div class="col-md-6">
               <h6>Related post</h6>
               <ul>
               <?php
                  // Default arguments
                  $args = array(
                     'posts_per_page' => 3,
                     'post__not_in'   => array( get_the_ID() ),
                     'orderby' => 'count',
                  );

                  $cats = wp_get_post_terms( get_the_ID(), 'category' ); 
                  $cats_ids = array();  
                  foreach( $cats as $wpex_related_cat ) {
                     $cats_ids[] = $wpex_related_cat->term_id; 
                  }
                  if ( ! empty( $cats_ids ) ) {
                     $args['category__in'] = $cats_ids;
                  }

                  $wpex_query = new wp_query( $args );

                  foreach( $wpex_query->posts as $post ) : setup_postdata( $post ); ?>
                     
                     <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>"><li><?php the_title(); ?></li></a>

                  <?php
                  endforeach;
                  wp_reset_postdata(); ?>

               </ul>
            </div>
            <div class="col-md-6">
               <h6>You may also like (not related)</h6>
               <ul>
               <?php
                  $args = array(
                     'posts_per_page' => 3, 
                     'post__not_in'   => array( get_the_ID() ), 
                     'orderby' => 'count',
                  );

                  $cats = wp_get_post_terms( get_the_ID(), 'category' ); 
                  $cats_ids = array();  
                  foreach( $cats as $wpex_related_cat ) {
                     $cats_ids[] = $wpex_related_cat->term_id; 
                  }
                  if ( ! empty( $cats_ids ) ) {
                     $args['category__not_in'] = $cats_ids;
                  }
                  $wpex_query = new wp_query( $args );
                  foreach( $wpex_query->posts as $post ) : setup_postdata( $post ); ?>
                     
                     <a href="<?php the_permalink(); ?>"><li><?php the_title(); ?></li></a>

                  <?php
                  endforeach;
                  wp_reset_postdata(); ?>
               </ul>
            </div>
            <div class="col-md-6">
               <h6>Partially Related post</h6>
               <ul>
               <?php
                  $args = array(
                     'posts_per_page' => 3, 
                     'post__not_in'   => array( get_the_ID() ), 
                     'orderby' => 'count',
                  );

                  $cats = wp_get_post_tags( get_the_ID(), 'tag' ); 
                  $cats_ids = array();  
                  foreach( $cats as $wpex_related_cat ) {
                     $cats_ids[] = $wpex_related_cat->term_id; 
                  }
                  if ( ! empty( $cats_ids ) ) {
                     $args['tag__in'] = $cats_ids;
                  }
                  $wpex_query = new wp_query( $args );
                  foreach( $wpex_query->posts as $post ) : setup_postdata( $post ); ?>
                     
                     <a href="<?php the_permalink(); ?>"><li><?php the_title(); ?></li></a>

                  <?php
                  endforeach;
                  wp_reset_postdata(); ?>
               </ul>
            </div>
         </div>
      </div>
      <!-- category link -->
      <div class="container">
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
      </div>
   </section>

   <?php get_footer();?>