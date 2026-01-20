<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/dashboard.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="tab-wrapper">

<!--おすすめとマイリストの変更ボタン-->
    <div class="tabs">
        <button class="tab active" data-target="tab1">おすすめ</button>
        <button class="tab" data-target="tab2">マイリスト</button>
    </div>

    <div class="tab-underline"></div>

<div id="tab1" class="tab-content active">
<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="item">
        <a href="<?php echo e(route('item.detail', ['item_id' => $item->id])); ?>" 
           data-sold="<?php echo e($item->is_sold ? '1' : '0'); ?>">
            <div class="image-wrapper">
                <img src="<?php echo e(asset('storage/' . $item->image_path)); ?>" alt="<?php echo e($item->name); ?>">
                <?php if($item->is_sold): ?>
                    <span class="soldout">Sold</span>
                <?php endif; ?>
            </div>
            <p class="item-text"><?php echo e($item->name); ?></p>
        </a>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>



  <div id="tab2" class="tab-content active">
    <?php $__currentLoopData = $favorites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $favorite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($favorite->item): ?>
            <div class="item">
                <a href="<?php echo e(route('item.detail', ['item_id' => $favorite->item->id])); ?>" 
                   data-sold="<?php echo e($favorite->item->is_sold ? '1' : '0'); ?>">
                    <div class="image-wrapper">
                        <img src="<?php echo e(asset('storage/' . $favorite->item->image_path)); ?>" alt="<?php echo e($favorite->item->name); ?>">
                        <?php if($favorite->item->is_sold): ?>
                            <span class="soldout">Sold </span>
                        <?php endif; ?>
                    </div>
                    <p class="item-text"><?php echo e($favorite->item->name); ?></p>
                </a>
            </div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    // すべてのリンクを取得
    const links = document.querySelectorAll('.item a');

    links.forEach(link => {
        if(link.dataset.sold === "1") {
            // クリックを無効化
            link.addEventListener('click', function(e) {
                e.preventDefault();
            });
            // 見た目も薄くする
            link.style.pointerEvents = "none";
            link.style.cursor = "default";
        }
    });

    // タブ切り替え
    const tabs = document.querySelectorAll(".tab");
    const contents = document.querySelectorAll(".tab-content");

    tabs.forEach(tab => {
        tab.addEventListener("click", () => {
            tabs.forEach(t => t.classList.remove("active"));
            tab.classList.add("active");

            contents.forEach(content => content.classList.remove("active"));
            document.getElementById(tab.dataset.target).classList.add("active");
        });
    });
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.common2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/site/dashboard.blade.php ENDPATH**/ ?>