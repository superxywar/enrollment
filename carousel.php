<div class="banner-carousel banner-carousel-2 mb-0">

  <?php
    $s_sel = "SELECT * FROM tbl_slider ORDER BY slider_id DESC limit 5";
    $s_sele= $db->prepare($s_sel);
    $s_sele->execute();
    while($s_row=$s_sele->fetch()){
  ?>
  <div class="banner-carousel-item" style="background-image:url(production/admin/images/<?php echo $s_row['photo']?>)">
    <div class="container">
        <div class="box-slider-content">
          <div class="box-slider-text">
              <h2 class="box-slide-title"><?php echo $s_row['title']?></h2>
              <p class="box-slide-description">
                <?php echo $s_row['description']?>
              </p>
          </div>
        </div>
    </div>
  </div>
  <?php
    }
  ?>
  
</div>