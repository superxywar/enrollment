<?php
    require_once'../../resources/script_login.php';
?>
<!-- /.login-logo -->
<div class="card card-outline card-primary">
    <div class="card-header text-center" style="height:100px;">
        <a href="../../" class="h4" style="color:#192655;"><b>IPIL SDA ONLINE ENROLLMENT SYSTEM</b></a><br>
        <p class="login-box-msg">SYSTEM LOGIN</p>
    </div>
    <div class="card-body">
        

        <form action="" method="post">
            <div class="input-group mb-3">
                <input type="email" name="email" class="form-control"  autocomplete="off" required placeholder="Input your e-mail">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" name="password" class="form-control"  autocomplete="off"  required   placeholder="Input your password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                
                <!-- /.col -->
                <div class="col-12">
                    <button type="submit" name="btn_log" class="btn btn-primary btn-block">LOGIN TO THE SYSTEM</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->