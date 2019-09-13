<?php

/**
 * Файл может содержать ряд пользовательскиз фунций влияющих на работу движка
 */
function seoMeta($args) {
  /*
   * Эта функция подставляет название магазина в title страницы
   * */
  $settings = MG::get('settings');
  $args[0]['title'] = !empty($args[0]['title']) ? $args[0]['title'] : '';
  $title = !empty($args[0]['meta_title']) ? $args[0]['meta_title'] : $args[0]['title'];
  MG::set('metaTitle', $title.' | '.$settings['sitename']);
}

mgAddAction('mg_seometa', 'seoMeta', 1);

 /*
 Этой функцией можно отключать ненужные css и js подключаемые плагинами и движком
 mgExcludeMeta(
   array(
    '/mg-plugins/rating/css/rateit.css',
    '/mg-plugins/rating/js/rating.js',
    '/mg-core/script/standard/css/layout.agreement.css'
  )
 );
 **/