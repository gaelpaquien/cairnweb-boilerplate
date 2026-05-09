<?php
    $siteGlobal = \Statamic\Facades\GlobalSet::findByHandle('site')?->inCurrentSite();
    $uiGlobal = \Statamic\Facades\GlobalSet::findByHandle('ui')?->inCurrentSite();
    $navItems = $siteGlobal->get('nav_items', []);
    $legalLinks = $siteGlobal->get('footer_extra_links', []);
    $footerText = $siteGlobal->get('footer_text');
    $footerNavTitle = $siteGlobal->get('footer_nav_title');
    $footerCreditPrefix = $siteGlobal->get('footer_credit_prefix');
    $footerCreditLinkText = $siteGlobal->get('footer_credit_link_text');
    $footerCreditUrl = $siteGlobal->get('footer_credit_url');
    $copyright = str_replace('{year}', (string) date('Y'), (string) $siteGlobal->get('footer_copyright'));
    $email = $siteGlobal->get('email');
    $phone = $siteGlobal->get('phone');
    $address = $siteGlobal->get('address');
    $hours = $siteGlobal->get('business_hours');

    $allLinks = collect($navItems)->merge($legalLinks)->map(fn($item) => [
        'label' => $item['label'],
        'href' => \App\Support\Url::anchor($item['href']),
    ])->values();
?>

<footer data-footer aria-label="<?php echo e($uiGlobal->get('footer_aria_label')); ?>">
    <div class="section-container">

        <div class="footer-tier footer-tier-brand">
            <?php if (isset($component)) { $__componentOriginal987d96ec78ed1cf75b349e2e5981978f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal987d96ec78ed1cf75b349e2e5981978f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.logo','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal987d96ec78ed1cf75b349e2e5981978f)): ?>
<?php $attributes = $__attributesOriginal987d96ec78ed1cf75b349e2e5981978f; ?>
<?php unset($__attributesOriginal987d96ec78ed1cf75b349e2e5981978f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal987d96ec78ed1cf75b349e2e5981978f)): ?>
<?php $component = $__componentOriginal987d96ec78ed1cf75b349e2e5981978f; ?>
<?php unset($__componentOriginal987d96ec78ed1cf75b349e2e5981978f); ?>
<?php endif; ?>

            <?php if($footerText): ?>
            <p class="footer-description"><?php echo e($footerText); ?></p>
            <?php endif; ?>
        </div>

        <hr class="footer-separator footer-separator--mobile-only" aria-hidden="true" />

        <div class="footer-tier footer-tier-contact">
            <div class="footer-contact">
                <?php if (isset($component)) { $__componentOriginal4d04945334460d3ef84e5571af6488f3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4d04945334460d3ef84e5571af6488f3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.contact-link','data' => ['type' => 'phone','value' => $phone,'class' => 'footer-contact-item']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('contact-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'phone','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($phone),'class' => 'footer-contact-item']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4d04945334460d3ef84e5571af6488f3)): ?>
<?php $attributes = $__attributesOriginal4d04945334460d3ef84e5571af6488f3; ?>
<?php unset($__attributesOriginal4d04945334460d3ef84e5571af6488f3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4d04945334460d3ef84e5571af6488f3)): ?>
<?php $component = $__componentOriginal4d04945334460d3ef84e5571af6488f3; ?>
<?php unset($__componentOriginal4d04945334460d3ef84e5571af6488f3); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginal4d04945334460d3ef84e5571af6488f3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4d04945334460d3ef84e5571af6488f3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.contact-link','data' => ['type' => 'email','value' => $email,'class' => 'footer-contact-item']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('contact-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'email','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($email),'class' => 'footer-contact-item']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4d04945334460d3ef84e5571af6488f3)): ?>
<?php $attributes = $__attributesOriginal4d04945334460d3ef84e5571af6488f3; ?>
<?php unset($__attributesOriginal4d04945334460d3ef84e5571af6488f3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4d04945334460d3ef84e5571af6488f3)): ?>
<?php $component = $__componentOriginal4d04945334460d3ef84e5571af6488f3; ?>
<?php unset($__componentOriginal4d04945334460d3ef84e5571af6488f3); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginal4d04945334460d3ef84e5571af6488f3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4d04945334460d3ef84e5571af6488f3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.contact-link','data' => ['type' => 'address','value' => $address,'class' => 'footer-contact-item']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('contact-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'address','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($address),'class' => 'footer-contact-item']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4d04945334460d3ef84e5571af6488f3)): ?>
<?php $attributes = $__attributesOriginal4d04945334460d3ef84e5571af6488f3; ?>
<?php unset($__attributesOriginal4d04945334460d3ef84e5571af6488f3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4d04945334460d3ef84e5571af6488f3)): ?>
<?php $component = $__componentOriginal4d04945334460d3ef84e5571af6488f3; ?>
<?php unset($__componentOriginal4d04945334460d3ef84e5571af6488f3); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginal4d04945334460d3ef84e5571af6488f3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4d04945334460d3ef84e5571af6488f3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.contact-link','data' => ['type' => 'hours','value' => $hours,'class' => 'footer-contact-item']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('contact-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'hours','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($hours),'class' => 'footer-contact-item']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4d04945334460d3ef84e5571af6488f3)): ?>
<?php $attributes = $__attributesOriginal4d04945334460d3ef84e5571af6488f3; ?>
<?php unset($__attributesOriginal4d04945334460d3ef84e5571af6488f3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4d04945334460d3ef84e5571af6488f3)): ?>
<?php $component = $__componentOriginal4d04945334460d3ef84e5571af6488f3; ?>
<?php unset($__componentOriginal4d04945334460d3ef84e5571af6488f3); ?>
<?php endif; ?>
            </div>
        </div>

        <hr class="footer-separator footer-separator--mobile-only" aria-hidden="true" />

        <div class="footer-tier footer-tier-nav">
            <nav aria-label="<?php echo e($uiGlobal->get('footer_nav_aria_label')); ?>">
                <p class="footer-nav-title"><?php echo e($footerNavTitle); ?></p>
                <ul class="footer-nav-list">
                    <?php $__currentLoopData = $allLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a href="<?php echo e($link['href']); ?>" class="footer-nav-link"><?php echo e($link['label']); ?></a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </nav>
        </div>

        <hr class="footer-separator" aria-hidden="true" />

        <div class="footer-tier footer-tier-copyright">
            <p class="footer-copyright"><?php echo e($copyright); ?></p>

            <?php if($footerCreditLinkText && $footerCreditUrl): ?>
                <p class="footer-credit">
                    <?php echo e($footerCreditPrefix); ?><a href="<?php echo e($footerCreditUrl); ?>" target="_blank" rel="noopener noreferrer" class="footer-credit-link"><?php echo e($footerCreditLinkText); ?></a>
                </p>
            <?php endif; ?>
        </div>
    </div>

</footer>
<?php /**PATH /Users/gaelpaquien/Documents/Lab/Perso/cairnweb/cairnweb-boilerplate/resources/views/components/footer.blade.php ENDPATH**/ ?>