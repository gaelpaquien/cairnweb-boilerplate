<?php
    $heroGlobal = \Statamic\Facades\GlobalSet::findByHandle('hero')?->inCurrentSite();
    $contactGlobal = \Statamic\Facades\GlobalSet::findByHandle('contact')?->inCurrentSite();
    $siteGlobal = \Statamic\Facades\GlobalSet::findByHandle('site')?->inCurrentSite();

    $sectionItems = collect(['section_1', 'section_2', 'section_3', 'section_4'])
        ->map(fn ($handle) => \Statamic\Facades\GlobalSet::findByHandle($handle)?->inCurrentSite())
        ->filter()
        ->map(fn ($g) => [
            'slug' => str_replace('_', '-', $g->handle()),
            'title' => $g->get('title'),
            'content' => $g->get('content'),
        ])
        ->values()
        ->all();
?>

<?php $__env->startSection('content'); ?>
    <section
        data-section
        data-section-theme="dark"
        data-grain
        id="hero"
        aria-labelledby="hero-heading"
        class="relative min-h-svh 2xl:min-h-0 overflow-hidden flex items-center"
    >
        <div class="section-container relative z-10 hero-grid">

            <div class="hero-text">
                <?php if($heroGlobal->get('overtitle')): ?>
                    <?php if (isset($component)) { $__componentOriginalb3ea7901272637cd67897b9ddbad3588 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb3ea7901272637cd67897b9ddbad3588 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.overtitle','data' => ['dataHeroAnimate' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('overtitle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['data-hero-animate' => true]); ?><?php echo e($heroGlobal->get('overtitle')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb3ea7901272637cd67897b9ddbad3588)): ?>
<?php $attributes = $__attributesOriginalb3ea7901272637cd67897b9ddbad3588; ?>
<?php unset($__attributesOriginalb3ea7901272637cd67897b9ddbad3588); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb3ea7901272637cd67897b9ddbad3588)): ?>
<?php $component = $__componentOriginalb3ea7901272637cd67897b9ddbad3588; ?>
<?php unset($__componentOriginalb3ea7901272637cd67897b9ddbad3588); ?>
<?php endif; ?>
                <?php endif; ?>

                <h1
                    id="hero-heading"
                    data-hero-animate
                    class="hero-title"
                >
                    <?php if($heroGlobal->get('title_accent')): ?>
                        <?php echo str_replace(
                            $heroGlobal->get('title_accent'),
                            '<mark class="hero-highlight">' . e($heroGlobal->get('title_accent')) . '</mark>',
                            e($heroGlobal->get('title'))
                        ); ?>

                    <?php else: ?>
                        <?php echo e($heroGlobal->get('title')); ?>

                    <?php endif; ?>
                </h1>

                <p data-hero-animate class="hero-subtitle">
                    <?php echo e($heroGlobal->get('subtitle')); ?>

                </p>

                <div data-hero-animate class="hero-cta-wrapper">
                    <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['variant' => 'primary','href' => $heroGlobal->get('cta_primary_target'),'dataHeroCta' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($heroGlobal->get('cta_primary_target')),'data-hero-cta' => true]); ?>
                        <?php echo e($heroGlobal->get('cta_primary_text')); ?>

                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                </div>
            </div>

        </div>

    </section>

    <?php $__currentLoopData = $sectionItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $theme = $index % 2 === 0 ? 'light' : 'dark';
            $sectionId = $item['slug'] ?? 'section-' . ($index + 1);
            $headingId = $sectionId . '-heading';
        ?>
        <?php if (isset($component)) { $__componentOriginal785c8021fd1a6e19eb80cad4b837cda0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal785c8021fd1a6e19eb80cad4b837cda0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section','data' => ['theme' => $theme,'id' => $sectionId,'label' => $headingId,'grain' => $theme === 'dark']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['theme' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($theme),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sectionId),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($headingId),'grain' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($theme === 'dark')]); ?>
            <div class="generic-section" data-gsap="fade-up">
                <h2 id="<?php echo e($headingId); ?>" class="generic-section-title">
                    <?php echo e($item['title']); ?>

                </h2>
                <?php if($item['content'] ?? null): ?>
                    <p class="generic-section-content">
                        <?php echo e($item['content']); ?>

                    </p>
                <?php endif; ?>
            </div>
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
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php
        $contactTheme = count($sectionItems) % 2 === 0 ? 'light' : 'dark';
    ?>
    <?php if (isset($component)) { $__componentOriginal785c8021fd1a6e19eb80cad4b837cda0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal785c8021fd1a6e19eb80cad4b837cda0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.section','data' => ['theme' => $contactTheme,'id' => 'contact','label' => 'contact-heading']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['theme' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($contactTheme),'id' => 'contact','label' => 'contact-heading']); ?>
        <div data-gsap="fade-up">
            <h2 id="contact-heading" class="contact-title">
                <?php echo e($contactGlobal->get('section_title')); ?>

            </h2>

            <?php if(session('contact_success')): ?>
                <p class="contact-success"><?php echo e($contactGlobal->get('success_message')); ?></p>
            <?php else: ?>
                <form
                action="<?php echo e(route('contact.store')); ?>"
                method="POST"
                class="contact-form"
                data-contact-form
                data-error-message="<?php echo e($contactGlobal->get('error_message')); ?>"
                data-rate-limit-message="<?php echo e($contactGlobal->get('rate_limit_message')); ?>"
                novalidate
            >
                <?php echo csrf_field(); ?>

                
                <div class="contact-hp" aria-hidden="true">
                    <input type="text" name="website" tabindex="-1" autocomplete="off">
                </div>

                
                <input type="hidden" name="form_loaded_at" value="<?php echo e(time()); ?>">

                <div data-contact-body>
                    <p class="contact-banner <?php if(session('contact_error')): ?> is-visible <?php endif; ?>" data-contact-error-banner role="alert" aria-live="polite"><?php if(session('contact_error')): ?><?php echo e($contactGlobal->get('error_message')); ?><?php endif; ?></p>

                    <?php if (isset($component)) { $__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form-field','data' => ['name' => 'first_name','label' => $contactGlobal->get('label_firstname'),'placeholder' => $contactGlobal->get('placeholder_firstname'),'required' => true,'autocomplete' => 'given-name']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'first_name','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($contactGlobal->get('label_firstname')),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($contactGlobal->get('placeholder_firstname')),'required' => true,'autocomplete' => 'given-name']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d)): ?>
