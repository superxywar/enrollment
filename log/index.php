<?php
    require_once'../../database/dbconfig.php';
    require_once'../../database/control_page.php';
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IPIL SDA SYSTEM LOGIN</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../templates/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../../templates/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../templates/dist/css/adminlte.min.css">
    <script type="text/javascript">
        window.setTimeout(function() {
            $(".alert").fadeTo(1200, 0).slideUp(800, function(){
            $(this).remove(); 
            });
        }, 2000);
    </script>
    <style type="text/css">
        #body{
        background: rgb(237,28,74);
        background: linear-gradient(312deg, rgb(11, 36, 71) 20%, rgb(87, 108, 188) 80%);
        background-repeat: no-repeat;
        height:40em;
        }
    </style>
</head>
    <body class="hold-transition login-page" id="body">
        
        <div class="login-box" >
        <?php
            if(isset($_GET['page'])){
                if ($show==1)
                require_once $touch;
            }
            else{
            require_once'main-content.php';
            }
        ?>
        </div>
        <!-- /.login-box -->
    <!-- jQuery -->
    <script src="../../templates/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../templates/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../templates/dist/js/adminlte.min.js"></script>
    </body>
</html>
