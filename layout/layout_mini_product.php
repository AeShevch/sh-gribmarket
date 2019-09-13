<?php
    /**
     * В данном файле содержится вёрстка миникарточки товара
     *
     * Получить подробную информацию о доступных на странице данных,
     *  можно вставив следующую строку кода в верстку файла:
     *  <?php viewData($data); ?>
     */
?>
<div class="product-wrapper">
    <div class="product-image">
        <?php
            /**
             * Если товар новинка или рекомендованный, вставляем соответствующий стикер
             */
            echo $data['item']['recommend'] ? '<span class="sticker-recommend">Хит!</span>' : '';
            echo $data['item']['new'] ? '<span class="sticker-new">Новинка!</span>' : '';
        ?>
        <a href="<?php echo SITE ?>/<?php echo isset($data['item']["category_url"]) ? $data['item']["category_url"] : 'catalog' ?><?php echo htmlspecialchars($data['item']["product_url"]) ?>">
            <?php
                /*
                 * Возвращает правильно сформированную картинку для продукта в HTML.
                 * Со всеми параметрами, для эффекта перелета в корзину.
                 * Параметр MIN указывает, что будет использована самая маленькая миниатюра.
                 * Также возможны:
                 * MID - большая миниатюра
                 * MAX - оригиниальное изображение
                 *
                 * Размеры генерируемых миниатюр можно настроить в разделе Настройки - Магазин - Изображения
                 *
                 * Подробнее у функции mgImageProduct() - http://wiki.moguta.ru/devhelp/manual#mgImageProduct
                 */
                echo mgImageProduct($data['item'], false, 'MIN', false); ?>
        </a>
    </div>

    <!--  Название товара  -->
    <div class="product-name">
        <a href="<?php echo SITE ?>/<?php echo isset($data['item']["category_url"]) ? $data['item']["category_url"] : 'catalog' ?><?php echo htmlspecialchars($data['item']["product_url"]) ?>"><?php echo $data['item']["title"] ?></a>
    </div>

    <!--  Описание товара  -->
    <span>
        <?php
            // Если у товара задано краткое описание, выводим его
            if ($data['item']["short_description"]) {
                /*
                 *  Функция MG::textMore отрезает часть строки дополняя ее многоточием.
                 *  Вторым параметром указывается количество символов.
                 *
                 *  Подробнее - http://wiki.moguta.ru/help/Libraries/MG.html#textMore
                 *
                 */
                echo MG::textMore($data['item']["short_description"], 80);
            } else {
                // Если нет, выводим полное описание
                echo MG::textMore($data['item']["description"], 80);
            }
        ?>
    </span>

    <div class="product-price">
        <?php
            /**
             * Переводит из числового формат в ценовой
             */
            echo priceFormat($data['item']["price"]) ?><?php echo $data['currency']; ?>
    </div>
    <?php
        /**
         * С помощью функции class_exists проверяем включен ли плагин, и если да, то выводим его шорткод.
         * Класс плагина можно посмотреть в файле index.php, находящемся в папке плагина.
         * Шорткод можно посмотреть в описании нужного плагина в панели управления /mg-admin
         */
        if (class_exists('Rating')): ?>
            <div class="product-rating">
                [rating id = "<?php echo($data['item'] ['id']) ?>"]
            </div>
        <?php endif; ?>

    <?php
        /*
         * Выводим характеристики товара, если разрешено в настройках
         * "Настройки" - "Магазин" - "Опции сайта" - "Товары" - "Формировать список характеристик для миникарточек каталога"
         *
         * */

        if (MG::getSetting('catalogProp') == 1) {

            $strProp['unGroupProperty'] = $data['item']['thisUserFields'];
            $strProp['unGroupProperty'] = array_map(function ($prop) {
                return array(
                    'name_prop' => $prop['name'],
                    'name' => $prop['value']
                );
            }, $strProp['unGroupProperty']);

            layout('prop_string', $strProp);

        }
    ?>

    <form action="<?php echo SITE ?>/catalog" method="POST" class="property-form actionBuy"
          data-product-id="<?php echo($data['item'] ['id']) ?>">

        <?php
            /*
             * Выводим выбор количества товаров, если разрешено в настройках
             * "Настройки" - "Магазин" - "Опции сайта" - "Товары" - "Показывать поле для ввода количества товара в миникарточках"
             *
             * Все имеющеся классы наобходимы для работы стандартного js-скрипта
             * */
            if (MG::getSetting('printQuantityInMini') == 'true'):?>
                <div class="cart_form">
                    <div class="amount_change">
                        <a href="#" class="down">
                            <
                        </a>
                        <input type="text" class="amount_input" name="amount_input"
                               data-max-count="<?php echo $data['maxCount'] ?>" value="1"/>
                        <a href="#" class="up">
                            >
                        </a>
                    </div>
                </div>
            <?php endif; ?>

        <?php
            /*
             * Выводим варианты/размеры-цвета товаров из файла /layout/layout_variant.php
             * Передаём в него массив с вариантами
             *  Выводим только если включена опция:
             *  Настройки - "Магазин" - "Опции сайта" - "Товары" - "Показывать варианты товара в миникарточке"
             * */
            if (MG::getSetting('printVariantsInMini') == 'true') {
                $item['blockVariants'] = $data['item']['variants'];
                layout('variant', $item);
            }
        ?>

        <div>
            <?php
                /**
                 * Если количество товара 0, показываем кнопку "Подробнее", если нет, то "В корзину"
                 */
                if ($data['item']['count'] != 0) {
                    /**
                     * Кнопка "Купить"/"Подробнее" из файла /layout/layout_btn_buy.php
                     */
                    layout('btn_buy', $data['item']);
                } else {
                    layout('btn_more', $data['item']);
                }
            ?>
            <?php
                /**
                 * Кнопка "Добавить в сравнение" из файла /layout/layout_btn_compare.php
                 * Вставляем только если редакция движка Маркет или Гипермаркет
                 */
                if ((EDITION == "market") || (EDITION == "gipermarket")) {
                    layout('btn_compare', $data['item']);
                }
            ?>

        </div>
    </form>

</div>