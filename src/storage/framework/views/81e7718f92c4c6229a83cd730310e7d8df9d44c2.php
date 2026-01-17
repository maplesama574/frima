<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COACHTECH</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/app2.css')); ?>">
    <?php echo $__env->yieldContent('css'); ?>
</head>
<body>
    <header>
        <div class="header-title">
    <div class="logo">
        <a href="<?php echo e(route('dashboard')); ?>">
            <img src="<?php echo e(asset('images/COACHTECHヘッダーロゴ.png')); ?>" alt="ロゴ">
        </a>
    </div>

<div class="search-form">
    <form method="GET"
          action="<?php echo e(request()->routeIs('like') ? route('like') : route('dashboard')); ?>">
        <input type="text" name="keyword"
               value="<?php echo e(request('keyword')); ?>"
               placeholder="なにをお探しですか？">
    </form>
</div>


<div class="search-nav">
    <?php if(auth()->guard()->check()): ?>
        <form action="<?php echo e(route('logout')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <button class="logout-link">ログアウト</button>
        </form>

        <a class="nav" href="<?php echo e(route('mypage')); ?>">マイページ</a>
        <a class="nav-sell" href="<?php echo e(route('sell')); ?>">出品</a>
    <?php endif; ?>

    <?php if(auth()->guard()->guest()): ?>
        <a class="nav" href="<?php echo e(route('login')); ?>">ログイン</a>
        <a class="nav" href="<?php echo e(route('mypage')); ?>">マイページ</a>
        <a class="nav-sell" href="<?php echo e(route('sell')); ?>">出品</a>
    <?php endif; ?>
</div>


</div>

    </header>

<?php echo $__env->yieldContent('content'); ?>
</body>
</html><?php /**PATH /var/www/resources/views/site/common2.blade.php ENDPATH**/ ?>