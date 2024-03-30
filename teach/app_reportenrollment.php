<?php
    require_once'../../resources/message.php';
?>
<script>
    function getXMLHTTP() { //fuction to return the xml http object
        var xmlhttp=false;  
        try{
            xmlhttp=new XMLHttpRequest();
        }
        catch(e)    {       
            try{            
                xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch(e){
                try{
                xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                }
                catch(e1){
                    xmlhttp=false;
                }
            }
        }
            
        return xmlhttp;
    }
    function getState(countryId) {      
        
        var strURL="select_subjects.php?country="+countryId;
        var req = getXMLHTTP();
        
        if (req) {
            
            req.onreadystatechange = function() {
                if (req.readyState == 4) {
                    // only if "OK"
                    if (req.status == 200) {                        
                        document.getElementById('statediv').innerHTML=req.responseText;                     
                    } else {
                        alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                    }
                }               
            }           
            req.open("GET", strURL, true);
            req.send(null);
        }  
    }
</script>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2"></div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header" style="background-color:#343a40;">
                    <h3 class="card-title" style="font-size:16px;"><i class="nav-icon fas fa-user-alt"></i>&nbsp;&nbsp;Enrollment Report</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="print.php?page=print_enrollment" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">School Year :</label>
                                    <select name="sy_id" class="form-control" required>
                                        <option value="">Select School Year</option>
                                        <?php
                                            $g_sel = "SELECT * FROM tbl_schoolyear ORDER BY sy_id ASC";
                                            $g_sele= $db->prepare($g_sel);
                                            $g_sele->execute();
                                            while($g_row=$g_sele->fetch()){
                                                echo'<option value="'.$g_row['sy_id'].'">'.$g_row['start_year'].'-'.$g_row['end_year'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Academic Program :</label>
                                    <select name="acad_id" class="form-control" required>
                                        <option value="">Select Academic Program</option>
                                        <?php
                                            $g_sel = "SELECT * FROM tbl_academic ORDER BY acad_id ASC";
                                            $g_sele= $db->prepare($g_sel);
                                            $g_sele->execute();
                                            while($g_row=$g_sele->fetch()){
                                                echo'<option value="'.$g_row['acad_id'].'">'.$g_row['program_name'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Grade Level :</label>
                                    <select name="grade_id" class="form-control" onChange="getState(this.value)" required>
                                        <option value="">Select Grade</option>
                                        <?php
                                            $g_sel = "SELECT * FROM tbl_gradelevel ORDER BY grade_id ASC";
                                            $g_sele= $db->prepare($g_sel);
                                            $g_sele->execute();
                                            while($g_row=$g_sele->fetch()){
                                                echo'<option value="'.$g_row['grade_id'].'">'.$g_row['grade'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Section</label>
                                    <div id="statediv">
                                        <select name="state" required style="width: 100%;" class="form-control">
                                        <option value="">Select Section</option>
                                        </select>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="btn_search" style="float:right;"><i class="nav-icon fas fa-search"></i>&nbsp;Generate Report</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
</section>
