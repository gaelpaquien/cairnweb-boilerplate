<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name',
    'label',
    'type' => 'text',
    'placeholder' => null,
    'required' => false,
    'optional' => null,
    'autocomplete' => null,
    'rows' => 5,
    'idPrefix' => 'contact',
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
    'name',
    'label',
    'type' => 'text',
    'placeholder' => null,
    'required' => false,
    'optional' => null,
    'autocomplete' => null,
    'rows' => 5,
    'idPrefix' => 'contact',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $id = $idPrefix.'-'.str_replace('_', '-', $name);
    $errorId = $id.'-error';
?>

<div class="form-group">
    <label class="form-label" for="<?php echo e($id); ?>">
        <?php echo e($label); ?><?php if($required): ?><span class="form-label-required" aria-hidden="true">*</span><?php elseif($optional): ?><span class="form-label-optional">(<?php echo e($optional); ?>)</span><?php endif; ?>
    </label>

    <?php if($type === 'textarea'): ?>
        <textarea
            name="<?php echo e($name); ?>"
            id="<?php echo e($id); ?>"
            class="form-input"
            placeholder="<?php echo e($placeholder); ?>"
            <?php if($required): ?> required aria-required="true" <?php endif; ?>
            aria-describedby="<?php echo e($errorId); ?>"
            rows="<?php echo e($rows); ?>"
            data-1p-ignore
            data-lpignore="true"
            data-bwignore
        ><?php echo e(old($name)); ?></textarea>
    <?php else: ?>
        <input
            type="<?php echo e($type); ?>"
            name="<?php echo e($name); ?>"
            id="<?php echo e($id); ?>"
            class="form-input"
            placeholder="<?php echo e($placeholder); ?>"
            <?php if($required): ?> required aria-required="true" <?php endif; ?>
            aria-describedby="<?php echo e($errorId); ?>"
            <?php if($autocomplete): ?> autocomplete="<?php echo e($autocomplete); ?>" <?php endif; ?>
            data-1p-ignore
            data-lpignore="true"
            data-bwignore
            value="<?php echo e(old($name)); ?>"
        >
    <?php endif; ?>

    <?php if (isset($component)) { $__componentOriginala0311668b84225c629d80adc067429fd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala0311668b84225c629d80adc067429fd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form-error','data' => ['field' => $name,'id' => $errorId]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['field' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($name),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errorId)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala0311668b84225c629d80adc067429fd)): ?>
<?php $attributes = $__attributesOriginala0311668b84225c629d80adc067429fd; ?>
<?php unset($__attributesOriginala0311668b84225c629d80adc067429fd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala0311668b84225c629d80adc067429fd)): ?>
<?php $component = $__componentOriginala0311668b84225c629d80adc067429fd; ?>
<?php unset($__componentOriginala0311668b84225c629d80adc067429fd); ?>
<?php endif; ?>
</div>
<?php /**PATH /Users/gaelpaquien/Documents/Lab/Perso/cairnweb/cairnweb-boilerplate/resources/views/components/form-field.blade.php ENDPATH**/ ?>