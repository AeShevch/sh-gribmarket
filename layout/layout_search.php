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

<div class="search">
     <form method="get"
           class="search__form"
           action="<?php echo SITE?>/catalog">
         <input type="text"
                autocomplete="off"
                name="search"
                class="search__input"
                placeholder="Что ищем?">
         <input type="submit"
                class="search__btn"
                value="Найти">

         <div class="fastResult"></div>
     </form>


 </div>