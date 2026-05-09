<?php
    $siteGlobal = \Statamic\Facades\GlobalSet::findByHandle('site')?->inCurrentSite();
    $agencyName = $siteGlobal->get('agency_name');
    $ogImageAsset = $siteGlobal->augmentedValue('og_image')?->value();

    // Cache-bust the OG image URL so social platforms refetch when it's replaced.
    $ogImageDefault = '';
    $ogImageWidth = null;
    $ogImageHeight = null;
    if ($ogImageAsset) {
        $ogImageVersion = $ogImageAsset->lastModified()?->timestamp;
        $ogImageDefault = $ogImageAsset->url().($ogImageVersion ? '?v='.$ogImageVersion : '');
        $ogImageWidth = $ogImageAsset->width();
        $ogImageHeight = $ogImageAsset->height();
    }

    $metaTitle = $__env->yieldContent('meta_title', $siteGlobal->get('meta_title'));
    $metaDescription = $__env->yieldContent('meta_description', $siteGlobal->get('meta_description'));
    $ogImage = $__env->yieldContent('og_image', $ogImageDefault);
    $canonical = $__env->yieldContent('canonical', url()->current());
    $metaRobots = $__env->yieldContent('meta_robots', 'index, follow');
    $ogType = $__env->yieldContent('og_type', 'website');
    $siteLocale = (string) $siteGlobal->get('site_locale');
    $ogLocale = str_replace('-', '_', $siteLocale);
?>

<title><?php echo e($metaTitle); ?></title>
<meta name="description" content="<?php echo e($metaDescription); ?>">
<meta name="robots" content="<?php echo e($metaRobots); ?>">
<link rel="canonical" href="<?php echo e($canonical); ?>">
<meta name="theme-color" content="<?php echo e($siteGlobal->get('theme_color')); ?>">

<?php if($siteGlobal->get('google_site_verification')): ?>
<meta name="google-site-verification" content="<?php echo e($siteGlobal->get('google_site_verification')); ?>">
<?php endif; ?>
<?php if($siteGlobal->get('bing_site_verification')): ?>
<meta name="msvalidate.01" content="<?php echo e($siteGlobal->get('bing_site_verification')); ?>">
<?php endif; ?>

<meta property="og:title" content="<?php echo e($metaTitle); ?>">
<meta property="og:description" content="<?php echo e($metaDescription); ?>">
<meta property="og:type" content="<?php echo e($ogType); ?>">
<meta property="og:url" content="<?php echo e($canonical); ?>">
<meta property="og:locale" content="<?php echo e($ogLocale); ?>">
<meta property="og:site_name" content="<?php echo e($agencyName); ?>">
<?php if($ogImage): ?>
<meta property="og:image" content="<?php echo e($ogImage); ?>">
<meta property="og:image:secure_url" content="<?php echo e($ogImage); ?>">
<?php if($ogImageWidth && $ogImageHeight): ?>
<meta property="og:image:width" content="<?php echo e($ogImageWidth); ?>">
<meta property="og:image:height" content="<?php echo e($ogImageHeight); ?>">
<?php endif; ?>
<meta property="og:image:alt" content="<?php echo e($ogImageAsset ? $ogImageAsset->get('alt') : $agencyName); ?>">
<?php endif; ?>

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo e($metaTitle); ?>">
<meta name="twitter:description" content="<?php echo e($metaDescription); ?>">
<?php if($ogImage): ?>
<meta name="twitter:image" content="<?php echo e($ogImage); ?>">
<?php endif; ?>
<?php /**PATH /Users/gaelpaquien/Documents/Lab/Perso/cairnweb/cairnweb-boilerplate/resources/views/partials/seo-meta.blade.php ENDPATH**/ ?>