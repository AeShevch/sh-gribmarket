<?php
/**
 *  В данном файле содержится вёрстка выбора валюты.
 *  ВНИМАНИЕ! Данный функционал будет работать только в редакции Гипермаркет!
 */
?>
<?php if(MG::getSetting('printCurrencySelector') == 'true'){
	$currencyActive = MG::getSetting('currencyActive');
	$currencyShopIso = MG::get('dbCurrency');?>
        <?php
        /**
         *  Ниже находится сам селект выбора валюты.
         *  Атрибут name="userCustomCurrency" ОБЯЗАТЕЛЕН
         */
        ?>
        <select name="userCustomCurrency">
            <?php foreach (MG::getSetting('currencyShort') as $k => $v){ 
              if(!in_array($k, $currencyActive) && $k != $currencyShopIso){continue;}?>
              <option value="<?php echo $k ?>" <?php if($k == $_SESSION['userCurrency']){echo 'selected';} ?>> <?php echo $v ?> </option>
            <?php } ?>
        </select>
<?php } ?>
