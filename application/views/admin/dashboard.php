<?php include 'application/views/inc/header.php'; ?>

                <section>
                    
                    <div class="page-header"><h1><i class="icon-home"></i>&nbsp;Dashboard <small>Welcome, administrator</small></h1></div>
                    
                    <div class="hero-unit">
                        <h2><i class="icon-download"></i>&nbsp;Export Data</h2>
                        <?php echo anchor('admin/export/userdata', '<i class="icon-download-alt"></i>&nbsp;Export User Data', array('class' => 'btn btn-success', 'target' => '_blank')) ?>
                        <?php echo anchor('admin/export/testimonials', '<i class="icon-download-alt"></i>&nbsp;Export Testimonials', array('class' => 'btn btn-success', 'target' => '_blank')) ?>
                    </div>
                    
                    <div class="hero-unit">
                        <div>
                            <h2>Progress so far</h2>
                            <div class="progress progress-striped progress-success active">
                                <?php
                                $flag = 0;
                                if ($site_name != null) {
                                    $flag++;
                                }
                                if ($year != null) {
                                    $flag++;
                                }
                                ?>
                                <div class="bar" style="width: <?php echo ($flag*50).'%;'; ?>;"></div>
                            </div>
                        </div>
                        <div>
                            <ul>
                                <li class="<?php if ($site_name) echo 'icon-ok'; else echo 'icon-remove' ?>">Site Name</li>
                                <li class="<?php if ($year) echo 'icon-ok'; else echo 'icon-remove' ?>">Year</li>
                            </ul>
                        </div>
                    </div>
                    
                </section>

<?php include 'application/views/inc/footer.php'; ?>