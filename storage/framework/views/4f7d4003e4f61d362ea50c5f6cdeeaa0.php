<?php
    $siteGlobal = \Statamic\Facades\GlobalSet::findByHandle('site')?->inCurrentSite();

    $faviconIco = $siteGlobal->augmentedValue('favicon_ico')?->value();
    $favicon32 = $siteGlobal->augmentedValue('favicon_32')?->value();
    $favicon16 = $siteGlobal->augmentedValue('favicon_16')?->value();
    $appleTouchIcon = $siteGlobal->augmentedValue('apple_touch_icon')?->value();
?>

<?php if($faviconIco): ?>
<link rel="icon" href="<?php echo e($faviconIco->url()); ?>" sizes="any">
<?php endif; ?>
<?php if($favicon32): ?>
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo e($favicon32->url()); ?>">
<?php endif; ?>
<?php if($favicon16): ?>
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo e($favicon16->url()); ?>">
<?php endif; ?>
<?php if($appleTouchIcon): ?>
<link rel="apple-touch-icon" href="<?php echo e($appleTouchIcon->url()); ?>">
<?php endif; ?>
<?php /**PATH /Users/gaelpaquien/Documents/Lab/Perso/cairnweb/cairnweb-boilerplate/resources/views/partials/favicons.blade.php ENDPATH**/ ?>