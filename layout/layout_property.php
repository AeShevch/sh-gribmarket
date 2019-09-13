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
        <div class="hidder-element" <?php echo($data['maxCount'] == "0" ? 'style="display:none"' : '') ?> >
            <p class="qty-text">Количество:</p>
            <div class="cart_form">
                <input type="text" name="amount_input" class="amount_input"
                       data-max-count="<?php echo $data['maxCount'] ?>" value="1"/>
                <div class="amount_change">
                    <a href="#" class="up">+</a>
                    <a href="#" class="down">-</a>
                </div>
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
            <?php
            /**
             * Вставляем кнопку «Добавить к сравнению» из файла layout_btn_compare.php
             * только если редакция движка Маркет или Гипермаркет
             */
            if ((EDITION == "market") || (EDITION == "gipermarket")) {
                layout('btn_compare', $data);
            } ?>
        <?php } ?>

    </div>
</div>