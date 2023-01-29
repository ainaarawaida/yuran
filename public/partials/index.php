

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


