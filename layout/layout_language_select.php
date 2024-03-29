<?php
/**
 *  В данном файле содержится вёрстка выбора языка.
 *  ВНИМАНИЕ! Данный функционал будет работать только в редакции Гипермаркет!
 *
 */
?>
<?php
$multiLang = unserialize(stripcslashes(MG::getSetting('multiLang')));
$count = 0;
foreach ($multiLang as $mLang) {
	if ($mLang['active'] == 'true') $count++;
}
if (is_array($multiLang) && !empty($multiLang) && $count!=0) { ?>
	    <?php $url = str_replace(url::getCutSection(), '', $_SERVER['REQUEST_URI']);?>
        <?php
        /**
         *  Ниже находится сам селект выбора языка.
         *  Атрибут name="multiLang-selector" ОБЯЗАТЕЛЕН
         */
        ?>
	    <select name="multiLang-selector">
		    <?php echo '<option value="'.SITE.$url.'" '.((LANG == 'LANG' || LANG == '')?'selected="selected"':"").'>'.lang('defaultLanguage').'</option>';
		    foreach ($multiLang as $mLang) {
		    	if ($mLang['active'] != 'true') {continue;}
		        echo '<option value="'.SITE.'/'.$mLang['short'].$url.'" '.((LANG == $mLang['short'])?'selected="selected"':"").'>'.$mLang['full'].'</option>';
		    } ?>
	    </select>
<?php } ?>

