<header class="header">
    <div class="header__top ">
        <?php layout('topmenu'); ?>

        <!--  Обратный звонок  -->

        <?php layout('cart'); ?>
    </div>
    <div class="header__center">
        <?php echo mgLogo(); ?>

        <?php layout('search'); ?>

        <!--   Лого сантанта     -->
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

</header>