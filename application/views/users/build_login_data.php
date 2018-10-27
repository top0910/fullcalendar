<div class="page-wrapper">
<div class="container-fluid">
<div class="row">
  <center>
    <?php    
    if((isset($msg))&& (isset($alert_class)))
    {
      echo "<div class=\"alert ". $alert_class ."\">";
      echo $msg;
      echo "<a class=\"alink\" href=\"#\" aria-label=\"close\">&times;</a></div>";
    }
    ?>                           
  </center>      

  <div class="col-lg-6">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Front Banner Image</h4>
        <!-- <h6 class="card-subtitle">made with bootstrap elements</h6> -->
        <div class="box-body">
          <div class="logo" style="border: 1px solid #ccc; text-align: center;">
            <?php if($get_landing_page_data['building_image']!= NULL){ ?>
            <img src=<?php print_r($get_landing_page_data['building_image']);?> style="width:100%">
            <?php }else{ ?>
            <img src="<?=base_url()?>assets/backend/img/mainbody.jpg?<?=time()?>" alt="logo" style="width:100%">
            <?php } ?>          

          </div>
          <label for="imageInputFile">Mainbody File input</label>

          <?php if(isset($error))echo $error;?>
          <?php echo form_open_multipart('building_data/upload_login_banner');?>
          <?php echo form_input(['type'=>'file','name'=>' building_image','class'=>'form-control']); ?>
          <br /><br />
          <div class="upload_button">
            <?php echo "<input type='submit' name='submit' value='Upload' class='btn btn-success btn-md'/>";?>
          </div>
          <?php echo form_close(); ?>


        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Image under Login Form</h4>
        <a class="btn btn-warning btn-sm" href="<?= base_url('building_data/image2_delete') ?>" onclick="if(confirm('Are your sure want to delete !'));else{ return false}" style="float: right;"><span class="glyphicon glyphicon-trash"></span> Delete Image</a>
      </div>
      <div class="box-body">
        <div class="logo" style="border: 1px solid #ccc; text-align: center;">
          <?php if($get_landing_page_data['building_image2']!= NULL){ ?>
          <img src=<?php print_r($get_landing_page_data['building_image2']);?> style="width:100%">
          <?php }else{ ?>
          <img src="<?=base_url()?>assets/backend/img/mainbody.jpg?<?=time()?>" alt="logo" style="width:100%">
          <?php } ?>          
        </div>
        <label for="imageInputFile">Mainbody File input</label>
        <?php if(isset($error))echo $error;?>
        <?php echo form_open_multipart('building_data/upload_login_banner2');?>
        <?php echo form_input(['type'=>'file','name'=>' building_image2','class'=>'form-control']); ?>
        <br /><br />
        <div class="upload_button">
          <?php echo "<input type='submit' name='submit' value='Upload' class='btn btn-success btn-md'>";?>
        </div>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>







  <!-- ================================================================================================================== -->
  <div class="col-lg-6">
    <div class="card">
      <center>
        <?php    
        if((isset($msg))&& (isset($alert_class)))
        {
          echo "<div class=\"alert ". $alert_class ."\">";
          echo $msg;
          echo "<a class=\"alink\" href=\"#\" aria-label=\"close\">&times;</a></div>";
        }
        ?>                           
      </center>

      <div class="card-body">
        <h4 class="card-title">Landing Page</h4>
        <!-- <h6 class="card-subtitle">made with bootstrap elements</h6> -->
        <div class="box-body">
          <?php echo form_open('building_data/update_login_page'); ?>

          <div style="border:1px solid #ccc; padding: 20px; margin-top: 10px;">
            <div class="row"><div class="col-md-12" style="margin-top: 10px;"><label>Home Title</label></div></div>
            <div class="row" style="margin-top: 10px;">
              <div class="col-md-12">
                <?= form_input(['name'=>' building_title','class'=>'form-control','placeholder'=>'Write page title here...','value'=>$get_landing_page_data['building_title']]); ?>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12" style="margin-top: 10px;">
                <label>Home Text</label>  
              </div>
            </div>
            <div class="row">
              <div class="col-md-12" style="margin-top: 10px;">
                <?= form_textarea(['name'=>'building_text','class'=>'form-control','rows'=>'3','placeholder'=>'Some text...','value'=>$get_landing_page_data['building_text']]);  ?>
              </div>
            </div>
          </div>
          <br/>
          <?= form_submit(['value'=>'Update Landing Page','class'=>'btn btn-success btn-md']); ?>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>


    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Custom Dashboard Logo</h4>
        <!-- <h6 class="card-subtitle">made with bootstrap elements</h6> -->
        <div class="box-body">
          <div class="logo" style="border: 1px solid #ccc; text-align: center;">
            <?php if($get_landing_page_data['custom_logo']){ ?>
              <img src=<?php print_r($get_landing_page_data['custom_logo']);?> style="width:100%">
            <?php }else{ ?>
              <img src="<?= base_url()?>assets/images/custom_logo.jpg" alt="logo" style="width:100%">
            <?php } ?>          
          </div>
          <?php if(isset($error))echo $error;?>
          <?php echo form_open_multipart('building_data/upload_custom_logo');?>
          <?php echo form_input(['type'=>'file','name'=>' custom_logo','class'=>'form-control']); ?>
          <br /><br />
          <div class="upload_button">
            <?php echo "<input type='submit' name='submit' value='Upload' class='btn btn-success btn-md'/>";?>
          </div>
          <?php echo form_close(); ?>


        </div>
      </div>
    </div>

  </div>
</div>
</div>
</div>


</div>

</div>