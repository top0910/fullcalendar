
                                <div class="col-xlg-10 col-lg-9 col-md-10">
                                    <div class="card-body">
                                        <div class="btn-group m-b-10 m-r-10" role="group" aria-label="Button group with nested dropdown">
                                            <a type="button" class="btn btn-secondary font-18"><i class="mdi mdi-inbox-arrow-down"></i></a>
                                        </div>

                                        <a type="button" class="btn btn-secondary m-r-10 m-b-10" href="<?= base_url('user/email_mgmt');?>"><i class="mdi mdi-reload font-18"></i>
                                        </a>
                                    </div>
                                    <div class="card-body p-t-0">
                                        <div class="card b-all shadow-none">
                                            <div class="card-body">
                                                <?php //echo FCPATH; ?>
                                                <h3 class="card-title m-b-0"><?= $email_data['email_subject'];?></h3>
                                            </div>
                                            <div>
                                                <hr class="m-t-0">
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex m-b-40">
                                                    <div class="p-l-10">
                                                        <h4 class="m-b-0">From: <?= $email_data['email_from'];?></h4>
                                                    </div>
                                                </div>
                                                <?= $email_data['email_content']; ?>        
                                            </div>
                                            <div>
                                                <hr class="m-t-0">
                                            </div>
                                            <div class="card-body">
                                                <h4><i class="fa fa-paperclip m-r-10 m-b-10"></i> Attachments <span></span></h4>
                                                <div class="row">
                                                    <?php foreach ($email_files as $email_file) :?>
                                                        <div class="col-md-2">
                                                        <?php  
                                                            $file = str_replace("/home/nsekeqoz/public_html/","/",$email_file['email_file_name'])
                                                        ?>
                                                        <a href="<?php print_r($file); ?>" class="btn btn-primary">Download File</a>
                                                        </div>
                                                    <?php endforeach; ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
 
        </div>