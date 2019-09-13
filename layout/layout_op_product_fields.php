<?php
/* Дополнительные поля товаров
 Создаются в разделе Настройки -> Доп. поля -> товары
 http://wiki.moguta.ru/settings/dopolnitelnye-polya
  * */
if (EDITION == 'gipermarket') {
	$opFieldsM = new Models_OpFieldsProduct($data['id']);
	$fields = $opFieldsM->get();

	foreach ($fields as $key => $value) {
        if (($value['active'] == 0) || (empty($value['value']))) continue;
		if($data['variant']) {
			echo '<li class="product-opfield">'
                    .'<span class="product-opfield__name">'
                        .$value['name'].': '
                    .'</span>'
                    .'<span class="product-opfield__value">'
                        .$value['variant'][$data['variant']]['value']
                    .'</span>'
                .'</li>';
		} else {
            echo '<li class="product-opfield">'
                    .'<span class="product-opfield__name">'
                        .$value['name'].': '
                    .'</span>'
                    .'<span class="product-opfield__value">'
                        .$value['value']
                    .'</span>'
                .'</li>';
		}
	}
}

?>