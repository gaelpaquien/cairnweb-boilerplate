<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'theme' => 'light',
    'padding' => 'default',
    'grain' => false,
    'id' => null,
    'label' => null,
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
    'theme' => 'light',
    'padding' => 'default',
    'grain' => false,
    'id' => null,
    'label' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<section
    data-section
    data-section-theme="<?php echo e($theme); ?>"
    data-padding="<?php echo e($padding); ?>"
    <?php if($grain): ?> data-grain <?php endif; ?>
    <?php if($id): ?> id="<?php echo e($id); ?>" <?php endif; ?>
    <?php if($label): ?> aria-labelledby="<?php echo e($label); ?>" <?php endif; ?>
    <?php echo e($attributes); ?>

>
    <div class="section-container">
        <?php echo e($slot); ?>

    </div>
</section>
<?php /**PATH /Users/gaelpaquien/Documents/Lab/Perso/cairnweb/cairnweb-boilerplate/resources/views/components/section.blade.php ENDPATH**/ ?>