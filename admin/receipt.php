<?php
    require_once'../../database/dbconfig.php';
    require_once'../../database/control_page.php';

    if(!isset($_SESSION['user_id'])){
        header('Location:../../');
    }
    elseif(!isset($_SESSION['sy_id'])){
        header('Location:../log/index.php?page=select_schoolyear');
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SDA Online Enrollment System </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
    <style type="text/css">
        @page {
           
            /* Wildly different margins – the order matches the standard CSS margin property:
            north, east, south, west. */
            margin: 0.1in;
        }
        #tables{
            width:100%;
            font-family: 'Trispace', sans-serif;
        }
        #tables th{
            border: 1px solid #000;
            padding:5px;
        }
        #tables td{
            border: 1px solid #000;
            padding:5px;
        }
        .receipt{
          width: 10cm;
          min-height: 29.7cm;
          border: 1px #D3D3D3 solid;
          border-radius: 5px;
          background: white;
          box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
          
        }
        @media print {
            .receipt {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }

        .page-break  { display: block; page-break-before: always; }
    </style>
</head>
<body onload="window.print();" class="receipt" >
    <div class="wrapper" style="overflow: hidden;">
    <?php
        if(isset($_GET['page'])){
        if ($show==1)
            require_once $touch;
        }
    ?>
    </div>
</body>
</html>
