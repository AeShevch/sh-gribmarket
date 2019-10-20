<?php
    /**
     * Вставляем вёрстку характеристик "набор для выбора" и "чекбоксы" из файла layout_htmlProperty.php
     */
    echo $data['htmlProperty'];

    /**
     * Вставляем варинаты и размерно-цветовую сетку из файла layout_variants.php
     */
    echo $data['blockVariants']; ?>

<div class="buy-container <?php echo (MG::get('controller') == 'controllers_product') ? 'product' : '' ?>"
    <?php if (MG::get('controller') == 'controllers_product') {
        echo($data['maxCount'] == "0" || !$data['activity'] ? 'style="display:none"' : '');
    } ?> >
    <?php if (!$data['noneAmount']) { ?>
        <div class="cart_form product-card__amount amount">
            <div class="amount_change amount__inner">
                <button class="down amount__btn">
                    –
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
    <?php } ?>

    <div class="hidder-element" <?php echo($data['noneButton'] ? 'style="display:none"' : '') ?> >
        <input type="hidden" name="inCartProductId" value="<?php echo $data['id'] ?>">

        <?php
            $count = $data['maxCount'];
            if ($count == 0) {
                $model = new Models_Product();
                $variants = $model->getVariants($data['id']);

                if ($variants) {
                    $count = 0;
                    // вычисляем общее число вариантов
                    foreach ($variants as $variant) {
                        $count += $variant['count'];
                    }
                }
            }
        ?>

        <?php if (!$data['noneButton'] || (MG::getProductCountOnStorage(0, $data['id'], 0, 'all') != 0)) {
            if ($data['ajax']) {
                if ($data['buyButton']) {
                    echo $data['buyButton'];
                } else { ?>
                    <input type="submit" name="buyWithProp" onclick="return false;" style="display:none">
                    <?php
                    /*
                     * Вставляем кнопку "Купить(Добавить в корзину)"
                     * Из файла layout_btn_buy.php
                     * */
                    layout('btn_buy', $data);
                }
            } else {
                ?>
                <input type="submit" name="buyWithProp">
            <?php } ?>
        <?php } ?>

    </div>
</div>