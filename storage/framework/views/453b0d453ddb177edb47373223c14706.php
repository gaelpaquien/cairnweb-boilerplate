<?php
    $siteGlobal = \Statamic\Facades\GlobalSet::findByHandle('site')?->inCurrentSite();
    $agencyName = (string) ($siteGlobal?->get('agency_name') ?? '');
    [$first, $second] = explode(' ', $agencyName, 2) + [1 => ''];
?>

<a href="/" <?php echo e($attributes->class('site-logo')); ?>>
    <span class="site-logo-strong"><?php echo e($first); ?></span><?php if($second !== ''): ?> <span class="site-logo-light"><?php echo e($second); ?></span><?php endif; ?>
</a>
<?php /**PATH /Users/gaelpaquien/Documents/Lab/Perso/cairnweb/cairnweb-boilerplate/resources/views/components/logo.blade.php ENDPATH**/ ?>