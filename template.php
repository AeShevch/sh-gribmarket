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

<?php
/**
 * Выводим сайдбар только в каталоге и на странице товара
 * Подробнее о том, как выводить контент на определённой странице - http://wiki.moguta.ru/faq/rabota-s-produktom/kak-vyvodit-kontent-tolko-na-zadannoy-stranitse
 */
if ((MG::get('controller') == "controllers_catalog") || (MG::get('controller') == "controllers_product")): ?>
    <aside>
        <?php
        /**
         * Функция MG::get('catalogfilter') выводит сформированную вёрстку фильтра товаров из файлов layout_filter.php и layout_prop_filter.php,
         * Для его работы из вдижка подключются файлы jquery.ui.slider.css и filter.js
         * Вы можете отключить их и использовать свои
         */
        mgAddMeta('<link type="text/css" href="' . SCRIPT . 'standard/css/jquery.ui.slider.css" rel="stylesheet"/>');
        mgAddMeta('<script src="' . SCRIPT . 'standard/js/filter.js"></script>');
        echo MG::get('catalogfilter');
        ?>
        <?php layout('leftmenu'); ?>
    </aside>

<?php endif; ?>

<main>
    <?php if (URL::isSection(null)): ?>
        <?php if (class_exists('Slider')): ?>
            [mg-slider id='1']
        <?php endif; ?>
    <?php endif; ?>

    <?php
    /**
     * Подключает плагин хлебных крошек, если он включен и если мы на странице каталога или товара
     */
    if ((class_exists('BreadCrumbs')) && ((MG::get('controller') == "controllers_catalog") || (MG::get('controller') == "controllers_product"))): ?>
        [brcr]
    <?php endif; ?>

    <?php
    /**
     * Конструкция layout('content') вставляет вёрстку из файла в папке views шаблона,
     * в соответствии со страницей, на которой вы находитесь.
     * Например, на странице каталога будет всталена вёрстка из файла /views/catalog.php
     */
    layout('content'); ?>
</main>


<footer>
    <?php
    /**
     * Возвращает ul список страниц, разделённый на две колонки
     */
    echo MG::get('pages')->getFooterPagesUl(0, 'public', false); ?>

    <ul class="footer-column">
        <?php
        /**
         * Возвращает ul список категорий (Только li, без самого ul)
         */
        echo MG::get('category')->getCategoryListUl(0, 'public', false); ?>
    </ul>
    <?php
    /**
     * Конструкция layout('widget') вставит контент,
     * прописанный пользователем в разделе Настроки - Настройки отображения сайта - Коды счетчиков и виджетов.
     */
    layout('widget'); ?>


<?php mgMeta("js"); ?>


</body>

</html>


