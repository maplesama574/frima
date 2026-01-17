<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COACHTECH</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/app1.css')); ?>">
    <?php echo $__env->yieldContent('css'); ?>
</head>
<body>
    <header>
        <div class="header-title">
            <a class="header-logo" href="<?php echo e(route('login')); ?>">
                <img src="<?php echo e(asset('images/COACHTECHヘッダーロゴ.png')); ?>" alt="ロゴ" style="height: 35px; width: auto;">
            </a>
        </div>
    </header>

<?php echo $__env->yieldContent('content'); ?>
    
</body>
</html><?php /**PATH /var/www/resources/views/site/common1.blade.php ENDPATH**/ ?>