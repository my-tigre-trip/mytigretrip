<?php if($tour->hasOptional()): ?>
<div class="mtt-optional">
  <input class="update-calculator" id="<?php echo e($tour->product['optionId']); ?>" name="optional" value="yes" type="checkbox"  >
  
  <label for="<?php echo e($tour->product['optionId']); ?>" ><?php echo e($tour->product['optionLabel_en']); ?></label>
</div>
<?php endif; ?>
