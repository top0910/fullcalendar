
                                <div class="col-xlg-10 col-lg-9 col-md-8">
                                    <div class="card-body">


                                        <a type="button" class="btn btn-secondary m-r-10 m-b-10" href="<?= base_url('user/email_mgmt');?>"><i class="mdi mdi-reload font-18"></i>
                                        </a>
                                    </div>
                                    <div class="card-body p-t-0">
                                        <div class="card b-all shadow-none">
                                            <div class="inbox-center table-responsive">
                                                <table class="table table-hover no-wrap" id="table_pagination">
                                                  <thead>
                                                      <td>From</td>
                                                      <td>Subject</td>
                                                      <td>Date</td>
                                                      <td>Archive</td>
                                                  </thead>
                                                    <tbody>
                                                      
                                                    <?php foreach ($sent_emails as $email) : ?>
                                                        <?php $i = 0; ?>
                                                        <tr class="read">
                                                            
                                                            <td class="hidden-xs-down">
                                                                <a href="<?= base_url('')?>user/get_email?id=<?= $email['id'] ?>"><?= $email['email_from']; ?></a>
                                                            </td>
                                                            <td class="max-texts">
<a href="<?= base_url('')?>user/get_email?id=<?= $email['id'] ?>">
<?php $subject = substr($email['email_subject'], 0, 40); ?>
    <?= $subject; ?></a>
                                                            </td>
                                                            <!-- <td class="hidden-xs-down"><i class="fa fa-paperclip"></i></td> -->
                                                            <td class="text-right">
                                                                <a href="<?= base_url('')?>user/get_email?id=<?= $email['id'] ?>">
                                                                    <?php if(isset($email['created_at'])){ $timestamp =  $email['email_date']; echo gmdate("d-m-Y h:i:s A", $timestamp); }?>
                                                                    </a>
                                                            </td>
<!--                 <td> 
                    <a class="btn btn-warning btn-sm" href="<?= base_url('user/delete_sent_email?id='.$email['id']) ?>" onclick="if(confirm('Are your sure want to archive this email !'));else{ return false}"><i class="mdi mdi-delete"></i></a>
                </td>  -->

                <td> 
                    <a class="btn btn-warning btn-sm" href="<?= base_url('user/set_archive?sent=1&id='.$email['id']) ?>" onclick="if(confirm('Are your sure want to archive this email !'));else{ return false}"><i class="mdi mdi-inbox-arrow-down" style="color: white;"></i></a>
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