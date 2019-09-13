<?php /*
Template Name: Blank
Author: Shevchenko
Version: 1.0.4
*/
    /**
     *   Файл template.php является каркасом шаблона, содержит основную верстку шаблона.
     *   Это ОБЯЗАТЕЛЬНЫЙ файл для любого шаблона
     *
     *   Подробнее о том, как устроены шаблоны - http://wiki.moguta.ru/devhelp/templates/kak-ustroeny-shablony
     *
     *
     *   Получить подробную информацию о доступных данных в массиве $data, можно вставив следующую строку кода в верстку файла.
     *    <?php viewData($data); ?>
     *
     *   Также доступны вставки, для вывода верстки из папки layout
     *
     *   <?php layout('cart'); ?>      // корзина
     *   <?php layout('auth'); ?>      // личный кабинет
     *   <?php layout('widget'); ?>    // виджиеы и коды счетчиков
     *   <?php layout('compare'); ?>   // информер товаров для сравнения
     *   <?php layout('content'); ?>   // содержание открытой страницы
     *   <?php layout('leftmenu'); ?>  // левое меню с категориями
     *   <?php layout('topmenu'); ?>   // верхнее горизонтаьное меню
     *   <?php layout('contacts'); ?>  // контакты в шапке
     *   <?php layout('search'); ?>    // форма для поиска
     *   <?php layout('content'); ?>   // вывод контента сгенерированного движком
     *
     *
     *   !!! Если указанного файла в папке layout шаблона нет, то будет использован файл из папки /mg-core/layout
     *   Подронее о том, как вставить layout в шаблон - http://wiki.moguta.ru/devhelp/templates/vstavki-komponentov-shablona-v-template-php
     *
     */
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <?php
        /**
         *  Функция mgMeta выведет на страницу данные в зависимости от указнного аргумента.
         *  Доступные аргументы  mgMeta:
         *  meta - выведет метатеги для данной страницы: title, description, keywords, метатеги OpenGraph и DublinCore,
         *         а также теги canonical, rel="prev/next" и favicon сайта.
         *  CSS - подключит стили включенных плагинов, обязательный файл стилей шаблона style.css, также все файлы стилей, которые были подключены в шаблоне с помощью функции mgAddMeta.
         *  jquery - подключит библиотеку Jquery из папки mg-core/script. Если вы хотите использовать свою версию Jquery или неиспользовать его вообще, то просто не указывайте этот аргумент.
         *  js - подключит файлы JS-скриптов плагинов, а также все js-скрипты, которые были подключены в шаблоне с помощью функции mgAddMeta (обычно вставляется отдельно, перед закрывающем /body).
         */
        mgMeta("meta", "css", "jquery"); ?>


    <?php
        /**
         * Функция mgAddMeta подключит указанныые вами скрипты и стили.
         * Такую конструкцию вы можете указать в любом месте шаблона,
         *  при этом подключенный файл добавится в тег head (Там где прописана функция mgMeta)
         */
    ?>
    <?php mgAddMeta('<script src="'.PATH_SITE_TEMPLATE.'/js/script.js"></script>'); ?>
    <?php
        /**
         *   Для указания адреса вы можете использовать готовые константы:
         *   PATH_TEMPLATE — путь относительно корня сайта к папке используемого щаблона mg-templates/mytempl;
         *   PATH_SITE_TEMPLATE — http ссылка на папку используемого щаблона (http://localhost/testsite/mg-templates/mytempl);
         *   SITE - http ссылка на главную страницу (http://localhost/testsite);
         *   SCRIPT —  ссылка на папку /mg-core/script/
         *   SITE_DIR — путь к корневой папке сайта /var/www/html/;
         *   CORE_DIR — путь относительно корня сайта к папке ядра mg-core/;
         *   CORE_LIB — путь относительно корня сайта к папке библиотек mg-core/lib/;
         *   CORE_JS — путь относительно корня сайта к папке скриптов mg-core/script/;
         *   ADMIN_DIR — путь относительно корня сайта к папке админки mg-admin/;
         *   PLUGIN_DIR — путь относительно корня сайта к папке с плагинами mg-plugins/;
         *   PAGE_DIR — путь относительно корня сайта к папке пользовательских скриптов mg-pages/;
         *
         * Подробнее: http://wiki.moguta.ru/devhelp/templates/direktivy-dvijka
         */
    ?>

