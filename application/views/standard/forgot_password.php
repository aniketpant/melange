<?php include 'application/views/inc/header.php'; ?>

                <section>
                    
                    <div class="page-header"><h1>Forgot Your Password <small>Reset it here</small></h1></div>
                    
                    <div>
                        <?php echo form_open('main/forgot_password', array('class' => 'form-horizontal')); ?>
                        <div class="control-group">
                            <div class="controls">
                                <div class="input-append">
                                    <?php
                                        $arr_user_name = array(
                                            'name'          => 'user_name',
                                            'id'            => 'user_name',
                                            'class'         => 'span2',
                                            'placeholder'   => 'Username',
                                            'value'         => set_value('user_name')
                                        );
                                        echo form_input($arr_user_name);
                                    ?>
                                    <span class="add-on">@bits-goa.ac.in</span>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <?php
                                $arr_button = array(
                                    'name'  => 'submit',
                                    'value' => 'Submit',
                                    'class' => 'btn btn-primary'
                                );
                            ?>
                            <div class="controls">
                            <?php echo form_submit($arr_button); ?>
                            </div>
                        </div>
                        <?php
                            echo form_close();
                            if ($error != "") {
                        ?>
                        <div class="alert alert-error">
                            <p><?php echo $error; ?></p>
                        </div>
                        <?php } ?>
                    </div>
                    
                </section>

<?php include 'application/views/inc/footer.php'; ?>