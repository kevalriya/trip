<!DOCTYPE html>
<html lang="en">
<head>
	<?php echo $__env->make('operator.layouts.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">
	<?php echo $__env->make('operator.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php echo $__env->make('operator.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php $__env->startSection('main-content'); ?>
		<?php echo $__env->yieldSection(); ?>
	<?php echo $__env->make('operator.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
</body>
</html><?php /**PATH /Applications/MAMP/htdocs/trip/resources/views/operator/layouts/app.blade.php ENDPATH**/ ?>