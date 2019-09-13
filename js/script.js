$(document).ready(function() {

	$(function () { // Когда страница загрузится
		$('.top-menu-list li a').each(function () { // получаем все нужные нам ссылки
			var location = window.location.href; // получаем адрес страницы
			var link = this.href;                // получаем адрес ссылки
			if(location == link) {               // при совпадении адреса ссылки и адреса окна
				$(this).addClass('active-menu-item');  //добавляем класс
			}
		});
	});

  	
});