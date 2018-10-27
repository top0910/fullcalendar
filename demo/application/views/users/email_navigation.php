<style>
.badge{
    float: right;
}   
</style>

    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="row">

                                <div class="col-xlg-2 col-lg-3 col-md-4">
                                    <div class="card-body inbox-panel"><a href="<?= base_url('user/compose_email');?>" class="btn btn-info m-b-20 p-10 btn-block waves-effect waves-light">Compose</a>
                                        <ul class="list-group list-group-full">
                                            <li class="list-group-item <?php if(!empty($active_inbox)){echo $active_inbox;} ?>"> <a href="<?= base_url('user/email_mgmt')?>"><i class="mdi mdi-gmail"></i> Inbox </a><span class="badge badge-success ml-auto"><?= $inbox_count; ?></span></li>
                                           
                                            <li class="list-group-item <?php if(!empty($active_sent)){echo $active_sent;} ?> ">
                                                <a href="<?= base_url('user/send_emails');?>"> <i class="mdi mdi-file-document-box"></i> Sent Mail <span class="badge badge-success ml-auto"><?= $sent_count; ?></span></a>
                                            </li>
                                           
                                            <li class="list-group-item <?php if(!empty($active_arc)){echo $active_arc;} ?>">
                                                <a href="<?= base_url('user/view_archive');?>"> <i class="mdi mdi-inbox-arrow-down"></i> Archive <span class="badge badge-success ml-auto"><?= $archive_count; ?></span> </a>
                                            </li>
                                            <li class="list-group-item <?php if(!empty($active_sent_arc)){echo $active_sent_arc;} ?>">
                                                <a href="<?= base_url('user/view_sent_archive');?>"> <i class="mdi mdi-inbox-arrow-down"></i> Sent Archive <span class="badge badge-success ml-auto"><?= $sent_archive_count; ?></span> </a>
                                            </li>

                                        </ul>

                                    </div>
                                </div>