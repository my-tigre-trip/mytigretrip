<div class="mtt-trip-details">
  <h4>Trip details</h4>
  <ul>
    <li>Date: <?php echo e($date); ?></li>
    <li>Duration : <?php echo e($boatDetail['boat']); ?></li>
    <?php if($tourDetail['mood1'] != ''): ?>
    <li>I´m in the Mood for <?php echo e($tourDetail['mood1']); ?></li>
    <?php endif; ?>
    <?php if($tourDetail['mood2'] != ''): ?>
    <li>I´m also in the Mood for <?php echo e($tourDetail['mood2']); ?></li>
    <?php endif; ?>
  </ul>
</div>
<table class="mtt-price">
   <tr>
   <td class="mtt-price-value"><?php echo e($price['priceAdults']); ?></td>
   <td><?php echo e($boatDetail['adults']); ?> Adults</td>
   </tr>
   <?php if($boatDetail['children'] > 0): ?>
   <tr>
   <td class="mtt-price-value"><?php echo e($price['priceChildren']); ?></td>
   <td><?php echo e($boatDetail['children']); ?> Children</td>
   </tr>
   <?php endif; ?>
   <?php if($tourDetail['specialActivityPeople'] > 0): ?>
     <?php 
       $count = $tourDetail['specialActivityPeople'] > 1? 'Classes':'Class';
      ?>
   <tr>
   <td class="mtt-price-value"><?php echo e($tourDetail['specialActivityPrice']); ?></td>
   <td><?php echo e($tourDetail['specialActivityPeople']); ?> <?php echo e($tourDetail['specialActivity']); ?> <?php echo e($count); ?></td>
   </tr>
   <?php endif; ?>

   <?php if($boatDetail['groupDiscount'] > 0): ?>
   <tr class="mtt-group-discount">
   <td class="mtt-price-value">-<?php echo e($boatDetail['groupDiscount']); ?></td>
   <td>Group Discount</td>
   </tr>
   <?php endif; ?>

   <tr class="mtt-total-price">
   <td class="mtt-price-value"><?php echo e($finalPrice); ?></td>
   <td>Final Price</td>
   </tr>

</table>

<div class=" p-0 my-3">
  <?php echo $__env->make('calculator.price-result-notes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
