<?php
    /**
     * Файл содержит вёрстку блока "С этим товаром покупают"
     * Данный функционал доступен от редакции Маркет и выше
     */
?>
<?php mgAddMeta('<link href="'.SCRIPT.'standard/css/layout.related.css" rel="stylesheet" type="text/css" />'); ?>
<?php mgAddMeta('<script src="'.SCRIPT.'standard/js/layout.related.js"></script>'); ?>

<div class="mg-recent-products">
    <h2><?php echo $data['title'] ?> <span class="custom-arrow"></span></h2>
    <div class="recent-products-slider">
        <?php foreach ($data['products'] as $item) {
            $data['item'] = $item; ?>

            <?php
            /**
             * Выводит миникарточку товара из файла layout_miniproduct.php
             */
            layout('mini_product', $data); ?>

        <?php } ?>

    </div>
</div>