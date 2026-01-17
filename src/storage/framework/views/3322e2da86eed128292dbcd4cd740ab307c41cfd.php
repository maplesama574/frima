<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/dashboard.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="tab-wrapper">

<div class="tabs">
    <a href="<?php echo e(route('dashboard', request()->query())); ?>"
       class="tab <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
        おすすめ
    </a>

    <a href="<?php echo e(route('like', request()->query())); ?>"
       class="tab <?php echo e(request()->routeIs('like') ? 'active' : ''); ?>">
        マイリスト
    </a>
</div>




    <div class="tab-underline"></div>

    <div class="tab-content">
<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="item">
        <a href="<?php echo e(route('item.detail', ['item_id' => $item->id])); ?>">
            <img src="<?php echo e(asset('storage/' . $item->image_path)); ?>">
            <p class="item-text"><?php echo e($item->name); ?></p>
        </a>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.common2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/site/like.blade.php ENDPATH**/ ?>