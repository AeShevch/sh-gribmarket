<?php
/**
 * В данном файле находится вёрстка поиска
 *
 * Получить подробную информацию о доступных данных в массиве $data, можно вставив следующую строку кода в верстку файла:
 *  <?php viewData($data); ?>
 */
?>


<?php
/**
 * Функция mgMeta подключит указанныые вами скрипты и стили.
 * Такую конструкцию вы можете указать в любом месте шаблона,
 *  при этом подключенный файл добавится в тег head (Там где прописана функция mgMeta)
 *
 */
mgAddMeta('<script src="'.SCRIPT.'standard/js/layout.search.js"></script>'); ?>

<div class="search-block">
     <form method="get" class="search-form" action="<?php echo SITE?>/catalog">
         <input type="text" autocomplete="off" name="search" class="search-field" value="Искать товар" onfocus="if (this.value == 'Искать товар') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Искать товар';}">
         <input type="submit" class="search-button" value="Найти">
     </form>

    <?php
    /**
     * Быстрые результаты поиска подставляются js-скриптом mg-core/script/standard/js/layout.search.js
     * При желании его можно отключить, убрав его подключение выше
     */
    ?>
     <div class="fastResult">

     </div>
 </div>