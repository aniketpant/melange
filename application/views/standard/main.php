<?php include 'application/views/inc/header.php'; ?>

                <section>
                    
                    <div class="page-header"><h1><?php echo $this->session->userdata('site_name'); ?></h1></div>
                    
                    <p>This is the testimonial server for <strong><?php echo $this->session->userdata('site_name'); ?></strong></p>
                    <p>Please create a profile to start using the application.</p>
                    
                </section>

<?php include 'application/views/inc/footer.php'; ?>