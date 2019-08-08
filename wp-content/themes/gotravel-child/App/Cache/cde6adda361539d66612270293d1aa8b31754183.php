
<?php if(count($notes) > 0): ?>

  <div class="card-header">
    <p> <b>Please note:</b> </p>
    <ul class="list-group list-style px-3">
    <?php $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
      <li class="p-2"><?php echo $note; ?></li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
    </ul>
  </div>
</div>
<?php endif; ?>
