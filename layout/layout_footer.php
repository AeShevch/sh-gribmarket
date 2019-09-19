<footer class="footer">
    <div class="footer__inner">
        <div class="footer__menu">
            <?php
            $pages = Menu::getArrayMenu();
            //viewData($pages);
            ?>
            <ul class="footer-menu">
                <?php
                foreach ($pages as $page) {
                    $pageUrl = URL::getClearUri();
                    $domain = SITE;
                    $linkUrl = str_replace($domain, '', $page['url']);

                    $activeClass = '';

                    if ($linkUrl === $pageUrl) {
                        $activeClass = 'footer-menu__item_active';
                    }
                    ?>

                    <li class="footer-menu__item <?php echo $activeClass ?>">
                        <a class="footer-menu__link"
                           href="<?php echo $page['url']; ?>">
                            <?php echo MG::contextEditor('page', $page['title'], $page["id"], "page"); ?>
                        </a>
                    </li>

                <?php } ?>
            </ul>
        </div>

        <div class="footer__info">
            <div class="footer-info footer-info_contacts">
                <h4 class="footer-info__title">
                    Контакты
                </h4>
                <div class="footer-info__inner">
                    <svg class="footer-info__icon">
                        <use xlink:href="#icon--tel"></use>
                    </svg>
                    <a href="tel:79658840404"
                       class="footer-info__content">
                        +7 (965) 884-04-04
                    </a>
                </div>
            </div>
            <div class="footer-info footer-info_time">
                <?php $workTime = explode(',', MG::getSetting('timeWork')); ?>
                <h4 class="footer-info__title">
                    Часы работы:
                </h4>
                <div class="footer-info__inner">
                    <svg class="footer-info__icon">
                        <use xlink:href="#icon--clock"></use>
                    </svg>
                    <div class="footer-info__content footer-info__content_time work-time__wrap">
                        <span class="work-time">
                            <span class="work-time__days">Пн-Пт: </span>
                            <?php echo trim($workTime[0]); ?>
                        </span>
                        <span class="work-time">
                            <span class="work-time__days">Cб-Вс: </span>
                            <?php echo trim($workTime[1]); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer__form form">
            <div class="form__inner">
                <h3 class="form__title">Позвонить вам?</h3>
                <span class="form__subtitle">
                    Оставьте свои контакты <br>
                    и мы свяжемся с вами
                </span>

                <span class="form__agreement">
                    Нажимая на кнопку «Отправить», вы
                    <button class="">соглашаетесь на обработку ваших персональных данных</button>
                </span>
                <button class="form__submit">
                    Отправить
                </button>
            </div>
        </div>
    </div>
</footer>