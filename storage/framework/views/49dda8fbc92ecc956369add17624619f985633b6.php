<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=<?php echo e(str_replace(' ', '+', config('app.settings.font_family.head', 'Poppins'))); ?>:wght@400;600;700&display=swap" rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'">
<link href="https://fonts.googleapis.com/css2?family=<?php echo e(str_replace(' ', '+', config('app.settings.font_family.body', 'Poppins'))); ?>:wght@400;600&display=swap" rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'">
<style>
:root {
  --head-font: "<?php echo e(config('app.settings.font_family.head', 'Poppins')); ?>";
  --body-font: "<?php echo e(config('app.settings.font_family.body', 'Poppins')); ?>";
  --primary: <?php echo e(config('app.settings.colors.primary', '#0155b5')); ?>;
  --secondary: <?php echo e(config('app.settings.colors.secondary', '#2fc10a')); ?>;
  --tertiary: <?php echo e(config('app.settings.colors.tertiary', '#d2ab3e')); ?>;
}
</style>
<script>
  let captcha_name = "<?php echo e(config('app.settings.captcha', 'off')); ?>";
  let site_key = "";
  if(captcha_name && captcha_name !== "off") {
    site_key = "<?php echo e(config('app.settings.' . config('app.settings.captcha') . '.site_key', '')); ?>";
  }
  let strings = <?php echo json_encode(\Lang::get('*')); ?>

  const __ = (string) => {
    if(strings[string] !== undefined) {
      return strings[string];
    } else {
      return string;
    }
  }
</script>
<?php $__currentLoopData = ['success', 'error']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if(Session::has($type)): ?>
<script defer>
  document.addEventListener("DOMContentLoaded", () => {
    document.dispatchEvent(new CustomEvent("showAlert", {
      bubbles: true,
      detail: {
        type: "<?php echo e($type); ?>",
        message: "<?php echo e(Session::get($type)); ?>",
      },
    }));
  });
</script>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH D:\code_kaylin\_github\Code Mail Ảo TMail\resources\views/frontend/common/header.blade.php ENDPATH**/ ?>