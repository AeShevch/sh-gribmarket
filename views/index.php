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

mgSEO($data);
layout('categories');
?>
<script>
    document.addEventListener('DOMContentLoaded', function(){
        setTimeout(
            function () {

                var productsCarousel = new Swiper('.js-products-slider', {
                    slidesPerView: 4,
                    spaceBetween: 16,
                    loop: true,
                    autoplay: {
                        // Скорость
                        delay: 3000,
                        // Отключать автопереключение при взаимодействие со слайдером
                        disableOnInteraction: 'true',
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    pagination: {
                        el: '.js-products-slider-pagination',
                        clickable: true,
                    },
                });

            }
        ), 100
    }, false);
</script>
<?php if (MG::getSetting('mainPageIsCatalog') == 'true'): ?>
    <?php
// Если есть новинки
    if (!empty($data['newProducts'])): ?>

        <section class="products-carousel">
            <h2 class="products-carousel__title">
                <a class="products-carousel__link"
                   href="<?php echo SITE; ?>/group?type=latest">Новинки</a>
            </h2>
            <div class="products-carousel__inner js-products-slider">
                <div class="swiper-wrapper">
                    <?php
                    //Выводим товары из массива новинок
                    foreach ($data['newProducts'] as $item) {
                        $data['item'] = $item;
                        //подставляем вёрстку из файла /layout_mini_product.php
                        layout('mini_product', $data);
                    } ?>
                </div>
                <!-- Add Pagination -->
                <div class="js-products-slider-pagination"></div>
            </div>
        </section>

    <?php endif; ?>

    <?php
// Если есть рекомендуемые
    if (!empty($data['recommendProducts'])): ?>
        <section class="products-carousel">
            <h2 class="products-carousel__title">
                <a class="products-carousel__link"
                   href="<?php echo SITE; ?>/group?type=recommend">Рекомендуем</a>
            </h2>
            <div class="products-carousel__inner js-products-slider">
                <div class="swiper-wrapper">
                <?php
                //Выводим товары из массива рекомендуемых
                foreach ($data['recommendProducts'] as $item) {
                    $data['item'] = $item;
                    //подставляем вёрстку из файла /layout_mini_product.php
                    layout('mini_product', $data);
                } ?>
                </div>
            </div>
            <!-- Add Pagination -->
            <div class="js-products-slider-pagination"></div>

        </section>

    <?php endif; ?>

    <?php
// Если есть товары со старой ценой
    if (!empty($data['saleProducts'])): ?>
        <section class="products-carousel">
            <h2 class="products-carousel__title">
                <a class="products-carousel__link"
                   href="<?php echo SITE; ?>/group?type=sale">Распродажа</a>
            </h2>
            <div class="products-carousel__inner js-products-slider">
                <div class="swiper-wrapper">
                <?php
                //Выводим товары из массива товаров со скидкой
                foreach ($data['saleProducts'] as $item) {
                    $data['item'] = $item;
                    //подставляем вёрстку из файла /layout_mini_product.php
                    layout('mini_product', $data);
                } ?>
                </div>
            </div>
            <!-- Add Pagination -->
            <div class="js-products-slider-pagination"></div>

        </section>
    <?php endif; ?>
<?php endif; ?>



<?php //Контент главной страницы, прописанный для неё в разделе "Страницы" в панели администратора ?>
<div>
    <?php echo $data['cat_desc'] ?>
</div>