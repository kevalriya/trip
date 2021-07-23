<!DOCTYPE html>
<html lang="en">
<head>
	<?php echo $__env->make('front.layouts.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body >
<div class="global-wrap">
	<?php echo $__env->make('front.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	
	<?php $__env->startSection('main-content'); ?>
		<?php echo $__env->yieldSection(); ?>
	<?php echo $__env->make('front.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<?php $__env->startSection('footerSection'); ?>
    <?php echo $__env->yieldSection(); ?>
</div>
</body>
</html><?php /**PATH /Applications/MAMP/htdocs/trip/resources/views/front/layouts/app.blade.php ENDPATH**/ ?>