<?php $attributes = $__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d; ?>
<?php unset($__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d)): ?>
<?php $component = $__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d; ?>
<?php unset($__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d); ?>
<?php endif; ?>

                    <?php if (isset($component)) { $__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form-field','data' => ['name' => 'last_name','label' => $contactGlobal->get('label_lastname'),'placeholder' => $contactGlobal->get('placeholder_lastname'),'required' => true,'autocomplete' => 'family-name']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'last_name','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($contactGlobal->get('label_lastname')),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($contactGlobal->get('placeholder_lastname')),'required' => true,'autocomplete' => 'family-name']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d)): ?>
<?php $attributes = $__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d; ?>
<?php unset($__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d)): ?>
<?php $component = $__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d; ?>
<?php unset($__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d); ?>
<?php endif; ?>

                    <?php if (isset($component)) { $__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form-field','data' => ['type' => 'email','name' => 'email','label' => $contactGlobal->get('label_email'),'placeholder' => $contactGlobal->get('placeholder_email'),'required' => true,'autocomplete' => 'email']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'email','name' => 'email','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($contactGlobal->get('label_email')),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($contactGlobal->get('placeholder_email')),'required' => true,'autocomplete' => 'email']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d)): ?>
<?php $attributes = $__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d; ?>
<?php unset($__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d)): ?>
<?php $component = $__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d; ?>
<?php unset($__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d); ?>
<?php endif; ?>

                    <?php if (isset($component)) { $__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form-field','data' => ['type' => 'tel','name' => 'phone','label' => $contactGlobal->get('label_phone'),'placeholder' => $contactGlobal->get('placeholder_phone'),'required' => true,'autocomplete' => 'tel']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'tel','name' => 'phone','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($contactGlobal->get('label_phone')),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($contactGlobal->get('placeholder_phone')),'required' => true,'autocomplete' => 'tel']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d)): ?>
<?php $attributes = $__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d; ?>
<?php unset($__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d)): ?>
<?php $component = $__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d; ?>
<?php unset($__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d); ?>
<?php endif; ?>

                    <?php if (isset($component)) { $__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form-field','data' => ['type' => 'textarea','name' => 'message','label' => $contactGlobal->get('label_message'),'placeholder' => $contactGlobal->get('placeholder_message'),'required' => true,'rows' => 5]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'textarea','name' => 'message','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($contactGlobal->get('label_message')),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($contactGlobal->get('placeholder_message')),'required' => true,'rows' => 5]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d)): ?>
<?php $attributes = $__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d; ?>
<?php unset($__attributesOriginalf4c8ecf26ef77d4de25edf56eae3a34d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d)): ?>
<?php $component = $__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d; ?>
<?php unset($__componentOriginalf4c8ecf26ef77d4de25edf56eae3a34d); ?>
<?php endif; ?>

                    <button type="submit" class="contact-submit" data-contact-submit>
                        <?php echo e($contactGlobal->get('submit_label')); ?>

                    </button>
                </div>

                    <p class="contact-success hidden" data-contact-success><?php echo e($contactGlobal->get('success_message')); ?></p>
                </form>
            <?php endif; ?>
        </div>
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

<?php echo $__env->make('layouts.default', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/gaelpaquien/Documents/Lab/Perso/cairnweb/cairnweb-boilerplate/resources/views/pages/home.blade.php ENDPATH**/ ?>