<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/dashboard.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="tab-wrapper">

<!--おすすめとマイリストの変更ボタン-->
<div class="tabs">
<a href="<?php echo e(route('dashboard')); ?>"
   class="tab <?php echo e(request('tab', 'recommend') === 'recommend' ? 'active' : ''); ?>">
   おすすめ
</a>

<a href="<?php echo e(route('like')); ?>"
   class="tab <?php echo e(request()->routeIs('like') ? 'active' : ''); ?>">
   マイリスト
</a>
</div>


    <div class="tab-underline"></div>

<div id="tab1" class="tab-content active">
<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="item">

        <?php if($item->is_sold): ?>
          
            <div class="sold-link">
                <div class="image-wrapper">
                    <img src="<?php echo e(asset('storage/' . $item->image_path)); ?>" alt="<?php echo e($item->name); ?>">
                    <span class="soldout">Sold</span>
                </div>
                <p class="item-text"><?php echo e($item->name); ?></p>
            </div>
        <?php else: ?>

            <a href="<?php echo e(route('item.detail', ['item_id' => $item->id])); ?>">
                <div class="image-wrapper">
                    <img src="<?php echo e(asset('storage/' . $item->image_path)); ?>" alt="<?php echo e($item->name); ?>">
                </div>
                <p class="item-text"><?php echo e($item->name); ?></p>
            </a>
        <?php endif; ?>

    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.common2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/site/dashboard.blade.php ENDPATH**/ ?>