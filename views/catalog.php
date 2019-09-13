<?php
    /**
     *  Файл представления Catalog - выводит сгенерированную движком информацию на странице сайта с каталогом товаров.
     *  В этом  файле доступны следующие данные:
     *   <code>
     *    $data['items'] => Массив товаров
     *    $data['titeCategory'] => Название открытой категории
     *    $data['cat_desc'] => Описание открытой категории
     *    $data['pager'] => html верстка  для навигации страниц
     *    $data['searchData'] =>  результат поисковой выдачи
     *    $data['meta_title'] => Значение meta тега для страницы
     *    $data['meta_keywords'] => Значение meta_keywords тега для страницы
     *    $data['meta_desc'] => Значение meta_desc тега для страницы
     *    $data['currency'] => Текущая валюта магазина
     *    $data['actionButton'] => тип кнопки в миникарточке товара
     *   </code>
     *
     *   Получить подробную информацию о каждом элементе массива $data, можно вставив следующую строку кода в верстку файла.
     *   <code>
     *    <?php viewData($data['items']); ?>
     *   </code>
     *
     *   Вывести содержание элементов массива $data, можно вставив следующую строку кода в верстку файла.
     *   <code>
     *    <?php echo $data['items']; ?>
     *   </code>
     *
     *   <b>Внимание!</b> Файл предназначен только для форматированного вывода данных на страницу магазина. Категорически не рекомендуется выполнять в нем запросы к БД сайта или реализовывать сложую программную логику логику.
     * @author Авдеев Марк <mark-avdeev@mail.ru>
     * @package moguta.cms
     * @subpackage Views
     */

    //НЕ УБИРАТЬ! Выводить метатеги страницы, заданные в панели управления.
    mgSEO($data);
?>

<!-- Верстка каталога -->
<?php if (empty($data['searchData'])): ?>
    <?php
    /**
     * Выводит блок с подкатегориями из файла layout_subcategory.php
     */
    echo mgSubCategory($data['cat_id']); ?>
    <h1><?php echo $data['titeCategory'] ?></h1>
    <?php if ($cd = str_replace("&nbsp;", "", $data['cat_desc'])): ?>
        <div class="cat-desc">
            <?php if ($data['cat_img']): ?>
                <div class="cat-desc-img">
                    <img src="<?php echo SITE.$data['cat_img'] ?>" alt="<?php echo $data['titeCategory'] ?>"
                         title="<?php echo $data['titeCategory'] ?>">
                </div>
            <?php endif; ?>
            <div class="cat-desc-text"><?php echo $data['cat_desc'] ?></div>
        </div>
    <?php endif; ?>

    <?php
    /**
     * Выводит вёрстку применённых фильтров из файла layout_apply_filter.php
     */
    layout("apply_filter", $data['applyFilter']); ?>

    <div class="products-wrapper">

        <?php foreach ($data['items'] as $item) {
            $data['item'] = $item; ?>

            <?php
            /**
             * Выводит миникарточку товара из файла layout_miniproduct.php
             */
            layout('mini_product', $data); ?>

        <?php } ?>

        <?php if (count($data['items']) == 0 && $_GET['filter'] == 1) echo 'Товаров нет'; ?>

        <!-- / Верстка каталога -->
    </div>
    <?php
    // выводит постраничную навигацию из файла layout_pagination.php
    echo $data['pager'];
    ?>
    <div class="cat-desc-text">
        <?php
            // SEO описание категории
            echo $data['cat_desc_seo'] ?>
    </div>

    <!-- Верстка поиска -->
<?php else: ?>

    <h1 class="new-products-title">При поиске по фразе: <strong>"<?php echo $data['searchData']['keyword'] ?>"</strong>
        найдено
        <strong><?php echo mgDeclensionNum($data['searchData']['count'], array('товар', 'товара', 'товаров')); ?></strong>
    </h1>

    <div class="search-results">
        <?php foreach ($data['items'] as $item): ?>
            <div class="product-wrapper">
                <div class="product-image">
                    <?php
                        echo $item['recommend'] ? '<span class="sticker-recommend"></span>' : '';
                        echo $item['new'] ? '<span class="sticker-new"></span>' : '';
                    ?>
                    <a href="<?php echo $item["link"] ?>">
                        <?php echo mgImageProduct($item); ?>
                    </a>
                </div>
                <div class="product-desc">
                    <div class="product-name">
                        <a href="<?php echo $item["link"] ?>"><?php echo $item["title"] ?></a>
                    </div>
                    <div class="product-desc"><?php echo MG::textMore($item["description"], 240) ?></div>
                    <span class="product-price"><?php echo $item["price"] ?><?php echo $data['currency']; ?></span>
                    <?php echo $item['buyButton']; ?>
                    <div class="clear"></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php
    echo $data['pager'];
endif;
?>
<!-- / Верстка поиска -->