<?php if(count($errors) > 0): ?>
<div class="alert alert-danger" >
  <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <p ><?php echo e($error); ?></p>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?>

<?php if(session()->has('message')): ?>
	<p class="alert alert-success"><?php echo e(session('message')); ?></p>
<?php endif; ?><?php /**PATH /Applications/MAMP/htdocs/trip/resources/views/includes/messages.blade.php ENDPATH**/ ?>