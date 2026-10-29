<main x-data="{ id: 0 }" class="flex-1 lg:flex">
    <?php if($overflow): ?>
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
    <?php endif; ?>
    <?php if($error): ?>
    <div id="imap-error" class="flex items-center w-full h-full fixed top-0 left-0 bg-red-900 opacity-75 z-50">
        <div class="flex flex-col mx-auto">
            <div class="w-36 mx-auto text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="text-3xl text-center text-white my-5"><?php echo e(__('IMAP Broken')); ?></div>
            <div class="p-2 mx-auto bg-red-800 text-white leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                <span class="flex rounded-full bg-red-500 uppercase px-2 py-1 text-xs font-bold mr-3"><?php echo e(__('Error')); ?></span>
                <span class="font-semibold mr-2 text-left flex-auto"><?php echo e($error); ?></span>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="w-full lg:w-1/3 bg-white flex flex-col min-h-tm-mobile">
        <?php if($messages): ?>
        <div class="messages flex flex-col divide-y divide-gray-200">
            <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($i / 3 == 0 && config('app.settings.ads.four')): ?>
            <div class="max-w-full ads-four"><?php echo config('app.settings.ads.four'); ?></div>
            <?php endif; ?>
            <?php if(!in_array($i, $deleted)): ?>
            <div x-on:click="id = <?php echo e($message['id']); ?>; document.querySelector('.message-content').scrollIntoView({behavior: 'smooth'});" class="w-full p-5 cursor-pointer hover:bg-gray-50" data-id="<?php echo e($message['id']); ?>">
                <div class="flex justify-between">
                    <div>
                        <div class="text-gray-800"><?php echo e($message['sender_name']); ?></div>
                        <div class="text-xs text-gray-400"><?php echo e($message['sender_email']); ?></div>
                    </div>
                    <div>
                        <div class="text-gray-800 text-sm"><?php echo e($message['datediff']); ?></div>
                    </div>
                </div>
                <div class="text-gray-600 mt-5 text-sm truncate"><?php echo e($message['subject']); ?></div>
            </div>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php else: ?>
        <div class="flex-1 flex justify-center items-center h-40 text-gray-400 text-2xl">
            <?php echo e($initial ? __('Empty Inbox') : __('Fetching') . '...'); ?>

        </div>
        <?php endif; ?>
    </div>
    <div class="message-content w-full lg:w-2/3 bg-white border-1 border-l border-gray-200 flex flex-col">
        <div x-show="id === 0" class="flex-1 hidden lg:flex">
            <div class="w-2/3 m-auto">
                <img class="m-auto max-w-full" src="<?php echo e(asset('images/sample.jpg')); ?>" alt="mails">
            </div>
        </div>
        <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div x-show="id === <?php echo e($message['id']); ?>" id="message-<?php echo e($message['id']); ?>" class="flex-1 lg:flex flex-col">
            <textarea class="hidden">To: <?php echo e($this->email); ?>&#13;From: "<?php echo e($message['sender_name']); ?>" <<?php echo e($message['sender_email']); ?>>&#13;Subject: <?php echo e($message['subject']); ?>&#13;Date: <?php echo e($message['date']); ?>&#13;Content-Type: text/html&#13;&#13;<?php echo e($message['content']); ?></textarea>
            <div class="flex flex-col flex-none py-5 px-6">
                <div class="flex justify-between items-center">
                    <div>
                        <div class="text-gray-900 text-lg"><?php echo e($message['subject']); ?></div>
                        <div class="text-xs text-gray-400"><?php echo e($message['sender_name']); ?> - <?php echo e($message['sender_email']); ?></div>
                    </div>
                    <div>
                        <div class="text-xs text-gray-400"><?php echo e($message['date']); ?></div>
                    </div>
                </div>
                <div class="flex mt-5">
                    <a class="download text-xs font-semibold bg-blue-700 py-1 px-3 rounded-md text-white" href="#" data-id="<?php echo e($message['id']); ?>"><?php echo e(__('Download')); ?></a>
                    <span class="mr-2"></span>
                    <button x-on:click="id = 0; document.querySelector(`[data-id='<?php echo e($message['id']); ?>']`).remove()" wire:click="delete(<?php echo e($message['id']); ?>)" class="text-xs font-semibold bg-red-700 py-1 px-3 rounded-md text-white"><?php echo e(__('Delete')); ?></button>
                </div>
            </div>
            <iframe class="w-full flex flex-grow px-5" srcdoc="<?php echo e($message['content']); ?>" frameborder="0"></iframe>
            <?php if(count($message['attachments']) > 0): ?>
            <span class="pt-5 pb-3 px-6 text-xs"><?php echo e(__('Attachments')); ?></span>
            <div class="flex pb-5 px-6">
                <?php $__currentLoopData = $message['attachments']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a class="py-2 px-3 mr-3 text-sm border-2 border-black rounded-md hover:bg-black hover:text-white" href="<?php echo e($attachment['url']); ?>" download><i class="fas fa-chevron-circle-down"></i><span class="ml-2"><?php echo e($attachment['file']); ?></span></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</main><?php /**PATH D:\code_kaylin\_github\Code Mail Ảo TMail\resources\views/themes/default/components/app.blade.php ENDPATH**/ ?>