<?php include 'application/views/inc/header.php'; ?>

                <section>

                    <div class="page-header"><h1><i class="icon-cog"></i>&nbsp;Register</h1></div>
                    
                    <?php    
                        echo form_open('main/register', array('class' => 'form-horizontal'));
                    ?>
                    <div class="control-group">
                        <?php
                            $arr_user_name = array(
                                'name'          => 'user_name',
                                'id'            => 'user_name',
                                'class'         => 'span2',
                                'placeholder'   => 'Username',
                                'value'         => set_value('user_name')
                            );
                        ?>
                        <div class="controls">
                            <div class="input-append input-prepend">
                                <span class="add-on"><i class="icon-user icon-large"></i></span>
                            <?php
                                echo form_input($arr_user_name);
                            ?>
                                <span class="add-on">@bits-goa.ac.in</span>
                                <span class="help-block"><em>e.g f20xxxx, h20xxxxx</em></span>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <?php
                            $arr_password = array(
                                'name'          => 'password',
                                'id'            => 'password',
                                'class'         => 'span2',
                                'placeholder'   => 'Password',
                                'value'         => set_value('password')
                            );
                        ?>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-key icon-large"></i></span>
                            <?php        
                                echo form_password($arr_password);
                            ?>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <?php
                            $arr_passconf = array(
                                'name'          => 'passconf',
                                'id'            => 'passconf',
                                'class'         => 'span2',
                                'placeholder'   => 'Confirm Password',
                                'value'         => set_value('passconf')
                            );
                        ?>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-key icon-large"></i></span>
                            <?php        
                                echo form_password($arr_passconf);
                            ?>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <?php
                            $arr_button = array(
                                'name'  => 'submit',
                                'value' => 'Register',
                                'class' => 'btn btn-primary'
                            );
                        ?>
                        <div class="controls">
                        <?php
                            echo form_submit($arr_button);
                        ?>
                        </div>
                    </div>
                    <?php
                        echo form_close();
                        if ( $error != NULL )
                            echo '<div class="alert alert-error">'. $error.' </div>';
                        echo validation_errors();
                    ?>
                </section>

<?php include 'application/views/inc/footer.php'; ?>