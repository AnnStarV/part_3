$(document).ready(function() {
	$("#form").submit(function() {
		$.ajax({
			url:     "user_data.php", //url страницы (action_ajax_form.php)
			type:     "POST", //метод отправки
			dataType: "html", //формат данных
			data: $("#form").serialize(),  // Сеарилизуем объект
		});
	
   }
);
});
