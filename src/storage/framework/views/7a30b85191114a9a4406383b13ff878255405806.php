<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/login.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<main>
    <div class="login">
        <h2>ログイン</h2>
        <div class="login-form">
<form method="POST" action="<?php echo e(route('login')); ?>">
    <?php echo csrf_field(); ?>

    <?php if($errors->any()): ?>
        <div class="input-error">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p><?php echo e($error); ?></p>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    <div class="login-item">
        <p class="login-item__title">メールアドレス</p>
        <input class="login-input" type="email" name="email" required>
    </div>

    <div class="login-item">
        <p class="login-item__title">パスワード</p>
        <input class="login-input" type="password" name="password" required>
    </div>

    <div class="button">
        <button type="submit" class="login-button">ログインする</button>
    </div>
</form>

            <div class="login">
                <a class="register-button" href="/register">会員登録はこちらから</a>
            </div>
        </div>
    </div>
</main>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.common1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/site/login.blade.php ENDPATH**/ ?>