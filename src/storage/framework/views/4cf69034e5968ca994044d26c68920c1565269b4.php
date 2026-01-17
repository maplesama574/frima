<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/email.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<main>
    <form action="<?php echo e(route('verification.send')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <div class="email">
        <p class="email-complete">
            登録していただいたメールアドレスに認証メールを送付しました。<br>
            メール認証を完了してください。
        </p>

        <a class="verify-form" href="http://localhost:8025/" target="_blank" rel="noopener noreferrer">
    認証はこちらから
        </a>


        <!-- 認証メール再送 -->
            <button class="verify-button" type="submit">認証メールを再送する</button>

        <?php if(session('message')): ?>
            <div class="resend-message">
                <?php echo e(session('message')); ?>

            </div>
        <?php endif; ?>
    </div>
    </form>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.common1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/site/email.blade.php ENDPATH**/ ?>