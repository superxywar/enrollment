<?php
    require_once'../../resources/script_enroll.php';
    require_once'../../resources/message.php';

    $s_sel = "SELECT * FROM tbl_student WHERE stud_id=:stud_id";
    $s_sele= $db->prepare($s_sel);
    $s_sele->bindParam(':stud_id',$_GET['stud_id']);
    $s_sele->execute();
    $s_row = $s_sele->fetch();

    $a_sel = "SELECT * FROM tbl_academic WHERE status='Active' ORDER BY acad_id DESC";
    $a_sele= $db->prepare($a_sel);
    $a_sele->execute();
    $a_row = $a_sele->fetch();
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
                        document.getElementById('statedivs').innerHTML=req.responseText;                     
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
                    <h3 class="card-title" style="font-size:16px;"><i class="nav-icon fas fa-list-alt"></i>&nbsp;&nbsp;Enrollment Module</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Student No.</label>
                                    <input type="text" class="form-control" autocomplete="off" placeholder="<?php echo $s_row['stud_no']?>" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Student Name</label>
                                    <input type="text" class="form-control" autocomplete="off" placeholder="<?php echo $s_row['lastname'].', '.$s_row['firstname']?>" readonly>
                                </div>
                            </div>
                            <?php
                                $e_sel = "SELECT * FROM tbl_enroll WHERE stud_id=:stud_id AND stat_enroll='Enrolled' ORDER BY grade_id DESC";
                                $e_sele= $db->prepare($e_sel);
                                $e_sele->bindParam(':stud_id',$_GET['stud_id']);
                                $e_sele->execute();
                                if($e_sele->rowCount()>=1){
                                    $e_row    = $e_sele->fetch();
                                    $grade_id = $e_row['grade_id'] + 1;


                                    if($grade_id>6){}
                                    else{
                                        $query	=	"SELECT * FROM tbl_section WHERE grade_id=:grade_id";
                                        $queries= $db->prepare($query);
                                        $queries->bindParam(':grade_id',$grade_id);
                                        $queries->execute();
                            ?>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Grade Level :</label>
                                    <input type="hidden" name="grade_id" value="<?php echo $grade_id?>" >
                                    <input type="text" value="<?php echo 'Grade '.$grade_id?>" class="form-control" autocomplete="off" readonly>
                                    </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Section</label>
                                    <select  name="state" class="form-control select2" required>
                                        <option value="">Select Section</option>
                                    <?php 
                                        while($row=$queries->fetch()){

                                    ?>
                                        <option value="<?php echo $row['section_id'];?>"><?php echo $row['section'];?></option>
                                    <?php 
                                        } 
                                    ?>
                                    </select>
                                </div>
                                
                            </div>
                            <?php
                                    }
                                    $i = 2;
                                }
                                else{
                            ?>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Grade Level :</label>
                                    <select name="grade_id" class="form-control" onChange="getState(this.value)" required>
                                        <option value="">Select Grade Level</option>
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
                                    <div id="statedivs">
                                        <select name="state" required style="width: 100%;" class="form-control">
                                        <option value="">Select Section</option>
                                        </select>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Status of Enrollment :</label>
                                    <select name="status" class="form-control" required>
                                        <option value="">Select Status</option>
                                        <option value="New Student">New Student</option>
                                        <option value="Transferee">Transferee</option>
                                    </select>
                                </div>
                            </div>
                            <?php
                                    $i = 1;
                                }
                            ?>
                            
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <input type="hidden" name="acad_id" value="<?php echo $a_row['acad_id']?>">
                        <input type="hidden" name="stud_id" value="<?php echo $_GET['stud_id']?>">
                        <input type="hidden" name="script" value="<?php echo $i?>">
                        <button type="submit" class="btn btn-primary" name="btn_submit" style="float:right;"><i class="nav-icon fas fa-check"></i>&nbsp;Enroll</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
</section>
