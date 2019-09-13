<?php
/**
 *  В данном файле содержится вёрстка меню каталога.
 *
 *  Получить подробную информацию о доступных на странице данных,
 *  можно вставив следующую строку кода в верстку файла:
 *  <?php viewData($data); ?>
 *
 */
?>
<ul class="cat-list">

    <?php
    /**
     *  $data['categories'] - массив с информацией о имеющихся категориях.
     *  Посмотреть его содержимое можно используя <?php viewData($data['categories']); ?>
     */
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
            <li class="<?php echo $slider ?>">
                <a href="<?php echo $category['link']; ?>">
                    <?php if (!empty($category['menu_icon'])): ?>
                        <span class="mg-cat-img">
                            <img src="<?php echo SITE . $category['menu_icon']; ?>"
                                 alt="<?php echo $category['menu_title'] ? $category['menu_title'] : $category['title']; ?>"
                                 title="<?php echo $category['menu_title'] ? $category['menu_title'] : $category['title']; ?>">
                        </span>
                    <?php endif; ?>
                    <span>
                          <?php
                          /**
                           * Функция MG::contextEditor даёт возможность редактирования элемента при включённом режиме редактирования в публичной части.
                           */
                          echo MG::contextEditor('category', $category['menu_title'] ? $category['menu_title'] : $category['title'], $category["id"], "category"); ?>
                    </span>
                    <?php
                    /**
                     * MG::getSetting выводит значения указанные в настройках магазина.
                     * Значение указываемое аргументом этой функции соответствует заданному в таблице mg-setting имени настройки
                     * В данном случае мы проверяем включена ли в настройках опция "Показывать в меню каталога, количество товаров в категориях"
                     * Подробнее - http://wiki.moguta.ru/help/Libraries/MG.html#getSetting
                     */
                    if (MG::getSetting('showCountInCat') == 'true'): ?>
                        <span>
                            <?php
                            /**
                             * Возвращает количество товара в данной категории
                             */
                            echo $category['insideProduct'] ? '(' . $category['insideProduct'] . ')' : ''; ?>
                        </span>
                    <?php endif; ?>
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
                <ul class="sub_menu">

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

                            <li class="<?php echo $slider ?>">
                                <a href="<?php echo $categoryLevel1['link']; ?>">
                                    <?php if (!empty($categoryLevel1['menu_icon'])): ?>
                                        <span class="mg-cat-img">
                                            <img src="<?php echo SITE . $categoryLevel1['menu_icon']; ?>"
                                                 alt="<?php echo $categoryLevel1['menu_title'] ? $categoryLevel1['menu_title'] : $categoryLevel1['title']; ?>"
                                                 title="<?php echo $categoryLevel1['menu_title'] ? $categoryLevel1['menu_title'] : $categoryLevel1['title']; ?>">
                                        </span>
                                    <?php endif; ?>
                                    <span>
                                          <?php
                                          /**
                                           * Функция MG::contextEditor даёт возможность редактирования элемента при включённом режиме редактирования в публичной части.
                                           */
                                          echo MG::contextEditor('category', $categoryLevel1['menu_title'] ? $categoryLevel1['menu_title'] : $categoryLevel1['title'], $categoryLevel1["id"], "category"); ?>
                                    </span>
                                    <?php
                                    /**
                                     * MG::getSetting выводит значения указанные в настройках магазина.
                                     * Значение указываемое аргументом этой функции соответствует заданному в таблице mg-setting имени настройки
                                     * В данном случае мы проверяем включена ли в настройках опция "Показывать в меню каталога, количество товаров в категориях"
                                     * Подробнее - http://wiki.moguta.ru/help/Libraries/MG.html#getSetting
                                     */
                                    if (MG::getSetting('showCountInCat') == 'true'): ?>
                                        <span><?php echo $categoryLevel1['insideProduct'] ? '(' . $categoryLevel1['insideProduct'] . ')' : ''; ?></span>
                                    <?php endif; ?>
                                </a>

                                <?php
                                /**
                                 * если вложенных категорий нет или они неактивны, то не создаем вложенный ul и переходим на следующую итерацию
                                 */
                                if ($noUl) {
                                    $slider = '';
                                    continue;
                                } ?>

                                <?php
                                /**
                                 *  Вложенные категории (Категории третьего уровня)
                                 */
                                ?>
                                <ul class="sub_menu">
                                    <?php foreach ($categoryLevel1['child'] as $categoryLevel2): ?>
                                        <?php if ($categoryLevel2['invisible'] == "1") {
                                            continue;
                                        } ?>

                                            <?php /** если вложенных категорий нет или они неактивны, то не создаем вложенный список UL */
                                            $slider = 'slider';
                                            $noUl = 1;
                                            foreach ($categoryLevel2['child'] as $categoryLevel3) {
                                                $noUl *= $categoryLevel3['invisible'];
                                            }
                                            if ($noUl) {
                                                $slider = '';
                                            } ?>

                                            <li>
                                                <a href="<?php echo $categoryLevel2['link']; ?>">
                                                    <?php if (!empty($categoryLevel2['menu_icon'])): ?>
                                                        <span class="mg-cat-img">
                                                            <img src="<?php echo SITE . $categoryLevel2['menu_icon']; ?>"
                                                                 alt="<?php echo $categoryLevel2['menu_title'] ? $categoryLevel2['menu_title'] : $categoryLevel2['title']; ?>"
                                                                 title="<?php echo $categoryLevel2['menu_title'] ? $categoryLevel2['menu_title'] : $categoryLevel2['title']; ?>">
                                                        </span>
                                                    <?php endif; ?>
                                                    <span>
                                                      <?php
                                                      /**
                                                       * Функция MG::contextEditor даёт возможность редактирования элемента при включённом режиме редактирования в публичной части.
                                                       */
                                                      echo MG::contextEditor('category', $categoryLevel2['menu_title'] ? $categoryLevel2['menu_title'] : $categoryLevel2['title'], $categoryLevel2["id"], "category"); ?>
                                                    </span>
                                                    <?php
                                                    /**
                                                     * MG::getSetting выводит значения указанные в настройках магазина.
                                                     * Значение указываемое аргументом этой функции соответствует заданному в таблице mg-setting имени настройки
                                                     * В данном случае мы проверяем включена ли в настройках опция "Показывать в меню каталога, количество товаров в категориях"
                                                     * Подробнее - http://wiki.moguta.ru/help/Libraries/MG.html#getSetting
                                                     */
                                                    if (MG::getSetting('showCountInCat') == 'true'): ?>
                                                        <span><?php echo $categoryLevel2['insideProduct'] ? '(' . $categoryLevel2['insideProduct'] . ')' : ''; ?></span>
                                                    <?php endif; ?>
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
                                                 *  Вложенные категории (Категории четвёртого уровня)
                                                 */
                                                ?>
                                                <ul class="sub_menu">
                                                    <?php foreach ($categoryLevel2['child'] as $categoryLevel3): ?>
                                                        <?php if ($categoryLevel3['invisible'] == "1") {
                                                            continue;
                                                        } ?>
                                                            <li class="slider">
                                                                <a href="<?php echo $categoryLevel3['link']; ?>">
                                                                    <?php if (!empty($categoryLevel3['menu_icon'])): ?>
                                                                        <span class="mg-cat-img">
                                                                            <img src="<?php echo SITE . $categoryLevel3['menu_icon']; ?>"
                                                                                 alt="<?php echo $categoryLevel3['menu_title'] ? $categoryLevel3['menu_title'] : $categoryLevel3['title']; ?>"
                                                                                 title="<?php echo $categoryLevel3['menu_title'] ? $categoryLevel3['menu_title'] : $categoryLevel3['title']; ?>">
                                                                        </span>
                                                                    <?php endif; ?>
                                                                    <span>
                                                                        <?php echo MG::contextEditor('category', $categoryLevel3['menu_title'] ? $categoryLevel3['menu_title'] : $categoryLevel3['title'], $categoryLevel3["id"], "category"); ?>
                                                                    </span>
                                                                    <?php if (MG::getSetting('showCountInCat') == 'true'): ?>
                                                                        <span><?php echo $categoryLevel3['insideProduct'] ? '(' . $categoryLevel3['insideProduct'] . ')' : ''; ?></span>
                                                                    <?php endif; ?>
                                                                </a>
                                                            </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                    <?php endforeach; ?>
                </ul>
            </li>

    <?php endforeach; ?>
</ul>