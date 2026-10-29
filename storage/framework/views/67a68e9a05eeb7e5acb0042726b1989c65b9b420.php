<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.settings.name', 'Laravel')); ?></title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

        <!-- Styles -->
        <link rel="preload" as="style" href="<?php echo e(asset('css/vendor.css')); ?>" onload="this.onload=null;this.rel='stylesheet'">

        <!-- Scripts -->
        <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            <?php echo e($slot); ?>

        </div>
    </body>
</html>
<?php /**PATH D:\code_kaylin\_github\Code Mail Ảo TMail\resources\views/layouts/guest.blade.php ENDPATH**/ ?>