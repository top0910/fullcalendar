<div class="page-wrapper">

  <div class="container-fluid">
<!--     <div class="row page-titles">
      <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Forms</h3>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
          <li class="breadcrumb-item active">Form</li>
        </ol>
      </div>
    </div> -->

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
            <h4 class="card-title">Logo Image</h4>
            <!-- <h6 class="card-subtitle">made with bootstrap elements</h6> -->
            <div class="box-body">
              <?php 
              if (empty($building_dashboard['logo_image'])) { ?>
              <div class="logo" style="border: 1px solid #ccc; text-align: center;">
                <img src="<?=base_url()?>assets/backend/img/header/sub-logo.png" alt="logo">
              </div>
              <?php }
              else
                { ?>
                  <div class="logo" style="border: 1px solid #ccc; text-align: center;">
                    <img src="<?= $building_dashboard['logo_image'] ?>" alt="logo"  style="max-width: 200px;" >
                  </div>
                  <? } ?>

                  <label for="imageInputFile">Upload Logo</label>

                  <?php if(isset($error))echo $error;?>
                  <?php echo form_open_multipart('building_data/upload_logo');?>
                  <?php echo form_input(['type'=>'file','name'=>'logo_image','class'=>'form-control']); ?>
                  <br /><br />

                  <div class="text-left">
                    <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                    <button type="reset" class="btn btn-inverse waves-effect waves-light">Reset</button>
                  </div>

                  <?php echo form_close(); ?>


                </div>
              </div>
            </div>

            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Icon Bar Image</h4>
                <div class="box-body">
                  <?php 
                  if (empty($building_dashboard['icon_bar_image'])) { ?>
                  <div class="logo" style="border: 1px solid #ccc; text-align: center;">
                    <!-- <img src="<?=base_url()?>assets/backend/img/header/sub-logo.png" alt="logo"> -->
                    <img src="<?= base_url()?>assets/images/iconbar.jpg" alt="Our Services" style="width:100%; height: 90%;">
                  </div>
                  <?php }
                  else
                    { ?>
                      <div class="logo" style="border: 1px solid #ccc; text-align: center;">
                        <img src="<?= $building_dashboard['icon_bar_image'] ?>" alt="logo"  style="max-width: 200px;" >
                      </div>
                      <? } ?>

                      <label for="imageInputFile">Upload Logo</label>

                      <?php if(isset($error))echo $error;?>
                      <?php echo form_open_multipart('building_data/upload_icon_bar');?>
                      <?php echo form_input(['type'=>'file','name'=>'icon_bar_image','class'=>'form-control']); ?>
                      <br /><br />
                      <div class="text-left">
                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                        <button type="reset" class="btn btn-inverse waves-effect waves-light">Reset</button>
                      </div>
                      <?php echo form_close(); ?>

                    </div>
                  </div>
                </div>
              


<!-- ===================== -->

            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Front Banner Image</h4>
          <div class="box-body">
            <div class="logo" style="border: 1px solid #ccc; text-align: center;">
                <img src="<?=base_url()?>assets/backend/img/mainbody.jpg" alt="logo" style="width:100%">
            </div>
            <label for="imageInputFile">Mainbody File input</label>

            <?php if(isset($error))echo $error;?>
            <?php echo form_open_multipart('building_data/upload_banner');?>
            <?php echo form_input(['type'=>'file','name'=>'banner_image','class'=>'form-control']); ?>
            <br /><br />
            <div class="upload_button">
                <?php echo "<input type='submit' name='submit' value='Upload'/>";?>
            </div>
            <?php echo form_close(); ?>


          </div>
                  </div>
                </div>

<!-- ===================== -->

<div class="card">
  <div class="card-body">
    <h4 class="card-title">FAQ Landing Page</h4>
    <div class="box-body">
      <label for="imageInputFile">Landing Page FAQ information</label>
      <?php echo form_open('building_data/update_faq'); ?>
      <div class="row" style="margin-top: 10px;">
        <div class="col-md-12">

          <textarea class="textarea" id="mymce" placeholder="Message" class="form-control" name="faq"  rows="20"><?= $get_landing_page_data['faq']?></textarea>
        </div>
      </div>

      <?= form_submit(['value'=>'Submit','class'=>'btn btn-success btn-lg']); ?>
      <?= form_close(); ?>
    </div>
  </div>
</div>