</head>
<?php
    /**
     *  Функция MG::addBodyClass добавляет класс текущего контроллера с определенным префиксом или без
     *  Функция backgroundSite добавить style="background: url(..) no-repeat fixed center center /100% auto #fff;" с адресом картинки, указзанной фоном сайта в админке
     */
?>
<body class="<?php MG::addBodyClass('l-'); ?>" <?php backgroundSite(); ?>>
<header>
    <?php
        /**
         * Функция layout() подключает в заданное место HTML кода шаблона дополнительный
         * файл "layout" из папки mg-template/mytempl/layouts/,
         * а если такой отсутствует в пользовательском шаблоне, то из папки ядра mg-core/layouts/.
         * Подробнее о вставке компонентов - http://wiki.moguta.ru/devhelp/templates/vstavki-komponentov-shablona-v-template-php
         */
    ?>
    <?php layout('topmenu'); ?>
    <div class="logo">
        <?php
            /**
             * Функция mgLogo() вставляет на страницу логотип, заданный в настройках движка
             */
            echo mgLogo(); ?>
    </div>

    <div class="language_select">
        <?php layout('language_select'); ?>
    </div>

    <div class="currency_select">
        <?php layout('currency_select'); ?>
    </div>
    <?php layout('contacts'); ?>
    <?php
        /**
         * Вставляем только если редакция движка Маркет или Гипермаркет
         */
        if ((EDITION == "market") || (EDITION == "gipermarket")) { ?>
            <div class="demo-compare">
                <?php
                    /**
                     * MG::getSetting выводит значения указанные в настройках магазина.
                     * Значение указываемое аргументом этой функции соответствует заданному в таблице mg-setting имени настройки
                     *
                     * В данном случае мы проверяем включена ли в настройках опция "Включить возможность сравнивать товары"
                     * Подробнее - http://wiki.moguta.ru/help/Libraries/MG.html#getSetting
                     */
                    if (MG::getSetting('printCompareButton') == 'true') { ?>
                        <?php
                        layout('compare'); ?>
                    <?php } ?>
            </div>
        <?php } ?>
    <div class="auth">
        <?php layout('auth'); ?>
    </div>
    <?php layout('cart'); ?>

</header>
<?php layout('search'); ?>

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
                mgAddMeta('<link type="text/css" href="'.SCRIPT.'standard/css/jquery.ui.slider.css" rel="stylesheet"/>');
                mgAddMeta('<script src="'.SCRIPT.'standard/js/filter.js"></script>');
                echo MG::get('catalogfilter');
            ?>
            <?php layout('leftmenu'); ?>
        </aside>

    <?php endif; ?>

<main>
    <?php
        /**
         *
         * Функция URL::isSection проверяет является ли полученное значение - именем текущего раздела.
         * В данном случае URL::isSection('null') вернёт true на главной странице.
         * Подробнее о том, как выводить контент на определённой странице - http://wiki.moguta.ru/faq/rabota-s-produktom/kak-vyvodit-kontent-tolko-na-zadannoy-stranitse
         */
        if (URL::isSection(null)): ?>
            <?php
            /**
             * С помощью функции class_exists проверяем включен ли плагин, и если да, то выводим его шорткод.
             * Класс плагина можно посмотреть в файле index.php, находящемся в папке плагина.
             * Шорткод можно посмотреть в описании нужного плагина в панели управления /mg-admin
             */
            if (class_exists('SliderAction')): ?>
                [slider-action]
            <?php endif; ?>
        <?php endif; ?>

    <?php
        /**
         * Подключает плагин хлебных крошек, если он включен и если мы на странице каталога или товара
         */
        if ((class_exists('BreadCrumbs')) && ((MG::get('controller') == "controllers_catalog") || (MG::get('controller') == "controllers_product")) ): ?>
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


    <?php
        /**
         * Выводит копирайт Moguta.CMS, если включена соответствующая опция в панели администратора.
         * Наличие копирайта ОБЯЗАТЕЛЬНО для редакции Витрина.
         */
        copyrightMoguta(); ?>
</footer>


<?php
    /**
     *  mgMeta("js") - подключит файлы JS-скриптов плагинов, а также все js-скрипты, которые были подключены в шаблоне с помощью функции mgAddMeta (обычно вставляется отдельно, перед закрывающем /body)
     */
    mgMeta("js"); ?>


</body>

</html>