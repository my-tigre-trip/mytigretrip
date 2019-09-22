<?php wp_nonce_field('mkdf_tours_booking_form', 'mkdf_tours_booking_form'); ?>
<input type="hidden" name="back" value="<?php echo $current_url;?>"/>

<input type="hidden" name="tourSlug" value="<?php echo e(basename(get_permalink())); ?>"/>
<input type="hidden" name="_token" value="<?php session_start(); echo session_id(); ?>" />

<?php echo $__env->make('calculator.snippets.people', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php if($currentTour->isWaterSport()): ?>
<br>
<div class="" >
<label for="special-activity">People <?php echo $currentTour->waterSport == 'Ski'?'Waterskiing':'Flyboarding'; ?></label>
  <select name="specialActivityPeople" id="special-activity" required class="form-control">
    <option value="1" <?php echo $specialActivityPeople == 1? 'selected':'';?> >1</option>
    <option value="2" <?php echo $specialActivityPeople == 2? 'selected':'';?> >2</option>
    <option value="3" <?php echo $specialActivityPeople == 3? 'selected':'';?> >3</option>
    <option value="4" <?php echo $specialActivityPeople == 4? 'selected':'';?> >4</option>
    <option value="5" <?php echo $specialActivityPeople == 5? 'selected':'';?> >5</option>
  </select>
</div>
<?php endif; ?>
<?php echo $__env->make('calculator.snippets.additional-considerations', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php if(isset($_GET['date'])): ?>
<input type="hidden" name="date" value="<?php echo e($_GET['date']); ?>" >
<?php endif; ?>

<?php if(isset($_GET['d'])): ?>
<input type="hidden" name="d" value="<?php echo e($_GET['d']); ?>" >
<?php endif; ?>

<?php if(isset($_GET['mood1'])): ?>
<input type="hidden" name="mood1" value="<?php echo e($_GET['mood1']); ?>" >
<?php endif; ?>

<?php if(isset($_GET['mood2'])): ?>
<input type="hidden" name="mood2" value="<?php echo e($_GET['mood2']); ?>" >
<?php endif; ?>

<?php if(isset($_GET['car'])): ?>
<input type="hidden" name="car" value="<?php echo e($_GET['car']); ?>" >
<?php endif; ?>

<?php if(isset($_GET['payOnIsland'])): ?>
<input type="hidden" name="payOnIsland" value="<?php echo e($_GET['payOnIsland']); ?>" >
<?php endif; ?>

<?php if(isset($_GET['duration'])): ?>
<input type="hidden" name="duration" value="<?php echo e($_GET['duration']); ?>" >
<?php endif; ?>