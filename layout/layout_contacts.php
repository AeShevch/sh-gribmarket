<?php
    /**
     *   В данном файле содержится вёрстка блока контактов (Не страницы).
     *   Получить подробную информацию о доступных данных в массиве $data, можно вставив следующую строку кода в верстку файла.
     *   <?php viewData($data); ?>
     */
?>

<?php
    /**
     * MG::getSetting выводит значения указанные в настройках магазина.
     * Значение указываемое аргументом этой функции соответствует заданному в таблице mg-setting имени настройки
     *
     */
?>
<div class="demo-contacts">
    Название сайта - <?php echo MG::getSetting('sitename') ?><br>

    Время работы:
    <?php
        /**
         * Выводим время работы из настроек
         */
        $workTime = explode(',', MG::getSetting('timeWork'));
    ?>
    Пн-Пт - <?php echo trim($workTime[0]); ?> <br>
    Сб-Вс - <?php echo trim($workTime[0]); ?> <br>

    <?php
        /**
         * Выводим телефоны магазина из настроек
         */
        $phones = explode(', ', MG::getSetting('shopPhone'));
    ?>
    Телефон - <?php foreach ($phones as $phone) {
        echo $phone;
    } ?>

    <br>
    Адрес: <?php echo MG::getSetting('shopAddress'); ?>
</div>

