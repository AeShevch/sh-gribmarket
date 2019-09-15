<section class="categories">
    <div class="categories__inner">
    <?php
    $categories = MG::get('category')->getArrayCategory();
    $counter = 0;
    $secondColumnCounter = 0;

    foreach ($categories as $category) {
    if ($category['activity'] && $category['level'] == '1') {
    $counter++;
    if ($counter === 1) { ?>
    <div class="categories__left">
    <?php }
    if ($counter === 3) { ?>
    <div class="categories__right">
    <?php } ?>

            <a class="categories__item product-category"
               href="<?php echo $category['url'] ?>"
               style="background-image: url('<?php echo SITE.$category['menu_icon'] ?>');">
                <div class="product-category__inner">
                    <h3 class="product-category__title">
                        <?php echo $category['title'] ?>
                    </h3>
                    <span class="product-category__subtitle">
                    <?php echo $category['seo_content'] ?>
                </span>
                </div>
            </a>
            <?php
            if (($counter === 2) || ($counter === 5)) {
            ?>
        </div>
    <?php } ?>

        <?php }
        } ?>
    </div>
</section>
