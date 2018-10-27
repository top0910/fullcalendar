
<div class="col-xlg-10 col-lg-9 col-md-8">
  <div class="card-body">


    <a type="button" class="btn btn-secondary m-r-10 m-b-10" href="<?= base_url('user/email_mgmt');?>"><i class="mdi mdi-reload font-18"></i>
    </a>
  </div>
  <div class="card-body p-t-0">
    <div class="card b-all shadow-none">
      <div class="inbox-center table-responsive">
        <table class="table table-hover" id="table_pagination"  width="100%">
          <thead>
            <td class="col-md-3">From</td>
            <td class="col-md-3">Subject</td>
            <td class="col-md-3">Date</td>
            <td class="col-md-3">Archive</td>
          </thead>
          <tbody>

            <?php foreach ($emails as $email) : ?>
              <?php $i = 0; ?>
              <tr class="read">

                <td class="hidden-xs-down"  width="20%">
                  <a href="<?= base_url('')?>user/get_email?id=<?= $email['id'] ?>"><?= $email['email_from']; ?></a>
                </td>
                <td class="max-texts"  width="30%">
                  <a href="<?= base_url('')?>user/get_email?id=<?= $email['id'] ?>">
                    <?php $subject = substr($email['email_subject'], 0, 40); ?>
                    <?= $subject; ?></a>
                  </td>
                  <!-- <td class="hidden-xs-down"><i class="fa fa-paperclip"></i></td> -->
                  <td class="text-right" width="10%">
                    <a href="<?= base_url('')?>user/get_email?id=<?= $email['id'] ?>">
                      <?php if(isset($email['email_date'])){ $timestamp =  $email['email_date']; echo gmdate("d-m-Y h:i:s A", $timestamp); }?>
                    </a>
                  </td>
                  <td width="10%">

                    <a  class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tooltip on top" href="<?= base_url('user/set_archive?id='.$email['id']) ?>" onclick="if(confirm('Are your sure want to archive this email !'));else{ return false}"><i class="mdi mdi-inbox-arrow-down" style="color: white;"></i></a>
                  </td> 
                </tr>
              <?php endforeach; ?>
              <?= form_close(); ?>
            </tbody>

          </table>


        </div>

      </div>

    </div>
  </div>
</div>
</div>
</div>
</div>
</div>
<script>
  $(document).ready(function(){
    $('#table_pagination').DataTable({
      columns: [
      { width: '20%' },
      { width: '60%' },
      { width: '10%' },
      { width: '10%' }
      ]
    });
  });
</script>

<!-- <script type="text/javascript">
$(document).ready(function() {
$("#myButton").click(function() {
$("#myForm").submit();
});
});
</script> -->