<div class="page-wrapper">

  <div class="container-fluid">

    <div class="row">


      <div class="col-lg-12">
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

        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Support Tickets</h4>
            <div class="card-body">
              <?= form_open('user/submit_ticket',['role'=>'form']);  ?>

              <div class="form-group">
                <label>Subject</label>
                <?= form_input(['name'=>'subject','class'=>'form-control','required'=>'TRUE','placeholder'=>'Enter Subject']);  ?>
              </div>

              <div class="form-group">
                <label>Ticket</label>
                <textarea name='ticket' class="form-control" rows="4" placeholder="Enter your enquiry. . ." required/></textarea>
              </div>

              <div class="form-group">
                <label>Type of Support</label>
                <select class="form-control" name="type">
                  <option value="Building Issue - Inside">Building Issue - Inside</option>
                  <option value="Building Issue - Outside">Building Issue - Outside</option>
                  <option value="Security">Security</option>
                  <option value="Bylaw">Bylaw</option>
                  <option value="Account Question">Account Question</option>
                  <option value="General Question">General Question</option>
                  <option value="Other">Other</option>
                </select>
              </div>

              <?= form_submit(['class'=>'btn btn-primary','value'=>'Submit']);  ?>      

              <?= form_close();  ?>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-body">           

            <div class="table-responsive m-t-40">
              <table id="table_id" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th width="20%">Subject</th>
                    <th width="12%">Type</th>
                    <th width="60%">Ticket</th>
                    <th width="3%">Status</th>
                    <th width="5%">View Reply</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th width="20%">Subject</th>
                    <th width="12%">Type</th>
                    <th width="60%">Ticket</th>
                    <th width="3%">Status</th>
                    <th width="5%">View Reply</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php foreach ($user_tickets as $value) :?>
                    <tr>
                      <td><?= $value['subject']; ?></td>
                      <td><?= $value['type']; ?></td>
                      <td><?= $value['ticket']; ?></td>
                      <td><?php 
                      if($value['status']==1)
                      {
                        echo "Active";
                      } 
                      elseif($value['status']==0)
                      {  
                        echo "Inactive";
                      } 

                      ?>
                    </td> 
                    <!-- ****************************************** REPLY ******************************************* -->
                    <td>
                      <button type="button" 
                      class="btn btn-info btn-sm" 
                      data-toggle="modal" 
                      data-target="#reply<?= $value['id'] ?>">
                      <i class="mdi mdi-envelope"> </i> VIEW REPLY</button>
                    </td>

                    <div id="reply<?= $value['id'] ?>" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Reply Ticket</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>


                          <div class="modal-body">
                            <?= form_open('user/reply_ticket') ?>
                            <input type="hidden" name="ticket_id" value="<?= $value['id'] ?>" />

                            <div class="form-group">
                              <strong><?= $value['subject']; ?></strong><br/>
                              <?= $value['ticket']; ?>
                            </div>

                            <div class="form-group">
                              <label for="">Subject</label>
                              <?= form_input(['name'=>'reply_message','class'=>'form-control','required'=>'TRUE']); ?>
                            </div>

                            <?php $data = $this->global_model->select_all('ticket_replies',['ticket_id'=>$value['id']],'id','desc') ;
                            foreach ($data as $value1) :?>

                              <?php if($value1['user_role']=='0' OR $value1['user_role']=='1'){
                                $float = 'Admin Reply: ';
                              }
                              elseif ($value1['user_role']=='2' OR $value1['user_role']=='3') {
                                $float = 'Your Reply: ';
                              } ?>

                              <?= $float. $value1['reply_message']."<br/>" ; ?>


                            <?php endforeach; ?>

                            <div class="buttons-box clearfix">
                              <button class="btn btn-success" type="submit">Send </button>              
                            </div>
                            <?= form_close() ?>
                          </div> 
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- ****************************************** REPLY ******************************************* -->


                </tr>
              <?php endforeach; ?>
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