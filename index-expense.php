<?php
/*
*Template Name: Expense
*/

 get_header();?>


<?php
    $args = array(
        'posts_per_page'=>5,
        'post_type'=>'expense',
    );
    $total_amount =0;
    $the_query = new WP_Query( $args);?>
    <center>
    <table border="1">
    <tr>
        <th>Expense Name</th>
        <th>Expense Category</th>
        <th>Expense Amount</th>
    </tr>
   <?php if ($the_query->have_posts() ) : ?>
    <?php while ($the_query->have_posts() ) :  $the_query->the_post(); ?>
    <?php    $num = get_the_excerpt();
            $int = (int)$num;
           $total_amount += $int; ?>

        <tr>
         <td><a href="<?php the_permalink();?>"><?php the_title();?></a></td>
         <td>
         <?php
                  foreach(get_the_category( ) as $category):
                  $catname = $category->cat_name;?>
               <?php echo $catname;?>
               <?php endforeach; ?>
               </td>
         <td><?php the_excerpt();?></td>
        </tr>
    <?php endwhile; ?>
<?php endif; ?>
<tr rowspan="3">
    <td></td>
    <td>Total</td>
    <td><?php echo  $total_amount;?></td>
</tr>
</table>

</center>

<?php get_footer();?>