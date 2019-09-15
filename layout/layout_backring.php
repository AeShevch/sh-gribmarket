
<?php
$phones = explode(', ', MG::getSetting('shopPhone'));
?>
<button class="backring js-backring-click back-ring-button">
    <svg class="backring__icon">
        <use xlink:href="#icon--tel"></use>
    </svg>
    <div class="backring__inner">
        <span class="backring__tel">
            <?php echo $phones[0] ?>
        </span>
        <span class="backring__title">
            Обратный звонок
        </span>
    </div>
</button>

[back-ring]