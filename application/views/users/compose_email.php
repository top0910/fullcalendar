
                                <div class="col-xlg-10 col-lg-9 col-md-10">
                                    <div class="card-body">

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

            <?= form_open_multipart('user/quickemail'); ?>                    
                <h3 class="card-title">Compose New Message</h3>
                <div class="form-group">
                    <input class="form-control" name="emailto"  placeholder="To:">
                </div>


                <div class="form-group">
                  <select class="select2 m-b-10 select2-multiple" style="width: 100%" multiple="multiple" data-placeholder="Select Multiple Users" name="to_users[]" >
                      <optgroup label="">
                          <?php foreach ($all_users as $user): ?>
                            <option value="<?= $user['user_email']?>"># <?= $user['building_unit']?> : <?= $user['user_email']?></option>
                          <?php endforeach ?>
                      </optgroup>
                  </select>
                </div>

                <div class="form-group">
                  <select class="form-control form-horizontal form-bordered" name="email_list">
                    <option value="">Select list</option>
                    <option value="1234" >All [Admins + PM + Users + Tenants]</option>
                    <option value="1" >All Admins</option>
                    <option value="2" >All Users</option>
                    <option value="3" >All Tenants</option>
                    <option value="4" >All Property Managers</option>
                  </select>
                </div>
                <div class="form-group">
                    <input class="form-control" name="subject" placeholder="Subject:" >
                </div>
                <div class="form-group">
                    <textarea class="textarea form-control" rows="15" placeholder="Enter text ..."  name="message"></textarea>
                </div>
                <h4><i class="ti-link"></i> Attachment</h4>
                    <div class="fallback">
                        <input name="doc_file" type="file" multiple />
                    </div>
                <button type="submit" class="btn btn-success m-t-20"><i class="fa fa-envelope-o"></i> Send</button>
               
                <button class="btn btn-inverse m-t-20"><i class="fa fa-times"></i> Discard</button>
            <?= form_close(); ?>    
                                    </div>
                                </div>
                                </div>
                                </div>
                                </div>

<!-- ******************TinyMCE STARTS****************** -->
<script>tinymce.init({ selector:'textarea',
  height: 250,
  theme: 'modern',

  plugins: [
  'advlist autolink autosave lists charmap print preview hr pagebreak',
  'searchreplace wordcount visualblocks visualchars code fullscreen',
  'insertdatetime nonbreaking save table contextmenu directionality',
  'emoticons paste textcolor colorpicker textpattern '
  ],
  toolbar1: ' styleselect | bold italic underline | forecolor backcolor media | ',
  fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt 72pt',
  image_advtab: true,
  content_css: [
  'http://fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
  'http://www.tinymce.com/css/codepen.min.css'
  ]
});</script>
<!-- ******************TinyMCE ENDS****************** -->
