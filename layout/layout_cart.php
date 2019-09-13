<?php
/**
 * В данном файле находится вёрстка миникорзины, а также всплывающего блока,
 * показывающегося после нажатия на кнопку купить (Если это включино в настройках магазина)
 * Вёрстка страницы корзины (/cart) находится в файле /views/cart.php
 *
 * Получить подробную информацию о доступных данных в массиве $data, можно вставив следующую строку кода в верстку файла:
 *  <?php viewData($data); ?>
 */
?>


<?php
/**
 * Функция mgMeta подключит указанные вами скрипты и стили.
 * Такую конструкцию вы можете указать в любом месте шаблона,
 *  при этом подключенный файл добавится в тег head (Там где прописана функция mgMeta)
 */
mgAddMeta('<script src="' . PATH_SITE_TEMPLATE . '/js/layout.cart.js"></script>'); ?>

<?php
/**
 * MG::getSetting выводит значения указанные в настройках магазина.
 * Значение указываемое аргументом этой функции соответствует заданному в таблице mg-setting имени настройки
 * В данном случае мы проверяем включена ли в настройках опция "Показывать покупателю сообщение о добавлении товара в корзину"
 * Подробнее - http://wiki.moguta.ru/help/Libraries/MG.html#getSetting
 */
if (MG::getSetting('popupCart') == 'true') { ?>
    <?php
    /**
     * Стили для сообщения о добавлении в корзину в данном случае подключются из движка
     * Вы можете отключить их, удалив функцию mgAddMeta ниже и задать свои
     * Также все классы, указанные в этом файле, используются для работы JS скриптов,
     * необходимых для корректной работы корзины (/blanc/js/layout.cart.js).
     */
    mgAddMeta('<link type="text/css" href="' . SCRIPT . 'standard/css/layout.fake.cart.css" rel="stylesheet"/>'); ?>

    <div class="mg-layer" style="display: none"></div>
    <div class="mg-fake-cart" style="display: none;">
        <a class="mg-close-fake-cart mg-close-popup" href="javascript:void(0);"></a>
        <div class="popup-header">
            <h2>Корзина товаров</h2>
        </div>
        <div class="popup-body">
            <table class="small-cart-table">

                <?php
                /**
                 * Если корзина не пуста, заполняем её товарами
                 */
                if (!empty($data['cartData']['dataCart'])) {
                    foreach ($data['cartData']['dataCart'] as $item):?>
                        <tr>
                            <td class="small-cart-img">
                                <a href="<?php echo SITE . "/" . ($item['category_url'] ? $item['category_url'] : 'catalog') . "" . $item['product_url'] ?>">
                                    <img src="<?php echo $item["image_url_new"] ?>" alt="<?php echo $item['title'] ?>"/>
                                </a>
                            </td>
                            <td class="small-cart-name">
                                <ul class="small-cart-list">
                                    <li>
                                        <a href="<?php echo SITE . "/" . ($item['category_url'] ? $item['category_url'] : 'catalog') . "" . $item['product_url'] ?>"><?php echo $item['title'] ?></a>
                                        <span class="property"><?php echo $item['property_html'] ?> </span>
                                    </li>
                                    <li class="qty">
                                        x<?php echo $item['countInCart'] ?>
                                        <span><?php echo $item['priceInCart'] ?></span>
                                    </li>
                                </ul>
                            </td>
                            <td class="small-cart-remove">
                                <a href="#" class="deleteItemFromCart" title="Удалить"
                                   data-delete-item-id="<?php echo $item['id'] ?>"
                                   data-property="<?php echo $item['property'] ?>"
                                   data-variant="<?php echo $item['variantId'] ?>">&#215;</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                <?php } else { ?>

                <?php } ?>
            </table>
        </div>
        <ul class="total sum-list">
            <li class="total-sum">Общая сумма:
                <span><?php echo $data['cartData']['cart_price_wc'] ?></span>
            </li>
        </ul>
        <div class="popup-footer">
            <ul class="total">
                <li class="checkout-buttons">
                    <a role="button" href="javascript:void();" class="mg-close-popup">Продолжить покупки</a>
                    <a href="<?php echo SITE ?>/order" class="check-btn default-btn">Оформить</a>
                </li>
            </ul>
        </div>
    </div>
<?php }; ?>

<div class="cart">
    <div class="cart-inner">
        <ul class="cart-list">
            <li><h3 class="cart-title">Корзина:</h3></li>
            <li class="cart-qty">
                <span class="countsht">
                    <?php
                    /**
                     * Выводим количество товаров в корзине
                     */
                    echo $data['cartCount'] ? $data['cartCount'] : 0 ?></span>
                шт. - <span
                        class="pricesht"><?php echo $data['cartPrice'] ? $data['cartPrice'] : 0 ?></span> <?php echo $data['currency']; ?>
            </li>
        </ul>
        <?php
        /**
         * На блок с классом small-cart-icon будет лететь изображение товара при добавлении этого товара в корзину
         */
        ?>
        <a href="<?php echo SITE ?>/cart" class="small-cart-icon">Иконка корзины</a>
    </div>
    <?php
    /**
     * Миникорзина всплывающая при наведении на .cart-inner
     */
    ?>
    <div class="small-cart" style="display: none;">
        <h2>Товары в корзине</h2>
        <table class="small-cart-table">
            <?php if (!empty($data['cartData']['dataCart'])) {
                foreach ($data['cartData']['dataCart'] as $item):?>
                    <tr>
                        <td class="small-cart-img">
                            <a href="<?php echo SITE . "/" . ($item['category_url'] ? $item['category_url'] : 'catalog') . "" . $item['product_url'] ?>">
                                <img src="<?php echo $item["image_url_new"] ?>" alt="<?php echo $item['title'] ?>"/>
                            </a>
                        </td>
                        <td class="small-cart-name">
                            <ul class="small-cart-list">
                                <li>
                                    <a href="<?php echo SITE . "/" . ($item['category_url'] ? $item['category_url'] : 'catalog') . "" . $item['product_url'] ?>"><?php echo $item['title'] ?></a>
                                    <span class="property"><?php echo $item['property_html'] ?> </span>
                                </li>
                                <li class="qty">x<?php echo $item['countInCart'] ?>
                                    <span><?php echo $item['priceInCart'] ?></li>
                            </ul>
                        </td>
                        <td class="small-cart-remove">
                            <a href="#" class="deleteItemFromCart" title="Удалить"
                               data-delete-item-id='<?php echo $item['id'] ?>'
                               data-property="<?php echo $item['property'] ?>">X</a></td>
                    </tr>
                <?php endforeach;
            } else { ?>

            <?php } ?>
        </table>
        <ul class="total">
            <li class="total-sum">Общая сумма: <span><?php echo $data['cartData']['cart_price_wc'] ?></span></li>
            <li class="checkount-buttons"><a href="<?php echo SITE ?>/cart">Корзина</a>&nbsp;&nbsp;|<a
                        href="<?php echo SITE ?>/order">Оформить</a></li>
        </ul>
    </div>
</div>
