<!DOCTYPE html>
<html <?php language_attributes();?>>

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <?php wp_head();?>
</head>

<body>
   <!-- Navs -->
   <header>
      <div class="top-header">
         <div class="container">
            <div class="logo col-md-12 text-center">
               <a href="<?php echo home_url('')?>">
                  <p><?php the_custom_logo();?></p>
               </a>
            </div>
         </div>
      </div>
      <div class="container">
         <nav class="navbar navbar-default">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
               <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                  data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
               </button>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
               <?php 
                  wp_nav_menu( array(
                     'theme_location'  => 'primary',
                     'container'       => 'div',
                     'container_class' => 'collapse navbar-collapse',
                     'container_id'    => 'bs-example-navbar-collapse-1',
                     'menu_class'      => 'nav navbar-nav',
                     'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                     'walker'          => new WP_Bootstrap_Navwalker(),
                  ) );
               ?>
            </div>
         </nav>
      </div>
   </header>