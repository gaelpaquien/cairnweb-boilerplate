<?php
    $g = \Statamic\Facades\GlobalSet::findByHandle('contact')?->inCurrentSite();
?>
<?php echo e($g?->get('email_intro_text')); ?>

============================================

<?php echo e($g?->get('label_firstname')); ?> : <?php echo $data['first_name']; ?>

<?php echo e($g?->get('label_lastname')); ?> : <?php echo $data['last_name']; ?>

<?php echo e($g?->get('label_email')); ?> : <?php echo $data['email']; ?>

<?php if(!empty($data['phone'])): ?>
<?php echo e($g?->get('label_phone')); ?> : <?php echo $data['phone']; ?>

<?php endif; ?>

<?php echo e($g?->get('label_message')); ?> :
<?php echo $data['message']; ?>

<?php /**PATH /Users/gaelpaquien/Documents/Lab/Perso/cairnweb/cairnweb-boilerplate/resources/views/emails/contact.blade.php ENDPATH**/ ?>