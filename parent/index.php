<?php
    require_once'../../database/dbconfig.php';
    require_once'../../database/control_page.php';

    if(!isset($_SESSION['stud_id'])){
        header('Location:../../');
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
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../templates/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../../templates/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../templates/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../templates/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../../templates/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../../templates/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="../../templates/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../templates/dist/css/adminlte.css">
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
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <?php
        require_once'header.php';
        require_once'sidebar.php';
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
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
    <!-- /.content-wrapper -->
    <?php
        require_once'footer.php';
    ?>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../templates/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../templates/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../templates/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../templates/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../templates/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../templates/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../templates/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../templates/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../templates/plugins/jszip/jszip.min.js"></script>
<script src="../../templates/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../templates/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../templates/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../templates/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../templates/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Select2 -->
<script src="../../templates/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="../../templates/plugins/select2/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="../../templates/dist/js/adminlte.min.js"></script>
<!-- Page specific script -->
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();

        $("#example0").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).container().appendTo('#example0_wrapper .col-md-6:eq(0)');
        $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        });
    });
</script>
</body>
</html>
