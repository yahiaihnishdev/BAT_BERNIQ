<?php $__env->startSection('content'); ?>
    <h1>Generate New Resource</h1>

    <form action="<?php echo e(route('codegenerator.generate')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label for="resource_name" class="form-label">Resource Name:</label>
            <input type="text" id="resource_name" name="resource_name" class="form-control" placeholder="e.g., Post" required>
        </div>

        <div class="mb-3">
            <label for="fields" class="form-label">Fields (comma-separated):</label>
            <input type="text" id="fields" name="fields" class="form-control" placeholder="e.g., title, content, author">
        </div>

        <button type="submit" class="btn btn-primary">Generate Resource</button>
    </form>

    <?php if(session('success')): ?>
        <div class="alert alert-success mt-3"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\bat laravel project\final\back_end_app\back_end_app\resources\views/codegenerator/index.blade.php ENDPATH**/ ?>