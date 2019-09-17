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

<section class="represent">
    <?php
    $shopsRus = [
        [
            "city" => "Крым",
            "phone" => "+7 (978) 855-75-59",
            "contact" => "Березовская Кира Георгиевна"
        ],
        [
            "city" => "Таганрог",
            "phone" => "+7 (908) 186-06-00",
            "contact" => "Вербицкий Дмитрий Александрович"
        ],
        [
            "city" => "Новосибирск",
            "phone" => "+7 (913) 006-32-24",
            "contact" => "Столбова Наталья Михайловна"
        ]
    ]
    ?>
    <h2 class="represent__title">Представители ООО ПКП «САНТАНА»</h2>
    <h3 class="represent__subtitle">Российская Федерация</h3>
    <div class="represent__inner">
        <?php
        foreach ($shopsRus as $shop) { ?>
            <div class="represent__item represent-item">
                <div class="represent-item__left">
                    <span class="represent-item__city">
                        <?php echo $shop['city']; ?>
                    </span>
                    <span class="represent-item__tel">
                        <?php echo $shop['phone']; ?>
                    </span>
                </div>
                <div class="represent-item__right">
                    <span class="represent-item__contacts represent-item__contacts_title">
                        Контактное лицо:
                    </span>
                    <span class="represent-item__contacts">
                        <?php echo $shop['contact']; ?>
                    </span>
                </div>
            </div>
        <?php }
        ?>
    </div>
    <?php
    $shopsForeign = [
        [
            "city" => "Казахстан. Алматы",
            "phone" => "+7 (701) 746-24-49",
            "contact" => "Шабанов Гаджибек Рамазанович"
        ],
        [
            "city" => "Грузия. Тбилиси",
            "phone" => "+7 10 (995) 593 753355",
            "contact" => "Georgian Argo Product. Роман"
        ]
    ]
    ?>

    <h3 class="represent__subtitle">Страны ближнего и дальнего зарубежья</h3>
    <div class="represent__inner">
        <?php
        foreach ($shopsRus as $shop) { ?>
            <div class="represent__item represent-item">
                <div class="represent-item__left">
                    <span class="represent-item__city">
                        <?php echo $shop['city']; ?>
                    </span>
                    <span class="represent-item__tel">
                        <?php echo $shop['phone']; ?>
                    </span>
                </div>
                <div class="represent-item__right">
                    <span class="represent-item__contacts represent-item__contacts_title">
                        Контактное лицо:
                    </span>
                    <span class="represent-item__contacts">
                        <?php echo $shop['contact']; ?>
                    </span>
                </div>
            </div>
        <?php }
        ?>
    </div>
</section>



<?php //Контент главной страницы, прописанный для неё в разделе "Страницы" в панели администратора ?>
<div>
    <?php echo $data['cat_desc'] ?>
</div>