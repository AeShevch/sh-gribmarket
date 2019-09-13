<?php
/**
 * В данном файле находится вёрстка кнопки "Добавить в сравнение"
 *
 * Класс addToCompare обязателен для работы стандартного добавления товара в "Сравнение"
 */
?>
<?php if (MG::getSetting('printCompareButton')=="true") :?>
<a href="<?php echo SITE . '/compare?inCompareProductId=' . $data["id"]; ?>" rel="nofollow"
   class="addToCompare" data-item-id="<?php echo $data["id"]; ?> ">Сравнить</a>
<?php endif; ?>