<?php
/**
 *  В данном файле содержится вёрстка меню страниц.
 *
 *  Получить подробную информацию о доступных на странице данных,
 *  можно вставив следующую строку кода в верстку файла:
 *  <?php viewData($data); ?>
 *
 */
?>
<ul class="demo-topmenu">
    <?php
    /**
     *  $data['pages'] - массив с информацией о имеющихся страницах.
     *  Посмотреть его содержимое можно используя <?php viewData($data['pages']); ?>
     */
    foreach ($data['pages'] as $page):?>

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
            <li>
                <a href="<?php echo $page['link']; ?>">
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
                                <a href="<?php echo $pageLevel1['link']; ?>">
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
                                            <a href="<?php echo $pageLevel2['link']; ?>">
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
                                <a href="<?php echo $pageLevel1['link']; ?>">
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
            <li>
                <a href="<?php echo $page['link']; ?>">
                    <?php
                    /**
                     * Функция MG::contextEditor даёт возможность редактирования элемента при включённом режиме редактирования в публичной части.
                     */
                    echo MG::contextEditor('page', $page['title'], $page["id"], "page"); ?>
                </a>
            </li>
        <?php endif; ?>
    <?php endforeach; ?>
</ul>
