

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


   <!-- Font Awesome-->
   <link rel="stylesheet" type="text/css" href="<?php echo MYPLUGINWP_URL ; ?>/myapp/public/luq/assets/css/fontawesome2.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/css/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/css/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/css/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/css/feather-icon.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/css/owlcarousel.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/css/style.css">
    <link id="color" rel="stylesheet" href="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/css/responsive.css">

</head>
<body>

<?php wp_body_open(); ?>


  <body class="landing-wrraper">

    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper landing-page">
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- header start-->
        <header class="landing-header">
          <div class="custom-container">
            <div class="row">
              <div class="col-12">
                <nav class="navbar navbar-light p-0" id="navbar-example2"><a class="navbar-brand" href="javascript:void(0)"> <img class="img-fluid" src="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/images/logo/logo.png" alt=""></a>
                  <ul class="landing-menu nav nav-pills">
                    <li class="nav-item menu-back">back<i class="fa fa-angle-right"></i></li>
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#demo">Demo</a></li>
                    <li class="nav-item"><a class="nav-link" href="/" target="_blank">Support</a></li>
                    <li class="nav-item">
                      <form class="form-inline" target="_blank" action="/">
                        <button class="nav-link">Hire Us</button>
                      </form>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="/" target="_blank">Document</a></li>
                  </ul>
                  <div class="buy-block"><a class="btn-landing" href="<?php echo home_url()."/my-account"; ?>" >My Account</a>
                    <div class="toggle-menu"><i class="fa fa-bars"></i></div>
                  </div>
                </nav>
              </div>
            </div>
          </div>
        </header>



        <br><br>
        <!-- Main Container -->
        <section class="core-feature section-py-space bg-white">
          <div class="custom-container">
            
              <?php  
        
                      if ( have_posts() ) :
                  while ( have_posts() ) : the_post(); ?>

                      <?php the_content() ?>
                  
                  <?php endwhile;

              else :
                  echo '<p>There are no posts!</p>';

              endif;

              ?>
          </div>
        
        
            </section>
        <!-- END Main Container -->


        <div class="sub-footer">
          <div class="custom-container">
            <div class="row">
              <div class="col-md-6 col-sm-2">
                <div class="footer-contain"><img class="img-fluid" src="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/images/logo/logo.png" alt=""></div>
              </div>
              <div class="col-md-6 col-sm-10">
                <div class="footer-contain">
                  <p class="mb-0">Copyright 2023 © 4in44 All rights reserved.</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!---->
      </div>
    </div>

<?php
wp_footer();

?>


  <!-- latest jquery-->
  <script src="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/js/jquery-3.5.1.min.js"></script>
    <!-- feather icon js-->
    <script src="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- Sidebar jquery-->
    <script src="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/js/sidebar-menu.js"></script>
    <script src="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/js/config.js"></script>
    <!-- Bootstrap js-->
    <script src="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/js/bootstrap/popper.min.js"></script>
    <script src="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/js/bootstrap/bootstrap.min.js"></script>
    <!-- Plugins JS start-->
    <script src="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/js/owlcarousel/owl.carousel.js"></script>
    <script src="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/js/owlcarousel/owl-custom.js"></script>
    <script src="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/js/landing_sticky.js"></script>
    <script src="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/js/landing.js"></script>
    <script src="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/js/jarallax_libs/libs.min.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="<?php echo MYPLUGINWP_URL ; ?>/myapp/dist/luq/assets/js/script.js"></script>

</body>
</html>


