(function ($) {
	$(function () {// ф-я вызовется после загрузки дока

		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});//для безопасной передачи данных, общие параметры для ajax запросов


		$('.edit-recommended').click(function(){
			let elem = $(this);//тот эл-т по кот кликнули
           $.ajax({
           	 type: 'POST',
           	 url: '/admin/edit-recommended',//связан с методом контроллера
           	 data: {
           	 	id: elem.closest('tr').data('id')// То что приходит в request
           	 },//Передаем строкой или объектом
           	 success: function(result){// в result== $request->id из метода контроллера;
           	 	if(result){
           	 		elem.toggleClass('text-muted text-danger');
           	 	}
           	 	//console.log(result);//в случае успеха выполнится ф-я
           	 }
           });//передаем объект
  		});
  	})
    $('.delete-product').click(function(){
        let elem = $(this); // по кот кликаем, указываем в начале, зафиксируем
        let id = elem.closest('tr').data('id');
        $.ajax({
          type: 'DELETE',
          url: '/admin/product/' + id,// куда отправляем данные. путь к php файлу раньше писали 
          // адрес предумываем с / от корня проекта
          data: {},// что отправл/ можно передавть строкой или обьектом
          success: function(result){
            if(result){ // при успешном выполнении
              elem.closest('tr').remove();
            }
          }// то что выводится в функции php editRecommended попадает в result
        }); // передаем обьект в скобках
      });

    $('.price').dblclick(function() {
      let elem = $(this); // по кот кликаем, указываем в начале, зафиксируем
      let id = elem.closest('tr').data('id');
      let val = elem.html();
      let code = '<input type="text" id="edit" value="'+val+'" />';
      $(this).empty().append(code);
      $('#edit').focus();
      $('#edit').blur(function()  {
        let valNew = $(this).val();
        $(this).parent().empty().html(valNew);
        // console.log(id);
        $.ajax({ // функция для отправки и приема данных в параметре принимает обьект
          url: '/admin/edit-price', //functions.php файл будет обрабатывать данные
          type: 'POST',
          data: {// данные, кот будем отправлять: переменную p и action. Если не форма передаем в виде обьекта
            valNew: valNew,
            id: id,
          },
        success: function(){// событие возникает при успешном получении ответа от сервера, books данные приходят в ф-цию как параметр
          console.log('id');
          }
        });
      });
    }); 

 })(jQuery);

