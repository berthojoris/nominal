<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<?php echo e($user->id); ?> <br>
	<?php echo e($user->nama); ?> <br>
	<?php echo e($user->username); ?> <br>
	<?php echo e($user->email); ?>

	<hr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH D:\laragon\www\nominal\application\views/api.blade.php ENDPATH**/ ?>