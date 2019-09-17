<?php
/**
 * В данном файле находится вёрстка кнопки купить/подробнее
 */
?>

<?php
/**
 * Класс addToCart на кнопке купить необходим для эффекта полёта товара в корзину, обновлении миникорзины, открытии всплывающей корзины.
 * Меняйте его, только если вы точно уверены в том, что делаете.
 */
?>
    <input type="hidden"
           name="inCartProductId"
           value="<?php echo $data['id'] ?>">

    <a href="<?php echo SITE . '/catalog?inCartProductId=' . $data["id"]; ?>"
       rel="nofollow"
       class="addToCart product-buy product-card__btn"
       data-item-id="<?php echo $data["id"]; ?>">
        Купить
    </a>

<?php if (!empty($data['variant_exist'])) : ?>
    <a style="display:none"
       href="<?php echo SITE . '/' . ((MG::getSetting('shortLink') != 'true') && ($data["category_url"] == '') ? 'catalog/' : $data["category_url"]) . $data["product_url"]; ?>"
       class="product-info action_buy_variant product-card__btn"><?php echo lang('buttonMore'); ?></a>
<?php endif; ?>