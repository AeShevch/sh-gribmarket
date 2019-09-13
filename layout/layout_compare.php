<?php
    /**
     * В данном файле находится вёрстка блока с информацией о сравнении.
     * Вёрстка самой страницы сравнения находится в файле /views/compare.php
     */
?>
<?php
    /**
     * Функция mgMeta подключит указанныые вами скрипты и стили.
     * Такую конструкцию вы можете указать в любом месте шаблона,
     *  при этом подключенный файл добавится в тег head (Там где прописана функция mgMeta)
     */
    mgAddMeta('<script src="'.PATH_SITE_TEMPLATE.'/js/layout.compare.js"></script>'); ?>


<!-- Класс mg-compare-count необходим для обновления количества при добавлении нового товара в сравнение -->
<a href="<?php echo SITE ?>/compare">
    Сравнить (
    <span class="mg-compare-count">
        <?php
            /**
             * Данная конструкция вёрнёт количество товаров в сравнении
             */
            if (isset($_SESSION['compareCount'])) {
                echo $_SESSION['compareCount'];
            } else {
                echo 0;
            } ?>
    </span>
    )
</a>


<?php
    /**
     *  Информер о добавлении товара в сравнение и демо стили для него
     *  Js-скрипт, показывающий его, находится в файле /шаблон/js/layout.compare.js
     */
?>
<div class="compare-informer" style="display: none;">
    Добавлено в сравнение
</div>
