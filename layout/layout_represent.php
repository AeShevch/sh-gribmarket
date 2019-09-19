<section class="represent">
    <?php
    $shopsRus = [
        [
            "city" => "Крым",
            "phone" => "+7 (978) 855-75-59",
            "contact" => "Березовская Кира Георгиевна"
        ],
        [
            "city" => "Таганрог",
            "phone" => "+7 (908) 186-06-00",
            "contact" => "Вербицкий Дмитрий Александрович"
        ],
        [
            "city" => "Новосибирск",
            "phone" => "+7 (913) 006-32-24",
            "contact" => "Столбова Наталья Михайловна"
        ]
    ]
    ?>
    <h2 class="represent__title">Представители ООО ПКП «САНТАНА»</h2>
    <h3 class="represent__subtitle">Российская Федерация</h3>
    <div class="represent__inner">
        <?php
        foreach ($shopsRus as $shop) { ?>
            <div class="represent__item represent-item">
                <div class="represent-item__left">
                    <span class="represent-item__city">
                        <?php echo $shop['city']; ?>
                    </span>
                    <span class="represent-item__tel">
                        <svg viewBox="0 0 20px 20px">
                            <use xlink:href="#icon--tel"></use>
                        </svg>
                        <?php echo $shop['phone']; ?>
                    </span>
                </div>
                <div class="represent-item__right">
                    <span class="represent-item__contacts represent-item__contacts_title">
                        Контактное лицо:
                    </span>
                    <span class="represent-item__contacts">
                        <?php echo $shop['contact']; ?>
                    </span>
                </div>
            </div>
        <?php }
        ?>
    </div>
    <?php
    $shopsForeign = [
        [
            "city" => "Казахстан. Алматы",
            "phone" => "+7 (701) 746-24-49",
            "contact" => "Шабанов Гаджибек Рамазанович"
        ],
        [
            "city" => "Грузия. Тбилиси",
            "phone" => "+7 10 (995) 593 753355",
            "contact" => "Georgian Argo Product. Роман"
        ]
    ]
    ?>

    <h3 class="represent__subtitle">Страны ближнего и дальнего зарубежья</h3>
    <div class="represent__inner">
        <?php
        foreach ($shopsRus as $shop) { ?>
            <div class="represent__item represent-item">
                <div class="represent-item__left">
                    <span class="represent-item__city">
                        <?php echo $shop['city']; ?>
                    </span>
                    <span class="represent-item__tel">
                        <svg viewBox="0 0 20px 20px">
                            <use xlink:href="#icon--tel"></use>
                        </svg>
                        <?php echo $shop['phone']; ?>
                    </span>
                </div>
                <div class="represent-item__right">
                    <span class="represent-item__contacts represent-item__contacts_title">
                        Контактное лицо:
                    </span>
                    <span class="represent-item__contacts">
                        <?php echo $shop['contact']; ?>
                    </span>
                </div>
            </div>
        <?php }
        ?>
    </div>
    <div class="represent__alert">
        <svg>
            <use xlink:href="#icon--alert"></use>
        </svg>
        <span>В указанные выше регионы мицелий поставляется только через указанных представителей.</span>
    </div>
</section>