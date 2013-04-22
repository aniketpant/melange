<?php include 'application/views/inc/header.php'; ?>

                <section>

                    <div class="page-header"><h1><i class="icon-signin"></i>&nbsp;Login to access your profile</h1></div>

                    <?php echo form_open('main/login', array('class' => 'form-horizontal')); ?>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-append input-prepend">
                                <span class="add-on"><i class="icon-user icon-large"></i></span>
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
                            <span class="help-block"><em>e.g f20xxxx, h20xxxxx</em></span>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-key icon-large"></i></span>
                                <?php
                                    $arr_password = array(
                                        'name'          => 'password',
                                        'id'            => 'password',
                                        'class'         => 'span2',
                                        'placeholder'   => 'Password',
                                        'value'         => set_value('password')
                                    );
                                    echo form_password($arr_password);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <?php
                            $arr_button = array(
                                'name'  => 'submit',
                                'value' => 'Login',
                                'class' => 'btn btn-primary'
                            );
                        ?>
                        <div class="controls">
                        <?php
                            echo form_submit($arr_button);
                        ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <?php
                                echo anchor('/main/forgot_password', 'Forgot Password', array('title' => 'Forgot Passoword', 'class' => 'btn'));
                            ?>
                        </div>
                    </div>
                    <div class="alert alert-info">
                        <p>To login as a guest, use <strong>guest/password</strong>.</p>
                    </div>
                    <?php
                        echo form_close();

                        if ($error != "") {
                    ?>
                    <div class="alert alert-error">
                            <p><?php echo $error; ?></p>
                    </div>
                    <?php
                        }
                        echo validation_errors();
                    ?>

                </section>

<?php include 'application/views/inc/footer.php'; ?>