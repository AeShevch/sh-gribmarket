<?php
    /**
     *  Файл product.php содержит вёрстку страницы товара.
     *
     *  В этом файле доступны следующие данные:
     *   <code>
     *   $data['category_url'] => URL категории в которой находится продукт
     *   $data['product_url'] => Полный URL продукта
     *   $data['id'] => id продукта
     *   $data['sort'] => порядок сортировки в каталоге
     *   $data['cat_id'] => id категории
     *   $data['title'] => Наименование товара
     *   $data['description'] => Описание товара
     *   $data['price'] => Стоимость
     *   $data['url'] => URL продукта
     *   $data['image_url'] => Главная картинка товара
     *   $data['code'] => Артикул товара
     *   $data['count'] => Количество товара на складе
     *   $data['activity'] => Флаг активности товара
     *   $data['old_price'] => Старая цена товара
     *   $data['recommend'] => Флаг рекомендуемого товара
     *   $data['new'] => Флаг новинок
     *   $data['thisUserFields'] => Пользовательские характеристики товара
     *   $data['images_product'] => Все изображения товара
     *   $data['currency'] => Валюта магазина.
     *   $data['propertyForm'] => Форма для карточки товара
     *   $data['liteFormData'] => Упрощенная форма для карточки товара
     *   $data['meta_title'] => Значение meta тега для страницы,
     *   $data['meta_keywords'] => Значение meta_keywords тега для страницы,
     *   $data['meta_desc'] => Значение meta_desc тега для страницы
     *   </code>
     *
     *   Получить подробную информацию о каждом элементе массива $data, можно вставив следующую строку кода в верстку файла.
     *    <?php viewData($data); ?>
     *
     *
     *   <b>Внимание!</b> Файл предназначен только для форматированного вывода данных на страницу магазина. Категорически не рекомендуется выполнять в нем запросы к БД сайта или реализовывать сложую программную логику.
     *
     */
?>
<?php
    /**
     * Функция mgAddMeta подключит указанныые вами скрипты и стили.
     * Такую конструкцию вы можете указать в любом месте шаблона,
     * при этом подключенный файл добавится в тег head (Там где прописана функция mgMeta)
     *
     * Ниже подключаются стили и скрипт для блока "С этим товаров покупают".
     * Мы можете убрать их подключение и использовать свои
     * Вёрстка этого блока находится в файле /layout/layout_related.php/
     */
    mgAddMeta('<link href="'.SCRIPT.'standard/css/layout.related.css" rel="stylesheet" type="text/css" />');
    mgAddMeta('<script src="'.SCRIPT.'standard/js/layout.related.js"></script>');

    //НЕ УБИРАТЬ! Выводить метатеги страницы, заданные в панели управления.
    mgSEO($data);
