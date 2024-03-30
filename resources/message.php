<?php


    if(isset($_SESSION['message'])){
        $message = $_SESSION['message'];

        switch ($message){

            case 1:
            echo'<div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissible"  style="margin:10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Success!!! </h4>
                        Data successfully modify.
                    </div>
                </div>
            </div>';

            unset($_SESSION['message']);
            break;

            case 2:
            echo'<div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissible"  style="margin:10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Success!!! </h4>
                        School year successfully has been changed to active.
                    </div>
                </div>
            </div>';
    
            unset($_SESSION['message']);
            break;

            case 3:
            echo'<div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissible"  style="margin:10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Success!!! </h4>
                        School year successfully has been changed to inactive.
                    </div>
                </div>
            </div>';
    
            unset($_SESSION['message']);
            break;

            case 4:
            echo'<div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissible"  style="margin:10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Success!!! </h4>
                        Academic program successfully has been changed to active.
                    </div>
                </div>
            </div>';
    
            unset($_SESSION['message']);
            break;

            case 5:
            echo'<div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissible"  style="margin:10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Success!!! </h4>
                        Academic program successfully has been changed to inactive.
                    </div>
                </div>
            </div>';
    
            unset($_SESSION['message']);
            break;

            case 6:
            echo'<div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissible"  style="margin:10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Success!!! </h4>
                        Data has been removed.
                    </div>
                </div>
            </div>';
    
            unset($_SESSION['message']);
            break;

            case 7:
            echo'<div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissible"  style="margin:10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Success!!! </h4>
                        Academic program has been successfully created.
                    </div>
                </div>
            </div>';
    
            unset($_SESSION['message']);
            break;

            case 8:
            echo'<div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissible"  style="margin:10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Success!!! </h4>
                        Teacher has been set to active.
                    </div>
                </div>
            </div>';
    
            unset($_SESSION['message']);
            break;

            case 9:
            echo'<div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissible"  style="margin:10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Success!!! </h4>
                        Schedule has been loaded.
                    </div>
                </div>
            </div>';
    
            unset($_SESSION['message']);
            break;

            case 10:
            echo'<div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissible"  style="margin:10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Success!!! </h4>
                        Schedule load has been remove.
                    </div>
                </div>
            </div>';
    
            unset($_SESSION['message']);
            break;

            case 11:
            echo'<div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissible"  style="margin:10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Success!!! </h4>
                        Data successfully save.
                    </div>
                </div>
            </div>';

            unset($_SESSION['message']);
            break;

            case 12:
            echo'<div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissible"  style="margin:10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Success!!! </h4>
                        Student has been successfully added subject load you may now proceed to the registrar for the payment.
                    </div>
                </div>
            </div>';

            unset($_SESSION['message']);
            break;

            case 13:
            echo'<div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissible"  style="margin:10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Success!!! </h4>
                        Payment has been made.
                    </div>
                </div>
            </div>';

            unset($_SESSION['message']);
            break;

            case 14:
            echo'<div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissible"  style="margin:10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Success!!! </h4>
                        Data has been removed.
                    </div>
                </div>
            </div>';

            unset($_SESSION['message']);
            break;

            case 15:
            echo'<div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissible"  style="margin:10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Success!!! </h4>
                        Grades has been updated.
                    </div>
                </div>
            </div>';

            unset($_SESSION['message']);
            break;

            case 16:
            echo'<div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissible"  style="margin:10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Success!!! </h4>
                        Posting grades has been successfully done.
                    </div>
                </div>
            </div>';

            unset($_SESSION['message']);
            break;

            case 17:
            echo'<div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissible"  style="margin:10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Error!!! </h4>
                        New Student must be start at grade 1.
                    </div>
                </div>
            </div>';

            unset($_SESSION['message']);
            break;

            case 18:
            echo'<div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissible"  style="margin:10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Success!!! </h4>
                        Please input the grades to complete the transaction.
                    </div>
                </div>
            </div>';

            unset($_SESSION['message']);
            break;
            
            case 19:
            echo'<div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissible"  style="margin:10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Error!!! </h4>
                        Student already enroll for this school year.
                    </div>
                </div>
            </div>';

            unset($_SESSION['message']);
            break;
            
            case 20:
            echo'<div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissible"  style="margin:10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Success!!! </h4>
                        Application has been submitted waiting for confirmation.
                    </div>
                </div>
            </div>';

            unset($_SESSION['message']);
            break;
            
            case 21:
            echo'<div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissible"  style="margin:10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Error!!! </h4>
                        Application has been disapproved.
                    </div>
                </div>
            </div>';

            unset($_SESSION['message']);
            break;

            case 22:
            echo'<div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissible"  style="margin:10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Success!!! </h4>
                        Student has been successfully added subject load you may now proceed to the registrar for the payment.
                    </div>
                </div>
            </div>';

            unset($_SESSION['message']);
            break;

            case 23:
            echo'<div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissible"  style="margin:10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Success!!! </h4>
                        Data successfully save.
                    </div>
                </div>
            </div>';

            unset($_SESSION['message']);
            break;

            case 24:
            echo'<div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissible"  style="margin:10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Error!!! </h4>
                        Your payment was not enough for the total payment.
                    </div>
                </div>
            </div>';

            unset($_SESSION['message']);
            break;

            case 25:
            echo'<div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissible"  style="margin:10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Success!!! </h4>
                        Payment has been updated.
                    </div>
                </div>
            </div>';

            unset($_SESSION['message']);
            break;

            case 26:
            echo'<div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissible"  style="margin:10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Error!!! </h4>
                        there was an error on submitting the payment. Please provide the O.R. Number, Payee Name and Cash.
                    </div>
                </div>
            </div>';

            unset($_SESSION['message']);
            break;
            
            case 27:
            echo'<div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissible"  style="margin:10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Success!!! </h4>
                        Data successfully modify.
                    </div>
                </div>
            </div>';

            unset($_SESSION['message']);
            break;
            
            case 28:
            echo'<div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissible"  style="margin:10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Error!!! </h4>
                        The amount was greater to the balance.
                    </div>
                </div>
            </div>';

            unset($_SESSION['message']);
            break;
        }
    }
?>