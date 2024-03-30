<?php
    require_once'database/dbconfig.php';
    require_once'control_page.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Basic Page Needs
================================================== -->
  <meta charset="utf-8">
  <title>IPIL DISTRICT ADVENTIST ELEMENTARY SCHOOL INC.</title>

  <!-- Mobile Specific Metas
================================================== -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="SDA Template">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">

  <!-- Favicon
================================================== -->
  <link rel="icon" type="image/png" href="">

  <!-- CSS
================================================== -->
  <!-- Bootstrap -->
  <link rel="stylesheet" href="frontend_template/plugins/bootstrap/bootstrap.min.css">
  <!-- FontAwesome -->
  <link rel="stylesheet" href="frontend_template/plugins/fontawesome/css/all.min.css">
  <!-- Animation -->
  <link rel="stylesheet" href="frontend_template/plugins/animate-css/animate.css">
  <!-- slick Carousel -->
  <link rel="stylesheet" href="frontend_template/plugins/slick/slick.css">
  <link rel="stylesheet" href="frontend_template/plugins/slick/slick-theme.css">
  <!-- Colorbox -->
  <link rel="stylesheet" href="frontend_template/plugins/colorbox/colorbox.css">
  <!-- Template styles-->
  <link rel="stylesheet" href="frontend_template/css/styles.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="template/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="template/bower_components/Ionicons/css/ionicons.min.css">
  <style type="text/css">
    
    [type="number"]::-webkit-inner-spin-button {
      display: none;
    }
  </style>
  <script type="text/javascript">
        window.setTimeout(function() {
            $(".alert").fadeTo(1200, 0).slideUp(800, function(){
            $(this).remove(); 
            });
        }, 2000);
  </script>
</head>

<body>
    <div class="body-inner">
        <?php
            require_once'top_bar.php';
            require_once'header.php';
           // require_once'menu.php';
        ?>
        <?php
            if(isset($_GET['page'])){
                if ($show==1)
                echo'<div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 mb-12">';
                                require_once $touch;
                            echo'</div>';
                    echo'</div>';
                echo'</div>';
            }
            else{
            require_once'carousel.php';
            require_once'content.php';
            }
        ?>
        <?php
            
            require_once'footer.php';
        ?>
  <!-- Javascript Files
  ================================================== -->

  <!-- initialize jQuery Library -->
  <script src="frontend_template/plugins/jQuery/jquery.min.js"></script>
  <!-- Bootstrap jQuery -->
  <script src="frontend_template/plugins/bootstrap/bootstrap.min.js" defer></script>
  <!-- Slick Carousel -->
  <script src="frontend_template/plugins/slick/slick.min.js"></script>
  <script src="frontend_template/plugins/slick/slick-animation.min.js"></script>
  <!-- Color box -->
  <script src="frontend_template/plugins/colorbox/jquery.colorbox.js"></script>
  <!-- shuffle -->
  <script src="frontend_template/plugins/shuffle/shuffle.min.js" defer></script>

  <!-- Google Map Plugin-->
  <script src="plugins/google-map/map.js" defer></script>

  <!-- Template custom -->
  <script src="frontend_template/js/script.js"></script>
  
  </div>
</body>
