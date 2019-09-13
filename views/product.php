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
<div class="product-details-block">
    <?php
        /**
         * Возвращает готовую верстку картинок товара
         * Использует 'layout_images.php' текущего шаблона.
         */
        mgGalleryProduct($data); ?>

    <div class="product-status">
        <h1 class="product-title"><?php echo $data['title'] ?></h1>

        <?php
            if (class_exists('Rating')): ?>
                <div class="product-rating">
                    [rating id = "<?php echo($data ['id']) ?>"]
                </div>
            <?php endif; ?>

        <div class="buy-block">
            <ul class="product-status-list">
                <!--если не установлен параметр - старая цена, то не выводим его-->
                <li <?php echo (!$data['old_price']) ? 'style="display:none"' : 'style="display:block"' ?>>
                    Старая цена:
                    <span class="old-price">
                        <?php echo $data['old_price']." ".$data['currency']; ?>
                    </span>
                </li>
                <li>Цена:
                    <span class="price">
                        <?php
                            echo priceFormat($data['price']) ?><?php echo $data['currency']; ?>
                    </span>
                </li>
                <li>
                    <?php if ($data['count'] == 'много' || $data['count'] == -1) : ?>
                        <span class="in-stock">
						&#10004; Есть в наличии
					</span>
                    <?php else: ?>
                        Остаток:
                        <span class="label-black count"><?php echo $data['count'].' '.$data['category_unit']; ?></span> <?php echo $data['remInfo'] ?>
                    <?php endif; ?>
                </li>
                <li <?php echo (!$data['weight']) ? 'style="display:none"' : 'style="display:block"' ?>>Вес: <span
                            class="label-black weight"><?php echo $data['weight'] ?></span> кг.
                </li>
                <li>Артикул: <span class="label-article code"><?php echo $data['code'] ?></span></li>
                <?php
                /* Вставляем дополнительные поля товара
                из файла layout/layout_op_product_fields.php */
                layout('op_product_fields', $data); ?>
            </ul>


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

    <!--    Вкладки с информацией о товаре -->
    <div class="prod-tabs">
        <ul>
            <li><a href="#tab1">Описание</a></li>
            <?php if (!empty($data['stringsProperties'])): ?>
                <li><a href="#tab_property">Характеристики</a></li>
            <?php endif; ?>
            <?php if (class_exists('mgTreelikeComments')): ?>
                <li><a href="#tree-comments">Отзывы</a></li>
            <?php endif; ?>
            <?php if (class_exists('CommentsToMoguta')): ?>
                <li><a href="#comments-mg">Отзывы</a></li>
            <?php endif; ?>
            <?php foreach ($data['thisUserFields'] as $key => $value) {
                if ($value['type'] == 'textarea' && $value['value']) { ?>
                    <li><a href="#tab<?php echo $key ?>"><?php echo $value['name'] ?></a></li>
                <?php }
            } ?>
        </ul>
        <!--   Содержимое вкладок     -->
        <div class="product-tabs-container">
            <div id="tab1" itemprop="description"><?php echo $data['description'] ?></div>
            <?php if (!empty($data['stringsProperties'])): ?>
                <div id="tab_property"><?php layout('property', $data); ?></div>
            <?php endif; ?>
            <?php if (class_exists('mgTreelikeComments')): ?>
                <div id="tree-comments" itemscope itemtype="http://schema.org/Review">
                    [mg-treelike-comments type="product"]
                </div>
            <?php endif; ?>

            <?php if (class_exists('CommentsToMoguta')): ?>
                <div id="comments-mg" itemscope itemtype="http://schema.org/Review">
                    [comments]
                </div>
            <?php endif; ?>

            <?php foreach ($data['thisUserFields'] as $key => $value) {
                if ($value['type'] == 'textarea') { ?>
                    <div id="tab<?php echo $key ?>"
                         itemscope><?php echo preg_replace('/\<br(\s*)?\/?\>/i', "\n", $value['value']) ?></div>
                <?php }

            } ?>
        </div>
    </div>
    <?php
        /**
         * Выводит блок "С этим товаром покупают из файла layout_related.php"
         */
        echo $data['related'] ?>

</div>

 