</div><!--+++++++ Col - 6 - Ending +++++++-->

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
              <?php echo form_open('building_data/update_landing_page'); ?>

                  <div style="border:1px solid #ccc; padding: 20px; margin-top: 10px;">
                    <div class="row"><div class="col-md-12" style="margin-top: 10px;"><label>Home Title</label></div></div>
                    <div class="row" style="margin-top: 10px;">
                      <div class="col-md-12">
                        <?= form_input(['name'=>'page_title','class'=>'form-control','placeholder'=>'Write page title here...','value'=>$get_landing_page_data['page_title']]); ?>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12" style="margin-top: 10px;">
                        <label>Home Text</label>  
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12" style="margin-top: 10px;">
                        <?= form_textarea(['name'=>'page_text','class'=>'form-control','rows'=>'3','placeholder'=>'Some text...','value'=>$get_landing_page_data['page_text']]);  ?>
                      </div>
                    </div>
                  </div>
                  <div style="border:1px solid #ccc; padding: 10px; margin-top: 10px;">
                    <div class="col-md-12" style="margin-top: 10px;">
                        <label>Sub Title 1</label>  
                      </div>
                    <div class="row">
                      <div class="col-md-12" style="margin-top: 10px">
                        <?= form_textarea(['name'=>'sub_title1','class'=>'form-control','rows'=>'3','placeholder'=>'Some text...','value'=>$get_landing_page_data['sub_title1']]);  ?>
                      </div>
                    </div>
                    <div class="col-md-12" style="margin-top: 10px;">
                        <label>Sub Text 1</label>  
                      </div>
                    <div class="row">
                      <div class="col-md-12" style="margin-top: 10px">
                        <?= form_textarea(['name'=>'sub_text1','class'=>'form-control','rows'=>'3','placeholder'=>'Some text...','value'=>$get_landing_page_data['sub_text1']]);  ?>
                      </div>
                    </div>


                    <div class="col-md-12" style="margin-top: 10px;">
                        <label>sub Title 2</label>  
                      </div>
                    <div class="row">
                      <div class="col-md-12" style="margin-top: 10px">
                        <?= form_textarea(['name'=>'sub_title2','class'=>'form-control','rows'=>'3','placeholder'=>'Some text...','value'=>$get_landing_page_data['sub_title2']]);  ?>
                      </div>
                    </div>

                    <div class="col-md-12" style="margin-top: 10px;">
                        <label>Sub Text 2</label>  
                      </div>
                    <div class="row">
                      <div class="col-md-12" style="margin-top: 10px">
                        <?= form_textarea(['name'=>'sub_text2','class'=>'form-control','rows'=>'3','placeholder'=>'Some text...','value'=>$get_landing_page_data['sub_text2']]);  ?>
                      </div>
                    </div>

                    <div class="col-md-12" style="margin-top: 10px;">
                        <label>Sub Title 3</label>  
                      </div>
                    <div class="row">
                      <div class="col-md-12" style="margin-top: 10px">
                        <?= form_textarea(['name'=>'sub_title3','class'=>'form-control','rows'=>'3','placeholder'=>'Some text...','value'=>$get_landing_page_data['sub_title3']]);  ?>
                      </div>
                    </div>


                    <div class="col-md-12" style="margin-top: 10px;">
                        <label>Sub Text 3</label>  
                      </div>
                    <div class="row">
                      <div class="col-md-12" style="margin-top: 10px">
                        <?= form_textarea(['name'=>'sub_text3','class'=>'form-control','rows'=>'3','placeholder'=>'Some text...','value'=>$get_landing_page_data['sub_text3']]);  ?>
                      </div>
                    </div>
                  </div>

                  <div style="border:1px solid #ccc; padding: 10px; margin-top: 10px;">
                    
                    <div class="col-md-12" style="margin-top: 10px;">
                        <label>Provide Title</label>
                      </div>
                    <div class="row">
                      <div class="col-md-12" style="margin-top: 10px;">
                        <?= form_textarea(['name'=>'provide_title','class'=>'form-control','rows'=>'3','placeholder'=>'Some text...','value'=>$get_landing_page_data['provide_title']]);  ?>
                      </div>
                    </div>


                    <div class="col-md-12" style="margin-top: 10px;">
                        <label>Provide Content</label>
                      </div>
                    <div class="row">
                      <div class="col-md-12" style="margin-top: 10px;">
                        <?= form_textarea(['name'=>'provide_content','class'=>'form-control','rows'=>'3','placeholder'=>'Some text...','value'=>$get_landing_page_data['provide_content']]);  ?>
                      </div>
                    </div>
                  </div>

                  <div style="border:1px solid #ccc; padding: 10px; margin-top: 10px;">

                    <div class="col-md-12" style="margin-top: 10px;">
                        <label>About Us</label>
                      </div>
                    <div class="row">
                      <div class="col-md-12" style="margin-top: 10px;">
                        <?= form_textarea(['name'=>'about_text','class'=>'form-control','rows'=>'3','placeholder'=>'Some text...','value'=>$get_landing_page_data['about_text']]);  ?>
                      </div>
                    </div>
                  </div>

                  <div style="border:1px solid #ccc; padding: 10px; margin-top: 10px;">
                  
                  <div class="col-md-12" style="margin-top: 10px;">
                        <label>Email</label>
                      </div>
                    <div class="row">
                      <div class="col-md-12" style="margin-top: 10px;">
                        <?= form_input(['type'=>'email','name'=>'landing_email','class'=>'form-control','placeholder'=>'Email Address','value'=>$get_landing_page_data['landing_email']]);  ?>
                      </div>
                    </div>

                    <div class="col-md-12" style="margin-top: 10px;">
                        <label>Phone Number</label>
                      </div>
                    <div class="row">
                      <div class="col-md-12" style="margin-top: 10px;">
                        <?= form_input(['type'=>'tel','name'=>'landing_phone','class'=>'form-control','placeholder'=>'Phone','value'=>$get_landing_page_data['landing_phone']]);  ?>
                      </div>
                    </div>

                    <div class="col-md-12" style="margin-top: 10px;">
                        <label>Contact US</label>
                    </div>
                    <div class="row">
                      <div class="col-md-12" style="margin-top: 10px;">
                        <?= form_input(['name'=>'contactus','class'=>'form-control','placeholder'=>'ContactUs','value'=>$get_landing_page_data['contactus']]);  ?>
                      </div>
                    </div>


                    <div class="col-md-12" style="margin-top: 10px;">
                        <label>Service Title 1</label>
                    </div>
                    <div class="row">
                      <div class="col-md-12" style="margin-top: 10px;">
                        <?= form_input(['name'=>'service_title_1','class'=>'form-control','rows'=>'4','placeholder'=>'Service Title 1','value'=>$get_landing_page_data['service_title_1']]);  ?>
                      </div>
                    </div>
                    <div class="col-md-12" style="margin-top: 10px;">
                        <label>Service Text 1</label>
                    </div>
                    <div class="row">
                      <div class="col-md-12" style="margin-top: 10px;">
                        <?= form_textarea(['name'=>'service_text_1','class'=>'form-control','rows'=>'4','placeholder'=>'Service Text 1','value'=>$get_landing_page_data['service_text_1']]);  ?>
                      </div>
                    </div>


                    <div class="col-md-12" style="margin-top: 10px;">
                        <label>Service Title 2</label>
                    </div>
                    <div class="row">
                      <div class="col-md-12" style="margin-top: 10px;">
                        <?= form_input(['name'=>'service_title_2','class'=>'form-control','rows'=>'4','placeholder'=>'Service Title 2','value'=>$get_landing_page_data['service_title_2']]);  ?>
                      </div>
                    </div>
                    <div class="col-md-12" style="margin-top: 10px;">
                        <label>Service Text 2</label>
                    </div>
                    <div class="row">
                      <div class="col-md-12" style="margin-top: 10px;">
                        <?= form_textarea(['name'=>'service_text_2','class'=>'form-control','rows'=>'4','placeholder'=>'Service Text 2','value'=>$get_landing_page_data['service_text_2']]);  ?>
                      </div>
                    </div>



                    <div class="col-md-12" style="margin-top: 10px;">
                        <label>Service Title 3</label>
                    </div>
                    <div class="row">
                      <div class="col-md-12" style="margin-top: 10px;">
                        <?= form_input(['name'=>'service_title_3','class'=>'form-control','rows'=>'4','placeholder'=>'Service Title 3','value'=>$get_landing_page_data['service_title_3']]);  ?>
                      </div>
                    </div>
                    <div class="col-md-12" style="margin-top: 10px;">
                        <label>Service Text 3</label>
                    </div>
                    <div class="row">
                      <div class="col-md-12" style="margin-top: 10px;">
                        <?= form_textarea(['name'=>'service_text_3','class'=>'form-control','rows'=>'4','placeholder'=>'Service Text 3','value'=>$get_landing_page_data['service_text_3']]);  ?>
                      </div>
                    </div>


                    <div class="col-md-12" style="margin-top: 10px;">
                        <label>Service Title 4</label>
                    </div>
                    <div class="row">
                      <div class="col-md-12" style="margin-top: 10px;">
                        <?= form_input(['name'=>'service_title_4','class'=>'form-control','rows'=>'4','placeholder'=>'Service Title 4','value'=>$get_landing_page_data['service_title_4']]);  ?>
                      </div>
                    </div>

                    <div class="col-md-12" style="margin-top: 10px;">
                        <label>Service Text 4</label>
                    </div>
                    <div class="row">
                      <div class="col-md-12" style="margin-top: 10px;">
                        <?= form_textarea(['name'=>'service_text_4','class'=>'form-control','rows'=>'4','placeholder'=>'Service Text 4','value'=>$get_landing_page_data['service_text_4']]);  ?>
                      </div>
                    </div>


                    <div class="col-md-12" style="margin-top: 10px;">
                        <label>Service Title 5</label>
                    </div>
                    <div class="row">
                      <div class="col-md-12" style="margin-top: 10px;">
                        <?= form_input(['name'=>'service_title_5','class'=>'form-control','rows'=>'4','placeholder'=>'Service Title 5','value'=>$get_landing_page_data['service_title_5']]);  ?>
                      </div>
                    </div>

                    <div class="col-md-12" style="margin-top: 10px;">
                        <label>Service Text 5</label>
                    </div>
                    <div class="row">
                      <div class="col-md-12" style="margin-top: 10px;">
                        <?= form_textarea(['name'=>'service_text_5','class'=>'form-control','rows'=>'4','placeholder'=>'Service Text 5','value'=>$get_landing_page_data['service_text_5']]);  ?>
                      </div>
                    </div>

                  </div>
                        <?= form_submit(['value'=>'Update Landing Page','class'=>'btn btn-success btn-lg']); ?>
              <?php echo form_close(); ?>
            </div>
              </div>
            </div>
          </div>
</div>
        </div>


      </div>

    </div>