?>
<section class="product-details-block product">
    <div class="product__inner">
        <div class="product__images">
            <?php
            /**
             * Возвращает готовую верстку картинок товара
             * Использует 'layout_images.php' текущего шаблона.
             */
            mgGalleryProduct($data); ?>
        </div>

        <div class="product__info product-main-info">
            <?php
            if (class_exists('Rating')): ?>
                <div class="product-rating product__rating">
                    [rating id = "<?php echo($data ['id']) ?>"]
                </div>
            <?php endif; ?>

            <h1 class="product-main-info__title"
                aria-label="Название товара">
                <?php echo $data['title'] ?>
            </h1>

            <div class="product-main-info__short-descr"
                 aria-label="Краткое описание товара">
                <?php echo $data['short_description']; ?>
            </div>

            <b class="product-main-info__availability"
                  aria-label="Наличие товара">
            <?php if ($data['count'] == 'много' || $data['count'] == -1) : ?>
                <span class="in-stock">
						&#10004; Есть в наличии
					</span>
            <?php else: ?>
                В наличии
                <span class="label-black count"><?php echo $data['count'].' '.$data['category_unit']; ?></span> <?php echo $data['remInfo'] ?>
            <?php endif; ?>
        </b>

            <span class="product-main-info__mark product-main-info__mark_code"
                  aria-label="Артикул товара">
                Артикул:
                <b>
                    <?php echo $data['code'] ?>
                </b>
            </span>

            <?php if (!empty($data['weight'])) { ?>
                <span class="product-main-info__mark product-main-info__mark_weight"
                      aria-label="Вес товара">
                    Вес:
                    <b>
                        <?php echo $data['weight'] ?> кг.
                    </b>
                </span>
            <?php } ?>

            <?php if (!empty($data['old_price'])) { ?>
                <span class="product-main-info__price product-main-info__price_old"
                      aria-label="Старая цена товара">
                <?php echo $data['old_price']." ".$data['currency']; ?>
            </span>
            <?php } ?>

            <b class="product-main-info__price"
                  aria-label="Цена товара">
                 <?php echo priceFormat($data['price']).' '.$data['currency']; ?>
            </b>

            <?php
            /* Вставляем дополнительные поля товара
            из файла layout/layout_op_product_fields.php */
            layout('op_product_fields', $data); ?>

            <div class="buy-block">
                <div class="wholesales-data">
                    <?php
                    /**
                     * Выводит оптовые цены из файла /layout/layout_wholesales_info.php
                     */
                    layout('wholesales_info', $data['wholesalesData']); ?>
                </div>

                <?php
                /**
                 * Выводит информацию о складах из файла  /layout/layout_storage_info.php
                 */
                layout('storage_info', $data); ?>

                <?php
                /**
                 * Выводит форму покупки товара из файла layout_property.
                 * Форма содержит кнопки Купить и Сравнить, варианты товара,
                 * характеристики "Набор для выбора" и "Чекбокс", размерно цветовую сетку, выбор количества товаров
                 */
                echo $data['propertyForm'] ?>
            </div>
        </div>
    </div>

    <script async src="<?php echo PATH_SITE_TEMPLATE ?>/src/js/tab-widget.js"></script>
    <div class="tab-widget js-tab-widget">

        <ul class="tab-widget__list">
            <li class="tab-widget__item">
                <a href="#tab-panel-1" class="tab-widget__link">Инструкция</a>
            </li>

            <?php if (!empty($data['stringsProperties'])): ?>
                <li class="tab-widget__item">
                    <a href="#tab-panel-2" class="tab-widget__link">Характеристики</a>
                </li>
            <?php endif; ?>

            <?php if (class_exists('CommentsToMoguta')): ?>
                <li class="tab-widget__item">
                    <a href="#comments-mg" class="tab-widget__link">Отзывы</a>
                </li>
            <?php endif; ?>
        </ul>

        <div class="tab-widget__tabs">

            <div class="tab-widget__tab-content tab-widget__tab-content_description">
                <h2 id="tab-panel-1" tabindex="-1">Инструкция «<?php echo $data['title'] ?>»</h2>
                <?php echo $data['description'] ?>
            </div>

            <?php if (!empty($data['stringsProperties'])): ?>
                <div class="tab-widget__tab-content">
                    <h2 id="tab-panel-2" tabindex="-1">Характеристики товара «<?php echo $data['title'] ?>»</h2>
                    <div id="tab_property"><?php layout('property', $data); ?></div>
                </div>
            <?php endif; ?>

            <?php if (class_exists('CommentsToMoguta')): ?>
                <div class="tab-widget__tab-content"
                     itemscope
                     itemtype="http://schema.org/Review">
                    <h2 id="comments-mg"
                        tabindex="-1">Отзывы о товаре «<?php echo $data['title'] ?>»</h2>
                    [comments]
                </div>
            <?php endif; ?>

        </div>
    </div>

    <?php
        /**
         * Выводит блок "С этим товаром покупают из файла layout_related.php"
         */
        echo $data['related'] ?>

</section>

 

