<?php if($meta_title ?? null): ?>
    <?php $__env->startSection('meta_title', $meta_title); ?>
<?php elseif($title ?? null): ?>
    <?php $__env->startSection('meta_title', $title . ' — ' . config('app.name')); ?>
<?php endif; ?>

<?php if($meta_description ?? null): ?>
    <?php $__env->startSection('meta_description', $meta_description); ?>
<?php endif; ?>

<?php $__env->startSection('og_type', 'article'); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginal785c8021fd1a6e19eb80cad4b837cda0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal785c8021fd1a6e19eb80cad4b837cda0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section','data' => ['theme' => 'light','padding' => 'default','class' => 'legal-section']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['theme' => 'light','padding' => 'default','class' => 'legal-section']); ?>
        <article class="prose max-w-none legal-article">
            <h1 class="legal-title"><?php echo e($title); ?></h1>

            <div class="legal-content">
                <?php echo $content; ?>

            </div>
        </article>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal785c8021fd1a6e19eb80cad4b837cda0)): ?>
<?php $attributes = $__attributesOriginal785c8021fd1a6e19eb80cad4b837cda0; ?>
<?php unset($__attributesOriginal785c8021fd1a6e19eb80cad4b837cda0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal785c8021fd1a6e19eb80cad4b837cda0)): ?>
<?php $component = $__componentOriginal785c8021fd1a6e19eb80cad4b837cda0; ?>
<?php unset($__componentOriginal785c8021fd1a6e19eb80cad4b837cda0); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/gaelpaquien/Documents/Lab/Perso/cairnweb/cairnweb-boilerplate/resources/views/pages/legal.blade.php ENDPATH**/ ?>