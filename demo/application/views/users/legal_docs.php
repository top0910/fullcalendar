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
              <h4 class="card-title">ByLaws / Forms</h4>
              <div class="table-responsive m-t-40">
                <table id="table_id" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                <th width="70%">File name</th>
                <th>Created Date</th>
                <th>Download Links</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                <th width="70%">File name</th>
                <th>Created Date</th>
                <th>Download Links</th>
                    </tr>
                  </tfoot>
            <tbody>
              <?php if(isset($files_data)): ?>
                <?php foreach($files_data as $file_data):?>
                  <tr>
                    <td><?php if(isset( $file_data['new_file_name'])){echo $file_data['new_file_name'];} ?></td>
                    <td><?php if(isset( $file_data['created_at'])){echo $file_data['created_at'];} ?></td>
                    <td><?php if(isset( $file_data['file_name']))
                                {
                                  echo "<strong><a   class=\"btn btn-primary btn-sm\" href=\"";
                                  echo $file_data['file_name'];
                                  echo "\">Download File</a></strong>";  
                                } ?></td>
                                  
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
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