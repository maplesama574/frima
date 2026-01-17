<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/item-detail.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="item-detail">
    <div class="item-detail__img">
        <img src="<?php echo e($item->image_path ? asset('storage/' . $item->image_path) : asset('images/no-image.png')); ?>" alt="<?php echo e($item->name); ?>">
    </div>
    <div class="item-detail__text">
        <div class="purchase-form">
            <h2><?php echo e($item->name); ?></h2>
            <span class="item-brand"><?php echo e($item->brand); ?></span>
            <p class="item-normal">￥<?php echo e(number_format($item->price)); ?>(税込)</p>

            <div class="reaction">
                <div class="reaction-icon">
                    <img
                    src="<?php echo e(in_array($item->id, $likedItemIds) ? asset('images/ハートロゴ_ピンク.png') : asset('images/ハートロゴ_デフォルト.png')); ?>"
                    class="like-icon"
                    data-liked="<?php echo e(in_array($item->id, $likedItemIds) ? 'true' : 'false'); ?>"
                    alt="いいね">
                    <div class="reaction-count">
                        <span><?php echo e($item->favorites_count); ?></span>
                    </div>
                </div>
                <div class="reaction-icon">
                    <img src="<?php echo e(asset('images/ふきだしロゴ.png')); ?>" alt="ふきだし">
                    <div class="reaction-count">
                    <span><?php echo e($item->comments->count()); ?></span>
                    </div>
                </div>
            </div>


            <form method="GET" action="<?php echo e(route('item.buy', ['item_id' => $item->id])); ?>">
                <?php echo csrf_field(); ?>
                <button class="purchase-button">購入手続きへ</button>
            </form>

        </div>
        <div class="comment-form">
            <h3>商品説明</h3>
            <p class="item-small"><?php echo e($item->description); ?></p>
            <h3>商品の情報</h3>
            <table class="information-table">
                <tr class="table-content">
                    <th class="table-header">カテゴリー</th>
                    <td class="table-detail">
<?php $__currentLoopData = $item->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <span class="category-block"><?php echo e($category->name); ?></span>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</td>

                </tr>
                <tr class="table-content">
                    <th class="table-header">商品の状態</th>
                    <td class="table-detail"><?php echo e($item->condition); ?></td>
                </tr>
            </table>
            <div class="comment">
    <h3>コメント（<?php echo e($commentCount); ?>件）</h3>

    <?php $__currentLoopData = $item->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="comment-item">
        <img
            src="<?php echo e($comment->user->profile_image
                ? asset('storage/' . $comment->user->profile_image)
                : asset('images/default-user.png')); ?>"
            class="comment-icon"
            alt="ユーザーアイコン"
        >
        <p class="comment-user">
                <?php echo e($comment->user->name); ?>

        </p>
    </div>
        <div class="comment-body">
            <p class="comment-box">
                <?php echo e($comment->comment); ?>

            </p>
        </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <form action="<?php echo e(route('comment.store', ['item_id' => $item->id])); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <label>
                        <p class="item-comment">商品へのコメント</p>
                        <textarea name="comment"></textarea>
                        <?php $__errorArgs = ['comment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <p class="input-error"><?php echo e($message); ?></p>
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    </label>
                        <button class="comment-button">コメントを送信する</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--いいね-->
<script>
document.querySelectorAll('.like-icon').forEach(icon => {
    icon.addEventListener('click', () => {
        const itemId = "<?php echo e($item->id); ?>";
        const countSpan = icon.parentElement.querySelector('.reaction-count span');

        fetch(`/items/${itemId}/favorite`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                'Content-Type': 'application/json'
            },
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'added') {
                icon.src = "<?php echo e(asset('images/ハートロゴ_ピンク.png')); ?>";
                icon.dataset.liked = 'true';
            } else {
                icon.src = "<?php echo e(asset('images/ハートロゴ_デフォルト.png')); ?>";
                icon.dataset.liked = 'false';
            }
            countSpan.textContent = data.count;
        })
        .catch(err => console.error(err));
    });
});
</script>





<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.common2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/site/item-detail.blade.php ENDPATH**/ ?>