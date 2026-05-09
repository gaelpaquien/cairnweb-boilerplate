<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
    'type' => 'button',
    'disabled' => false,
]));

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

foreach (array_filter(([
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
    'type' => 'button',
    'disabled' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php if($href): ?>
    <a
        href="<?php echo e($href); ?>"
        data-button
        data-variant="<?php echo e($variant); ?>"
        data-size="<?php echo e($size); ?>"
        <?php echo e($attributes); ?>

        <?php if($disabled): ?> aria-disabled="true" tabindex="-1" <?php endif; ?>
    >
        <?php echo e($slot); ?>

    </a>
<?php else: ?>
    <button
        type="<?php echo e($type); ?>"
        data-button
        data-variant="<?php echo e($variant); ?>"
        data-size="<?php echo e($size); ?>"
        <?php echo e($attributes); ?>

        <?php if($disabled): ?> disabled <?php endif; ?>
    >
        <?php echo e($slot); ?>

    </button>
<?php endif; ?>
<?php /**PATH /Users/gaelpaquien/Documents/Lab/Perso/cairnweb/cairnweb-boilerplate/resources/views/components/button.blade.php ENDPATH**/ ?>