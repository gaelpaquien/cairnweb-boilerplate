<?php extract((new \Illuminate\Support\Collection($attributes->getAttributes()))->mapWithKeys(function ($value, $key) { return [Illuminate\Support\Str::camel(str_replace([':', '.'], ' ', $key)) => $value]; })->all(), EXTR_SKIP); ?>
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['class','ariaHidden']));

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

foreach (array_filter((['class','ariaHidden']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php if (isset($component)) { $__componentOriginalda6a6e700391614c5210d6249f833787 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalda6a6e700391614c5210d6249f833787 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.phone','data' => ['class' => $class,'ariaHidden' => $ariaHidden]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.phone'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($class),'aria-hidden' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($ariaHidden)]); ?>

<?php echo e($slot ?? ""); ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalda6a6e700391614c5210d6249f833787)): ?>
<?php $attributes = $__attributesOriginalda6a6e700391614c5210d6249f833787; ?>
<?php unset($__attributesOriginalda6a6e700391614c5210d6249f833787); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalda6a6e700391614c5210d6249f833787)): ?>
<?php $component = $__componentOriginalda6a6e700391614c5210d6249f833787; ?>
<?php unset($__componentOriginalda6a6e700391614c5210d6249f833787); ?>
<?php endif; ?><?php /**PATH /Users/gaelpaquien/Documents/Lab/Perso/cairnweb/cairnweb-boilerplate/storage/framework/views/1cc74415ea5135090187ddd14ad9a641.blade.php ENDPATH**/ ?>