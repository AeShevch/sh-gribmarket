<?php

/**
 * Класс предназначенный для работы с БД сайта средствами AJAX запросов.
 * Должен наследоваться от класса Actioner и содержать в себе пользовательские методы, вызываемые AJAX'ом
 * Метода данного класса могут быть вызваны из JS скриптов следующим образом:
 *   $.ajax({
 *       type: "POST",
 *      url: "ajax",
 *      data: {
 *        action: "getSearchData", // название действия в пользовательском класса Ajaxuser
 *        actionerClass: "Ajaxuser", // ajaxuser.php - в папке шаблона
 *        param1: text,
 *    	   param2: text
 *      },   
 *    });
 */

class Ajaxuser extends Actioner {

    
  /**
   * Получает список продуктов при вводе в поле поиска
   */
  public function getSearchData() {
    $keyword = URL::getQueryParametr('search');
    if (!empty($keyword)) {
      $catalog = new Models_Catalog;
      $items = $catalog->getListProductByKeyWord($keyword, true, true);

      $searchData = array(
        'status' => 'success',
        'item' => array(
          'keyword' => $keyword,
          'count' => $items['numRows'],
          'items' => $items,
        ),
        'currency' => MG::getOption('currency')
      );
    }

    echo json_encode($searchData);
    exit;
  }

}