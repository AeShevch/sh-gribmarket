<?php /*
Template Name: sh-gribmarket
Author: Shevchenko
Version: 1.0.0*/
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?php mgMeta("meta", "css", "jquery"); ?>
    <script src="<?php echo PATH_SITE_TEMPLATE . '/js/bundle.js'?>"></script>
</head>
<body  class="<?php MG::addBodyClass('l-'); ?>" <?php backgroundSite(); ?>>

<?php layout('svg'); ?>

<?php layout('header'); ?>

<?php if (URL::isSection(null)): ?>
    <?php if (class_exists('Slider')): ?>
        [mg-slider id='1']
    <?php endif; ?>
<?php endif; ?>

<div class="main__wrap">
    <?php if ((MG::get('controller') == "controllers_catalog") || (MG::get('controller') == "controllers_product")): ?>
        <aside>
            <?php layout('leftmenu'); ?>
            <div class="c-filter">
                <?php
                mgAddMeta('<link type="text/css" href="' . SCRIPT . 'standard/css/jquery.ui.slider.css" rel="stylesheet"/>');
                mgAddMeta('<script src="' . SCRIPT . 'standard/js/filter.js"></script>');
                echo MG::get('catalogfilter');
                ?>
            </div>
        </aside>

    <?php endif; ?>

    <main class="main">

        <?php if ((class_exists('BreadCrumbs')) && ((MG::get('controller') == "controllers_catalog") || (MG::get('controller') == "controllers_product"))): ?>
            [brcr]
        <?php endif; ?>

        <?php layout('content'); ?>
    </main>
</div>


<?php layout('footer'); ?>

<?php layout('widget'); ?>

<?php mgMeta("js"); ?>


</body>
</html>


