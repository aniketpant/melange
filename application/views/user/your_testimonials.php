<?php include 'application/views/inc/header.php'; ?>

<section>
  
  <div class="page-header"><h1>Your Testimonials <small>Manage all of them here</small></h1></div>
  
  <p class="alert alert-info">
    You have a total of <strong><span id="humanized-testimonial-no"></span></strong> testimonials.
  </p>
  
  <div id="public">
    <h3>Your public testimonials</h2>
    <?php if (empty($testimonials['public'])) { ?>
    <p>No testimonials found.</p>
    <?php
  }
  else { ?>
  <ul class="testimonial-list">
    <?php foreach ($testimonials['public'] as $testimonial) {?>
    <li class="well well-small">
      <p><?php echo $testimonial->content; ?></p>
      <p class="written-by">&ndash;&nbsp;<?php echo anchor('user/profile/'.$testimonial->testimonial_by, $testimonial->name); ?></p>
      <div class="btn-group">
        <?php echo anchor('testimonials/make_public/'.$testimonial->idtestimonials, '<i class="icon-eye-open icon-large"></i>', array('class' => 'btn disabled')); ?>
        <?php echo anchor('testimonials/make_private/'.$testimonial->idtestimonials, '<i class="icon-eye-close icon-large"></i>', array('class' => 'btn')); ?>
        <?php echo anchor('testimonials/delete_testimonial/'.$testimonial->idtestimonials, '<i class="icon-trash icon-large"></i>', array('class' => 'btn')); ?>
      </div>
    </li>
    <?php } ?>
  </ul>
  <?php } ?>
</div>

<div id="private">
  <h3>Your private testimonials</h2>
  <?php if (empty($testimonials['private'])) { ?>
  <p>No testimonials found.</p>
  <?php
}
else { ?>
<ul class="testimonial-list">
  <?php foreach ($testimonials['private'] as $testimonial) {?>
  <li class="well">
    <p><?php echo $testimonial->content; ?></p>
    <p class="written-by">&ndash;&nbsp;<?php echo anchor('user/profile/'.$testimonial->testimonial_by, $testimonial->name); ?></p>
    <div class="btn-group">
      <?php echo anchor('testimonials/make_public/'.$testimonial->idtestimonials, '<i class="icon-eye-open icon-large"></i>', array('class' => 'btn')); ?>
      <?php echo anchor('testimonials/make_private/'.$testimonial->idtestimonials, '<i class="icon-eye-close icon-large"></i>', array('class' => 'btn disabled')); ?>
      <?php echo anchor('testimonials/delete_testimonial/'.$testimonial->idtestimonials, '<i class="icon-trash icon-large"></i>', array('class' => 'btn')); ?>
    </div>
  </li>
  <?php } ?>
</ul>
<?php } ?>
</div>

<script type="text/javascript">
$('#humanized-testimonial-no').html(Humanize.apnumber(<?php echo count($testimonials['public']) + count($testimonials['private']) ?>));
</script>

</section>

<?php include 'application/views/inc/footer.php'; ?>