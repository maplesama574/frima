<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/profile-edit.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="profile">
    <h2>プロフィール設定</h2>
    <div class="profile-content">
        <form action="<?php echo e(route('profile.update')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="profile-image-wrapper">
                <label for="image-upload" class="image-label">
                    <div class="profile-image" id="profileImage" 
                    style="background-image: url('<?php echo e($user->profile_image ? asset('storage/' . $user->profile_image) : ''); ?>')">
                    </div>
                    <span class="image-text">画像を選択する</span>
                </label>
                <input type="file" id="image-upload" name="image" accept="image/*" hidden>
            </div>


<div class="upload-item">
    <label class="upload-item__title">ユーザー名</label>
    <input class="upload-input" type="text" name="name" value="<?php echo e(old('name', $user->name ?? '')); ?>">
    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="input-error"><?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="upload-item">
    <label class="upload-item__title">郵便番号</label>
    <input class="upload-input" type="number" name="postal_code" value="<?php echo e(old('postal_code', $user->postal_code ?? '')); ?>">
    <?php $__errorArgs = ['postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="input-error"><?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="upload-item">
    <label class="upload-item__title">住所</label>
    <input class="upload-input" type="text" name="address" value="<?php echo e(old('address', $user->address ?? '')); ?>">
    <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="input-error"><?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="upload-item">
    <label class="upload-item__title">建物名</label>
    <input class="upload-input" type="text" name="building" value="<?php echo e(old('building', $user->building ?? '')); ?>">
</div>
            <div class="button">
                <button class="upload-button">更新する</button>
            </div>

<!--モーダル-->
<script>
const imageInput = document.getElementById('image-upload');
const profileImage = document.getElementById('profileImage');

imageInput.addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            profileImage.style.backgroundImage = `url(${e.target.result})`;
        }
        reader.readAsDataURL(file);
    }
});
</script>

        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.common2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/site/profile-edit.blade.php ENDPATH**/ ?>