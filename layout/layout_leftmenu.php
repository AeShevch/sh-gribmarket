<nav class="left-menu">
    <h4 class="left-menu__title">Категории товаров</h4>
    <ul class="left-menu__list">

        <?php
        foreach ($data['categories'] as $category): ?>
            <?php
            /**
             *  Если у категория неактивна - пропускаем её.
             *
             */
            if ($category['invisible'] == "1") {
                continue;
            } ?>

            <?php
            /**
             * Если у данной категории есть подкатегории.
             */
            ?>
            <?php /** если вложенных категорий нет или они неактивны, то не создаем вложенный список UL */
            $slider = 'slider';
            $noUl = 1;
            if (!empty($category['child']) && is_array($category['child'])) {
                foreach ($category['child'] as $categoryLevel1) {
                    $noUl *= $categoryLevel1['invisible'];
                }
            }
            if ($noUl) {
                $slider = '';
            } ?>
            <?php
            /**
             * Категория первого уровня
             */
            ?>
            <li class="left-menu__item <?php echo $slider ?>">
                <a class="left-menu__link"
                   href="<?php echo $category['link']; ?>">
                    <span>
                          <?php
                          echo MG::contextEditor('category', $category['menu_title'] ? $category['menu_title'] : $category['title'], $category["id"], "category"); ?>
                    </span>
                </a>

                <?php
                /**
                 * Если вложенных категорий нет или они неактивны, то не создаем вложенный ul и переходим на следующую итерацию
                 */
                if ($noUl) {
                    $slider = '';
                    continue;
                } ?>


                <?php
                /**
                 *  Вложенные категории (Категории второго уровня)
                 */
                ?>
                <ul class="left-menu__sub-menu">

                    <?php foreach ($category['child'] as $categoryLevel1): ?>
                        <?php if ($categoryLevel1['invisible'] == "1") {
                            continue;
                        } ?>
                        <?php /** еесли вложенных категорий нет или они неактивны,, то не создаем вложенный список UL */
                        $slider = 'slider';
                        $noUl = 1;
                        if (!empty($categoryLevel1['child']) && is_array($categoryLevel1['child'])) {
                            foreach ($categoryLevel1['child'] as $categoryLevel2) {
                                $noUl *= $categoryLevel2['invisible'];
                            }
                        }
                        if ($noUl) {
                            $slider = '';
                        } ?>

                        <li class="left-menu__item <?php echo $slider ?>">
                            <a class="left-menu__link"
                               href="<?php echo $categoryLevel1['link']; ?>">
                                <span>
                                    <?php echo MG::contextEditor('category', $categoryLevel1['menu_title'] ? $categoryLevel1['menu_title'] : $categoryLevel1['title'], $categoryLevel1["id"], "category"); ?>
                                </span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </li>

        <?php endforeach; ?>
    </ul>
</nav>