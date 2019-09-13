<?php
/**
 * Вёрстка слайдера изображений на странице товаров
 *
 *  Получить подробную информацию о доступных на странице данных,
 *  можно вставив следующую строку кода в верстку файла:
 *  <?php viewData($data); ?>
 */
?>

<?php mgAddMeta('<link type="text/css" href="'.SCRIPT.'standard/css/jquery.fancybox.css" rel="stylesheet"/>'); ?>
<?php mgAddMeta('<link type="text/css" href="'.SCRIPT.'standard/css/layout.images.css" rel="stylesheet"/>'); ?>
<?php mgAddMeta('<script src="'.SCRIPT.'jquery.fancybox.pack.js"></script>'); ?>
<?php mgAddMeta('<script src="'.SCRIPT.'jquery.bxslider.min.js"></script>'); ?>
<?php mgAddMeta('<script src="'.SCRIPT.'standard/js/layout.images.js"></script>'); ?>
<?php mgAddMeta('<script src="'.SCRIPT.'zoomsl-3.0.js"></script>'); ?>

<div class="mg-product-slides">
    <?php
    echo $data['recommend']?'<span class="sticker-recommend"></span>':'';
    echo $data['new']?'<span class="sticker-new"></span>':'';
    ?>
    <ul class="main-product-slide">
        <?php foreach ($data["images_product"] as $key=>$image){?>
            <li class="product-details-image"><a href="<?php echo $image ? SITE.'/uploads/'.$image: SITE."/uploads/no-img.jpg" ?>" data-fancybox="mainProduct" rel="gallery" class="fancy-modal">
            <?php
            $item["image_url"] = $image;
            $item["id"] = $data["id"];
            $item["title"] = $data["title"];
            $item["image_alt"] = $data["images_alt"][$key];
            $item["image_title"] = $data["images_title"][$key];

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
            echo mgImageProduct($item,false,'MID',true);
            ?></a>


            <?php
            /**
             * В этом блоке показывается увеличенное(оригинал) изображение при наведении
             */
            ?>
            <a class="zoom fancy-modal" href="<?php echo $image ? SITE.'/uploads/'.$image: SITE."/uploads/no-img.jpg" ?>"></a>
            </li>
        <?php }?>
    </ul>

    <?php
    /**
     * Миниатюры изображения товара
     */
    if(count($data["images_product"])>1){?>
        <div class="slides-slider">
            <div class="slides-inner">
                <?php foreach ($data["images_product"] as $key=>$image){
                    $src = mgImageProductPath($image, $data["id"], 'small');
                    ?>
                    <a data-slide-index="<?php echo $key?>" class="slides-item">
                        <img class="mg-preview-foto"  src="<?php echo $src ?>" 
                            alt="<?php echo !empty($data["images_alt"][$key])?$data["images_alt"][$key]:$data["title"]; ;?>" 
                            title="<?php echo $data["images_title"][$key];?>"/>
                    </a>
                <?php }?>
            </div>
        </div>
    <?php }?>
</div>
