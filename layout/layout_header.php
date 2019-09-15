<header class="header">
    <div class="header__top">
        <?php layout('topmenu'); ?>

        <?php layout('backring'); ?>

        <?php layout('cart'); ?>
    </div>


    <div class="header__center">
        <?php if (URL::isSection(null)): ?>
            <?php echo mgLogo(); ?>
        <?php else: ?>
            <a href="<?php echo SITE ?>">
                <?php echo mgLogo(); ?>
            </a>
        <?php endif; ?>

        <?php layout('search'); ?>


        <img src="<?php echo PATH_SITE_TEMPLATE ?>/images/santana.svg"
             alt="Сантана">
    </div>

    <div class="header__bottom">
        <?php layout('menu'); ?>
    </div>
</header>