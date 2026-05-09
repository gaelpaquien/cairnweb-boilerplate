<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['contact', 'site']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['contact', 'site']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $phone = $site?->get('phone');
    $email = $site?->get('email');
    $intro = $contact?->get('success_contact_intro');
?>

<div <?php echo e($attributes->merge(['class' => 'contact-success'])); ?> role="status" aria-live="polite">
    <?php if (isset($component)) { $__componentOriginald437fe0064eab6d7fb2abdae5ed6f550 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald437fe0064eab6d7fb2abdae5ed6f550 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.check','data' => ['class' => 'contact-success-icon']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.check'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'contact-success-icon']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald437fe0064eab6d7fb2abdae5ed6f550)): ?>
<?php $attributes = $__attributesOriginald437fe0064eab6d7fb2abdae5ed6f550; ?>
<?php unset($__attributesOriginald437fe0064eab6d7fb2abdae5ed6f550); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald437fe0064eab6d7fb2abdae5ed6f550)): ?>
<?php $component = $__componentOriginald437fe0064eab6d7fb2abdae5ed6f550; ?>
<?php unset($__componentOriginald437fe0064eab6d7fb2abdae5ed6f550); ?>
<?php endif; ?>
    <h3 class="contact-success-title"><?php echo e($contact->get('success_title')); ?></h3>
    <p class="contact-success-message"><?php echo e($contact->get('success_message')); ?></p>

    <?php if($phone || $email): ?>
        <div class="contact-success-fallback">
            <?php if($intro): ?>
                <p class="contact-success-fallback-intro"><?php echo e($intro); ?></p>
            <?php endif; ?>
            <div class="contact-success-fallback-row">
                <?php if($phone): ?>
                    <a href="tel:<?php echo e(preg_replace('/\s+/', '', $phone)); ?>" class="contact-success-fallback-item">
                        <?php if (isset($component)) { $__componentOriginalda6a6e700391614c5210d6249f833787 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalda6a6e700391614c5210d6249f833787 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.phone','data' => ['class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.phone'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalda6a6e700391614c5210d6249f833787)): ?>
<?php $attributes = $__attributesOriginalda6a6e700391614c5210d6249f833787; ?>
<?php unset($__attributesOriginalda6a6e700391614c5210d6249f833787); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalda6a6e700391614c5210d6249f833787)): ?>
<?php $component = $__componentOriginalda6a6e700391614c5210d6249f833787; ?>
<?php unset($__componentOriginalda6a6e700391614c5210d6249f833787); ?>
<?php endif; ?>
                        <?php echo e($phone); ?>

                    </a>
                <?php endif; ?>

                <?php if($phone && $email): ?>
                    <span class="contact-success-fallback-separator" aria-hidden="true"></span>
                <?php endif; ?>

                <?php if($email): ?>
                    <a href="mailto:<?php echo e($email); ?>" class="contact-success-fallback-item">
                        <?php if (isset($component)) { $__componentOriginal01373fe5e2aaee47705ab1cbef2eac77 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal01373fe5e2aaee47705ab1cbef2eac77 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.mail','data' => ['class' => 'w-4 h-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.mail'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal01373fe5e2aaee47705ab1cbef2eac77)): ?>
<?php $attributes = $__attributesOriginal01373fe5e2aaee47705ab1cbef2eac77; ?>
<?php unset($__attributesOriginal01373fe5e2aaee47705ab1cbef2eac77); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal01373fe5e2aaee47705ab1cbef2eac77)): ?>
<?php $component = $__componentOriginal01373fe5e2aaee47705ab1cbef2eac77; ?>
<?php unset($__componentOriginal01373fe5e2aaee47705ab1cbef2eac77); ?>
<?php endif; ?>
                        <?php echo e($email); ?>

                    </a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH /Users/gaelpaquien/Documents/Lab/Perso/cairnweb/cairnweb-boilerplate/resources/views/components/contact/success-state.blade.php ENDPATH**/ ?>