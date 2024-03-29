<?php
    /**
     *  Вёрстка строковых характеристик товара
     *
     *  Получить подробную информацию о доступных на странице данных,
     *  можно вставив следующую строку кода в верстку файла:
     *  <?php viewData($data); ?>
     */

?>

<ul class="prop-string">
    <?php foreach ($data['groupProperty'] as $item): ?>
        <li class="name-group"><?php echo $item['name_group']; ?></li>
        <?php foreach ($item['property'] as $prop): ?>
            <li class="prop-item">
                <span class="prop-name"><?php echo $prop['key_prop'] ?></span>
                <span class="prop-spec">
                    <?php echo $prop['name_prop'] ?>
                    <span class="prop-unit"><?php echo $prop['unit'] ?></span>
                </span>
            </li>
        <?php endforeach; ?>
    <?php endforeach; ?>
    <?php foreach ($data['unGroupProperty'] as $item): ?>
        <?php if (!empty($item['name'])) : ?>
            <li class="prop-item nogroup">
                <span class="prop-name"><?php echo $item['name_prop'] ?></span>
                <span class="prop-spec">
                <?php echo $item['name'] ?>
                    <span class="prop-unit">
                    <?php echo $item['unit'] ?>
                </span>
            </span>
            </li>
        <?php endif; ?>
    <?php endforeach; ?>
</ul>