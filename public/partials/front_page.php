

<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<?php wp_head(); ?>

</head>
<body>

<?php wp_body_open(); ?>


  <body>



      <!-- Main Container -->
      <main id="main-container">
        <div class="bg-body-extra-light">
            <div class="content content-full">
             <?php  
		  
                    if ( have_posts() ) :
                while ( have_posts() ) : the_post(); ?>

                    <?php the_content() ?>
                
                <?php endwhile;

            else :
                echo '<p>There are no posts!</p>';

            endif;

            ?>
        </div></div>
      
       
      </main>
      <!-- END Main Container -->


<?php
wp_footer();

?>

</body>
</html>


