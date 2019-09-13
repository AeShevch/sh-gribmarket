<?php
/**
 * Если пользователь авторизован вставляем ссылка на личный кабинет,
 * Если нет, то на авторизацию
 */
if($thisUser = $data['thisUser']): ?>

    <a href="<?php echo SITE?>/personal">
        Личный кабинет
    </a>

<?php else: ?>

    <a href="<?php echo SITE?>/enter">
        Войти
    </a>

<?php endif; ?>