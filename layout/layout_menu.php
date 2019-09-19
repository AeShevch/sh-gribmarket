<?php
$pages = Menu::getArrayMenu();
//viewData($pages);
?>

<ul class="menu">
    <?php
    foreach ($pages as $page):?>

        <?php
        /**
         *  Если у страница неактивна - пропускаем её.
         *
         */
        if ($page['invisible'] == "1") {
            continue;
        } ?>

        <?php
        /**
         * Если у данной страницы есть подстраницы.
         */
        if (isset($page['child'])): ?>
            <?php  /** если все вложенные страницы неактивны, то не создаем вложенный список UL */
            $slider = 'slider';
            $noUl = 1;
            foreach ($page['child'] as $pageLevel1) {
                $noUl *= $pageLevel1['invisible'];
            }
            if ($noUl) {
                $slider = '';
            } ?>

            <?php
            /**
             * Пункт меню первого уровня с дочерними страницами
             */
            ?>
            <li class="menu__item">
                <a class="menu__link" href="<?php echo $page['url']; ?>">
                    <?php
                    /**
                     * Функция MG::contextEditor даёт возможность редактирования элемента при включённом режиме редактирования в публичной части.
                     */
                    echo MG::contextEditor('page', $page['title'], $page["id"], "page"); ?>
                </a>

                <?php
                /**
                 * Если все вложенные страницы неактивны, то не создаем вложенный ul и переходим на следующую итерацию
                 */
                if ($noUl) {
                    $slider = '';
                    continue;
                } ?>


                <ul>
                    <?php foreach ($page['child'] as $pageLevel1): ?>
                        <?php if ($pageLevel1['invisible'] == "1") {
                            continue;
                        } ?>
                        <?php if (isset($pageLevel1['child'])): ?>
                            <?php /** если все вложенные страницы неактивны, то не создаем вложенный список UL */
                            $slider = 'slider';
                            $noUl = 1;
                            foreach ($pageLevel1['child'] as $pageLevel2) {
                                $noUl *= $pageLevel2['invisible'];
                            }
                            if ($noUl) {
                                $slider = '';
                            } ?>
                            <?php
                            /**
                             * Дочерняя страница с подстраницами
                             */
                            ?>
                            <li>
                                <a href="<?php echo $pageLevel1['url']; ?>">
                                    <?php
                                    /**
                                     * Функция MG::contextEditor даёт возможность редактирования элемента при включённом режиме редактирования в публичной части.
                                     */
                                    echo MG::contextEditor('page', $pageLevel1['title'], $pageLevel1["id"], "page"); ?>
                                </a>

                                <?php if ($noUl) {
                                    $slider = '';
                                    continue;
                                } ?>


                                <ul>
                                    <?php foreach ($pageLevel1['child'] as $pageLevel2): ?>
                                        <?php if ($pageLevel2['invisible'] == "1") {
                                            continue;
                                        } ?>
                                        <?php
                                        /**
                                         * Дочерняя страницы 2 уровня
                                         */
                                        ?>
                                        <li>
                                            <a href="<?php echo $pageLevel2['url']; ?>">
                                                <?php
                                                /**
                                                 * Функция MG::contextEditor даёт возможность редактирования элемента при включённом режиме редактирования в публичной части.
                                                 */
                                                echo MG::contextEditor('page', $pageLevel2['title'], $pageLevel2["id"], "page"); ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>

                        <?php
                        /**
                         * Если у дочерней страницы нет подстраниц
                         */
                        else:?>
                            <li>
                                <a href="<?php echo $pageLevel1['url']; ?>">
                                    <?php
                                    /**
                                     * Функция MG::contextEditor даёт возможность редактирования элемента при включённом режиме редактирования в публичной части.
                                     */
                                    echo MG::contextEditor('page', $pageLevel1['title'], $pageLevel1["id"], "page"); ?>
                                </a>
                            </li>
                        <?php endif; ?>

                    <?php endforeach; ?>
                </ul>
            </li>

        <?php
        /**
         *  Если у страницы нет подстраниц
         */
        else:?>
        <?php
            $pageUrl = URL::getClearUri();
            $domain = SITE;
            $linkUrl = str_replace($domain, '', $page['url']);

            $activeClass = '';

            if ($linkUrl === $pageUrl) {
                $activeClass = 'menu__item_active';
            }

            ?>
            <li class="menu__item <?php echo $activeClass ?>">
                <a class="menu__link"
                   href="<?php echo $page['url']; ?>">
                    <?php
                    if ($page['title']==='Акции') {
                        ?>
                        <svg class="menu__icon">
                            <use xlink:href="#icon--sale"></use>
                        </svg>
                    <?php
                    }
                    echo MG::contextEditor('page', $page['title'], $page["id"], "page"); ?>
                </a>
            </li>
        <?php endif; ?>
    <?php endforeach; ?>
</ul>
