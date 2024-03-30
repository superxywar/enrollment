

<section id="main-container" class="main-container pb-4">
  <div class="container">
    <div class="row text-center">
      <div class="col-lg-12">
        <h3 class="section-sub-title">Organizational Chart</h3>
      </div>
    </div>
    <!--/ Title row end -->
    <?php
        $o_sel = "SELECT * FROM tbl_official WHERE position='School Principal' ORDER BY official_id DESC";
        $o_sele= $db->prepare($o_sel);
        $o_sele->execute();
        $o_row=$o_sele->fetch();
    ?>
    <div class="row justify-content-center">
      
        <?php
                if($o_row['position']=='School Principal'){
                    echo'<div class="col-lg-3 col-sm-6 mb-5">
                        <div class="ts-team-wrapper">
                        <div class="team-img-wrapper">
                            <img loading="lazy" src="production/admin/images/'.$o_row['photo'].'" style="height:300px; width:280px;" class="img-fluid" alt="team-img">
                        </div>
                        <div class="ts-team-content-classic">
                            <h3 class="ts-name" style="text-align:center;">'.$o_row['firstname'].' '.$o_row['lastname'].'</h3>
                            <p class="ts-designation" style="text-align:center;">'.$o_row['position'].'</p>
                            
                            <!--/ social-icons-->
                        </div>
                        </div>
                        <!--/ Team wrapper 2 end -->
                    </div><!-- Col end -->';
                }
        ?>
        

    </div><!-- Content row 1 end -->

    <div class="row">
        <?php
                    $o_sel = "SELECT * FROM tbl_official WHERE position='Grade 1' ORDER BY official_id DESC";
                    $o_sele= $db->prepare($o_sel);
                    $o_sele->execute();
                    $o_row=$o_sele->fetch();
                    echo'<div class="col-lg-4 col-md-4 col-sm-6 mb-5" >';
                        echo'<div class="ts-team-wrapper">';
                        if($o_row['position']=='Grade 1'){
                            echo'<div class="team-img-wrapper">
                                <img loading="lazy" src="production/admin/images/'.$o_row['photo'].'" style="height:300px; width:280px;" class="img-fluid" alt="team-img">
                            </div>
                            <div class="ts-team-content-classic">
                                <h3 class="ts-name">'.$o_row['firstname'].' '.$o_row['lastname'].'</h3>
                                <p class="ts-designation" >'.$o_row['position'].'</p>
                            </div>';
                        }
                        echo'</div>
                        <!--/ Team wrapper 2 end -->';
                    echo'</div><!-- Col end -->';
                    $o_sel = "SELECT * FROM tbl_official WHERE position='Grade 2' ORDER BY official_id DESC";
                    $o_sele= $db->prepare($o_sel);
                    $o_sele->execute();
                    $o_row=$o_sele->fetch();
                    echo'<div class="col-lg-4 col-md-4 col-sm-6 mb-5" >';
                        echo'<div class="ts-team-wrapper">';
                        if($o_row['position']=='Grade 2'){
                            echo'<div class="team-img-wrapper">
                                <img loading="lazy" src="production/admin/images/'.$o_row['photo'].'" style="height:300px; width:280px;" class="img-fluid" alt="team-img">
                            </div>
                            <div class="ts-team-content-classic">
                                <h3 class="ts-name" >'.$o_row['firstname'].' '.$o_row['lastname'].'</h3>
                                <p class="ts-designation">'.$o_row['position'].'</p>
                            </div>';
                        }
                        echo'</div>
                        <!--/ Team wrapper 2 end -->';
                    echo'</div><!-- Col end -->';
                    $o_sel = "SELECT * FROM tbl_official WHERE position='Grade 3' ORDER BY official_id DESC";
                    $o_sele= $db->prepare($o_sel);
                    $o_sele->execute();
                    $o_row=$o_sele->fetch();
                    echo'<div class="col-lg-4 col-md-4 col-sm-6 mb-5" >';
                        echo'<div class="ts-team-wrapper">';
                        if($o_row['position']=='Grade 3'){
                            echo'<div class="team-img-wrapper">
                                <img loading="lazy" src="production/admin/images/'.$o_row['photo'].'" style="height:300px; width:280px;" class="img-fluid" alt="team-img">
                            </div>
                            <div class="ts-team-content-classic">
                                <h3 class="ts-name" >'.$o_row['firstname'].' '.$o_row['lastname'].'</h3>
                                <p class="ts-designation">'.$o_row['position'].'</p>
                            </div>';
                        }
                        echo'</div>
                        <!--/ Team wrapper 2 end -->';
                    echo'</div><!-- Col end -->';
                    $o_sel = "SELECT * FROM tbl_official WHERE position='Grade 4' ORDER BY official_id DESC";
                    $o_sele= $db->prepare($o_sel);
                    $o_sele->execute();
                    $o_row=$o_sele->fetch();
                    echo'<div class="col-lg-4 col-md-4 col-sm-6 mb-5" >';
                        echo'<div class="ts-team-wrapper">';
                        if($o_row['position']=='Grade 4'){
                            echo'<div class="team-img-wrapper">
                                <img loading="lazy" src="production/admin/images/'.$o_row['photo'].'" style="height:300px; width:280px;" class="img-fluid" alt="team-img">
                            </div>
                            <div class="ts-team-content-classic">
                                <h3 class="ts-name" >'.$o_row['firstname'].' '.$o_row['lastname'].'</h3>
                                <p class="ts-designation">'.$o_row['position'].'</p>
                            </div>';
                        }
                        echo'</div>
                        <!--/ Team wrapper 2 end -->';
                    echo'</div><!-- Col end -->';
                    $o_sel = "SELECT * FROM tbl_official WHERE position='Grade 5' ORDER BY official_id DESC";
                    $o_sele= $db->prepare($o_sel);
                    $o_sele->execute();
                    $o_row=$o_sele->fetch();
                    echo'<div class="col-lg-4 col-md-4 col-sm-6 mb-5" >';
                        echo'<div class="ts-team-wrapper">';
                        if($o_row['position']=='Grade 5'){
                            echo'<div class="team-img-wrapper">
                                <img loading="lazy" src="production/admin/images/'.$o_row['photo'].'" style="height:300px; width:280px;" class="img-fluid" alt="team-img">
                            </div>
                            <div class="ts-team-content-classic">
                                <h3 class="ts-name" >'.$o_row['firstname'].' '.$o_row['lastname'].'</h3>
                                <p class="ts-designation">'.$o_row['position'].'</p>
                            </div>';
                        }
                        echo'</div>
                        <!--/ Team wrapper 2 end -->';
                    echo'</div><!-- Col end -->';
                    $o_sel = "SELECT * FROM tbl_official WHERE position='Grade 6' ORDER BY official_id DESC";
                    $o_sele= $db->prepare($o_sel);
                    $o_sele->execute();
                    $o_row=$o_sele->fetch();
                    echo'<div class="col-lg-4 col-md-4 col-sm-6 mb-5" >';
                        echo'<div class="ts-team-wrapper">';
                        if($o_row['position']=='Grade 6'){
                            echo'<div class="team-img-wrapper">
                                <img loading="lazy" src="production/admin/images/'.$o_row['photo'].'" style="height:300px; width:280px;" class="img-fluid" alt="team-img">
                            </div>
                            <div class="ts-team-content-classic">
                                <h3 class="ts-name" >'.$o_row['firstname'].' '.$o_row['lastname'].'</h3>
                                <p class="ts-designation">'.$o_row['position'].'</p>
                            </div>';
                        }
                        echo'</div>
                        <!--/ Team wrapper 2 end -->';
                    echo'</div><!-- Col end -->';
                    echo'<hr>';
        ?>
        
    </div><!-- Content row end -->
    <div class="row justify-content-center">
      
        <?php
                $o_sel = "SELECT * FROM tbl_official WHERE position='Kinder Adviser' ORDER BY official_id DESC";
                $o_sele= $db->prepare($o_sel);
                $o_sele->execute();
                $o_row=$o_sele->fetch();
                if($o_row['position']=='Kinder Adviser'){
                    echo'<div class="col-lg-3 col-sm-6 mb-5">
                        <div class="ts-team-wrapper">
                        <div class="team-img-wrapper">
                            <img loading="lazy" src="production/admin/images/'.$o_row['photo'].'" style="height:300px; width:280px;" class="img-fluid" alt="team-img">
                        </div>
                        <div class="ts-team-content-classic">
                            <h3 class="ts-name" style="text-align:center;">'.$o_row['firstname'].' '.$o_row['lastname'].'</h3>
                            <p class="ts-designation" style="text-align:center;">'.$o_row['position'].'</p>
                            
                            <!--/ social-icons-->
                        </div>
                        </div>
                        <!--/ Team wrapper 2 end -->
                    </div><!-- Col end -->';
                }
                
        ?>
        

    </div><!-- Content row 1 end -->   
    <div class="row justify-content-center">
      
        <?php
                
                $o_sel = "SELECT * FROM tbl_official WHERE position='School Guard' ORDER BY official_id DESC";
                $o_sele= $db->prepare($o_sel);
                $o_sele->execute();
                $o_row=$o_sele->fetch();
                if($o_row['position']=='School Guard'){
                    echo'<div class="col-lg-3 col-sm-6 mb-5">
                        <div class="ts-team-wrapper">
                        <div class="team-img-wrapper">
                            <img loading="lazy" src="production/admin/images/'.$o_row['photo'].'" style="height:300px; width:280px;" class="img-fluid" alt="team-img">
                        </div>
                        <div class="ts-team-content-classic">
                            <h3 class="ts-name" style="text-align:center;">'.$o_row['firstname'].' '.$o_row['lastname'].'</h3>
                            <p class="ts-designation" style="text-align:center;">'.$o_row['position'].'</p>
                            
                            <!--/ social-icons-->
                        </div>
                        </div>
                        <!--/ Team wrapper 2 end -->
                    </div><!-- Col end -->';
                }
        ?>
        

    </div><!-- Content row 1 end -->       
  </div><!-- Container end -->
</section><!-- Main container end -->