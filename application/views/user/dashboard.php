<?php include 'application/views/inc/header.php'; ?>
    
                <section>
                    
                    <div class="page-header"><h1><i class="icon-home"></i>&nbsp;Dashboard <small>Welcome, <?php echo ($user_details->name)?$user_details->name:$this->session->userdata('user_name'); ?></small></h1></div>
                    
                    <?php
                    echo form_open('user/search', array('class' => 'well form-search'));
                    ?>
                    <div class="input-append">
                    <?php
                    $arr_search = array(
                        'name'          => 'searchQuery',
                        'id'            => 'searchQuery',
                        'class'         => 'input-medium',
                        'placeholder'   => 'Looking for someone'
                    );
                    echo form_input($arr_search);
                    $arr_button = array(
                        'name'      => 'search',
                        'type'      => 'submit',
                        'class'     => 'btn',
                        'content'   => '<i class="icon-search icon-large"></i>'
                    );
                    echo form_button($arr_button);
                    ?>
                        <p class="help-inline"><em>You can search by id number, nick or name</em></p>
                    </div>
                    <?php
                    echo form_close();
                    ?>
                    
                    <?php if (!$guest_account_flag): ?>
                    <div class="well well-large">
                        <h2><i class="icon-download"></i>&nbsp;Download Your Testimonials</h2>
                        <?php echo anchor('user/export', '<i class="icon-download-alt"></i>&nbsp;Download', array('class' => 'btn btn-success', 'target' => '_blank')) ?>
                    </div>
                    
                    <div id="testimonial-approval">
                        <h2>Testimonials for approval</h2>
                        <?php if (empty($testimonials)) { ?>
                        <p>No testimonials waiting to be approved by you.</p>
                        <?php
                        }
                        else { ?>
                        <ul class="testimonial-list">
                            <?php foreach ($testimonials as $testimonial) {?>
                            <li class="well well-small">
                                <p>
                                    <?php echo $testimonial->content; ?> <em>by <?php echo anchor('user/profile/'.$testimonial->testimonial_by, $testimonial->name); ?></em>
                                </p>
                                <div class="btn-group">
                                <?php echo anchor('testimonials/make_public/'.$testimonial->idtestimonials, '<i class="icon-eye-open icon-large"></i>', array('class' => 'btn')); ?>
                                <?php echo anchor('testimonials/make_private/'.$testimonial->idtestimonials, '<i class="icon-eye-close icon-large"></i>', array('class' => 'btn')); ?>
                                <?php echo anchor('testimonials/delete_testimonial/'.$testimonial->idtestimonials, '<i class="icon-trash icon-large"></i>', array('class' => 'btn')); ?>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                        <?php } ?>
                    </div>
                    
                    <div class="hero-unit">
                        <div>
                            <h2>Profile Completeness</h2>
                            <?php
                            $flag = 0;
                            if (!is_null($user_details->id_number))
                                $flag++;
                            if (!is_null($user_details->name))
                                $flag++;
                            if (!is_null($user_details->nick))
                                $flag++;
                            if (!is_null($user_details->dob))
                                $flag++;
                            if (!is_null($user_details->hostel))
                                $flag++;
                            if (!is_null($user_details->roomno))
                                $flag++;
                            if (!is_null($user_details->address))
                                $flag++;
                            if (!is_null($user_details->contact))
                                $flag++;
                            if (!is_null($user_details->email))
                                $flag++;
                            if (!is_null($user_details->image_name))
                                $flag++;
                            ?>
                            <div class="progress progress-striped <?php if ($flag < 5) echo 'progress-warning'; else if ($flag < 10) echo 'progress-info'; else echo 'progress-success'; ?> active">
                                <div class="bar" style="width: <?php echo ($flag*10).'%;'; ?>;"></div>
                            </div>
                        </div>
                        <div>
                            <ul>
                                <li class="<?php if (!is_null($user_details->id_number)) echo 'icon-ok'; else echo 'icon-remove' ?>">ID Number</li>
                                <li class="<?php if (!is_null($user_details->name)) echo 'icon-ok'; else echo 'icon-remove' ?>">Name</li>
                                <li class="<?php if (!is_null($user_details->nick)) echo 'icon-ok'; else echo 'icon-remove' ?>">Nick</li>
                                <li class="<?php if (!is_null($user_details->dob)) echo 'icon-ok'; else echo 'icon-remove' ?>">Date of Birth</li>
                                <li class="<?php if (!is_null($user_details->hostel)) echo 'icon-ok'; else echo 'icon-remove' ?>">Hostel</li>
                                <li class="<?php if (!is_null($user_details->roomno)) echo 'icon-ok'; else echo 'icon-remove' ?>">Room Number</li>
                                <li class="<?php if (!is_null($user_details->address)) echo 'icon-ok'; else echo 'icon-remove' ?>">Address</li>
                                <li class="<?php if (!is_null($user_details->contact)) echo 'icon-ok'; else echo 'icon-remove' ?>">Contact</li>
                                <li class="<?php if (!is_null($user_details->email)) echo 'icon-ok'; else echo 'icon-remove' ?>">Email</li>
                                <li class="<?php if (!is_null($user_details->image_name)) echo 'icon-ok'; else echo 'icon-remove' ?>">Profile Image</li>
                            </ul>
                        </div>
                    </div>

                    <script type="text/javascript">
                        $(document).ready(function() {
                            $('#testimonials').load('<?php echo site_url().'testimonials/testimonial_approval/'.$user_details->iduser_details; ?>');
                        });
                    </script>
                    
                    <?php endif; ?>
                    
                </section>

<?php include 'application/views/inc/footer.php'; ?>