<?php
    /**
     *  Файл представления Index - выводит сгенерированную движком информацию на главной странице магазина.
     *  В этом файле доступны следующие данные:
     *
     *    $data['recommendProducts'] => Массив рекомендуемых товаров
     *    $data['newProducts'] => Массив товаров новинок
     *    $data['saleProducts'] => Массив товаров распродажи
     *    $data['titeCategory'] => Название категории
     *    $data['cat_desc'] => Описание категории
     *    $data['meta_title'] => Значение meta тега для страницы
     *    $data['meta_keywords'] => Значение meta_keywords тега для страницы
     *    $data['meta_desc'] => Значение meta_desc тега для страницы
     *    $data['currency'] => Текущая валюта магазина
     *    $data['actionButton'] => тип кнопки в миникарточке товара
     *
     *
     *   Получить подробную информацию о каждом элементе массива $data, можно вставив следующую строку кода в верстку файла.
     *
     *   <?php viewData($data['saleProducts']); ?>
     *
     *   Вывести содержание элементов массива $data, можно вставив следующую строку кода в верстку файла.
     *
     *    <?php echo $data['saleProducts']; ?>
     *
     */


    //НЕ УБИРАТЬ! Выводить метатеги страницы, заданные в панели управления.
    mgSEO($data);
?>

<?php mgAddMeta('<script src="'.SCRIPT.'jquery.bxslider.min.js"></script>'); ?>

<script>
    $(document).ready(function () {
        // Слайдер товаров на главной странице
        $('.m-p-products-slider-start').bxSlider({
            minSlides: 4,
            maxSlides: 4,
            slideWidth: 222,
            slideMargin: 15,
            moveSlides: 1,
            pager: false,
            auto: false,
            pause: 6000,
            useCSS: false
        });
    });
</script>
<!-- Проверка опции "Показывать на главной странице товары из групп «Новинки», «Рекомендуемые», «Распродажа»" -->
<?php if(MG::getSetting('mainPageIsCatalog') == 'true'): ?>
    <?php
        // Если есть новинки
        if (!empty($data['newProducts'])): ?>

            <div class="m-p-products">
                <h2 class="m-p-new-products-title">
                    <a href="<?php echo SITE; ?>/group?type=latest">Новинки</a>
                </h2>
                <div class="m-p-products-slider">
                    <div class="m-p-products-slider-start">
                        <?php
                            //Выводим товары из массива новинок
                            foreach ($data['newProducts'] as $item) {
                                $data['item'] = $item;
                                //подставляем вёрстку из файла /layout_mini_product.php
                                layout('mini_product', $data);
                            } ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    <?php
        // Если есть рекомендуемые
        if (!empty($data['recommendProducts'])): ?>
            <div class="m-p-recommended-products m-p-products">
                <h2 class="m-p-recommended-products-title">
                    <a href="<?php echo SITE; ?>/group?type=recommend">Рекомендуемые товары</a></h2>
                <div class="m-p-products-slider">
                    <div class="m-p-products-slider-start">
                        <?php
                            //Выводим товары из массива рекомендуемых
                            foreach ($data['recommendProducts'] as $item) {
                                $data['item'] = $item;
                                //подставляем вёрстку из файла /layout_mini_product.php
                                layout('mini_product', $data);
                            } ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    <?php
        // Если есть товары со старой ценой
        if (!empty($data['saleProducts'])): ?>
            <div class="m-p-products">
                <h2 class="m-p-sale-products-title">
                    <a href="<?php echo SITE; ?>/group?type=sale">Распродажа</a>
                </h2>
                <div class="m-p-products-slider">
                    <div class="m-p-products-slider-start">
                        <?php
                            //Выводим товары из массива товаров со скидкой
                            foreach ($data['saleProducts'] as $item) {
                                $data['item'] = $item;
                                //подставляем вёрстку из файла /layout_mini_product.php
                                layout('mini_product', $data);
                            } ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
<?php endif; ?>

<?php //Контент главной страницы, прописанный для неё в разделе "Страницы" в панели администратора ?>
<div>
    <?php echo $data['cat_desc'] ?>
</div>