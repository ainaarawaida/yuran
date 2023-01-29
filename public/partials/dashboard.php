
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

	<?php 
    
    
    add_filter( 'document_title_parts', function( $title_parts_array ) {
        $title_parts_array['title'] = 'Dashboard';
        return $title_parts_array;
        } );
        
        
        wp_head(); 
    
   
        
        ?>

  

<?php 


$files = array();
$files = glob(MYPLUGINWP_PATH . 'myapp/dist/assets/*.js');
$files2 = glob(MYPLUGINWP_PATH . 'myapp/dist/assets/vite/*.js');
$files3 = glob(MYPLUGINWP_PATH . 'myapp/dist/assets/src/*.js');
$files4 = glob(MYPLUGINWP_PATH . 'myapp/dist/assets/src/routes/*.js');
$allfile = array();
foreach($files AS $key => $val){
 
  $allfile[] = ["base" => basename($val) , "path" => "myapp/dist/assets/"] ; 
}
foreach($files2 AS $key => $val){
  $allfile[] = ["base" => basename($val) , "path" => "myapp/dist/assets/vite/"] ; 
}
foreach($files3 AS $key => $val){
  $allfile[] = ["base" => basename($val) , "path" => "myapp/dist/assets/src/"] ; 
}
foreach($files4 AS $key => $val){
  $allfile[] = ["base" => basename($val) , "path" => "myapp/dist/assets/src/routes/"] ; 
}
    
foreach ($allfile AS $key => $val){
  ?>
  <script type="module" crossorigin src="<?php echo MYPLUGINWP_URL.'/'.$val['path'] . $val['base'] ; ?>"></script>
  <?php	
}

?>

    <link rel="stylesheet" href="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/css/fontawesome.css" />
    <link rel="stylesheet" href="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/css/icofont.css" />
    <link rel="stylesheet" href="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/css/themify.css" />
    <link rel="stylesheet" href="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/css/flag-icon.css" />
    <link rel="stylesheet" href="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/css/feather-icon.css" />
    <link rel="stylesheet" href="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/css/animate.css" />
    <link rel="stylesheet" href="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/css/chartist.css" />
    <link rel="stylesheet" href="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/css/chartist.css" />
    <link rel="stylesheet" href="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/css/owlcarousel.css" />
    <link rel="stylesheet" href="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/css/prism.css" />
    <link rel="stylesheet" href="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/css/style.css" />
    <link
      id="color"
      rel="stylesheet"
      media="screen"
      href="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/css/color-1.css"
    />
    <link rel="stylesheet" href="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/css/responsive.css" />


</head>
<body>

<?php wp_body_open(); ?>


  <body>



	<div id="appsvelte"></div>






<?php
wp_footer();

?>

</body>
</html>