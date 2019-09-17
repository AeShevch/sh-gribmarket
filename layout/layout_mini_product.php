<?php
    /**
     * В данном файле содержится вёрстка миникарточки товара
     *
     * Получить подробную информацию о доступных на странице данных,
     *  можно вставив следующую строку кода в верстку файла:
     *  <?php viewData($data); ?>
     */
?>
<div class="product-card swiper-slide">
    <div class="product-card__image" role="img">
        <?php
            echo $data['item']['recommend'] ? '<span class="product-card__sticker product-card__sticker_recommend">Хит продаж</span>' : '';
            echo $data['item']['new'] ? '<span class="product-card__sticker product-card__sticker_new">Новинка</span>' : '';
        ?>
        <a href="<?php echo SITE ?>/<?php echo isset($data['item']["category_url"]) ? $data['item']["category_url"] : 'catalog' ?><?php echo htmlspecialchars($data['item']["product_url"]) ?>">
            <?php echo mgImageProduct($data['item'], false, 'MIN', false); ?>
        </a>
    </div>

    <?php if (class_exists('Rating')): ?>
        <div class="product-card__rating">
            [rating id = "<?php echo($data['item'] ['id']) ?>"]
        </div>
    <?php endif; ?>

    <!--  Название товара  -->
    <h3 class="product-card__title">
        <a href="<?php echo SITE ?>/<?php echo isset($data['item']["category_url"]) ? $data['item']["category_url"] : 'catalog' ?><?php echo htmlspecialchars($data['item']["product_url"]) ?>"><?php echo $data['item']["title"] ?></a>
    </h3>

    <span class="product-card__price">
        <?php echo priceFormat($data['item']["price"]) ?><?php echo $data['currency']; ?>
    </span>

    <?php
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

    <form action="<?php echo SITE ?>/catalog"
          method="POST"
          class="property-form actionBuy product-card__form"
          data-product-id="<?php echo($data['item'] ['id']) ?>">

        <?php
            if (MG::getSetting('printQuantityInMini') == 'true'):?>
                <div class="cart_form product-card__amount amount">
                    <div class="amount_change amount__inner">
                        <button class="down amount__btn">
                            -
                        </button>
                        <input type="text"
                               aria-label="Количество товара"
                               class="amount_input amount__input"
                               name="amount_input"
                               data-max-count="<?php echo $data['maxCount'] ?>"
                               value="1"/>
                        <button class="up amount__btn">
                            +
                        </button>
                    </div>
                </div>
            <?php endif; ?>

        <div class="product-card__btns">
            <?php
                if ($data['item']['count'] != 0) {
                    layout('btn_buy', $data['item']);
                } else {
                    layout('btn_more', $data['item']);
                }
            ?>
        </div>
    </form>

</div>