	<div class="mkdf-tour-booking-form-holder mkdf-boxed-widget">

	<h5 class="mkdf-tour-booking-title">Plan your Tigre Trip with us today!</h5>
  <div id="mtt-validator-messages">
  <?php if($valid !== true): ?>

  <?php elseif($valid === true): ?>
  </div>

	<form id="mkdf-tour-booking-form" method="post" action="" class="mtt-form">
  
    <?php if(basename(get_permalink()) !== 'yacht-a-dramatic-entrance'): ?>    
      <?php echo $__env->make('calculator.snippets.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php echo $__env->make('calculator.snippets.prices', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php echo $__env->make('calculator.snippets.buttons', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php else: ?>
      <p>Are you part of a group of 6 to 28 people?</p>
      <p>Then find out more about our Private Yacht Experiences!</p>
      <?php echo $__env->make('calculator.snippets.contact-us', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
  </form>
   <?php endif; ?>	
</div>
