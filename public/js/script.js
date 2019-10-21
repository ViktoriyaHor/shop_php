
(function($){
        $(document).ready(function(){
        
           
          $.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});//для безопасной передачи данных, общие параметры для ajax запросов
           

           $('.add-to-card').submit(function(e){
             e.preventDefault();

             $.ajax({
             	type: 'POST',
             	url: '/add-to-cart',
             	data: $(this).serialize(),//serialize() собирает все данные формы, кодирует их и преобразует в строку, This это форма
             	success: function(result){//result то что выводит метод контроллера
             		//console.log(result);
             		showCart(result);
             	}
             });
           });
            // document.body.addEventListener('click', function({})); this - body, e.target - олучаем то,
            // по чему конкретно кликнули
            // let el = e.target;
            // if (el.classList.contains('rem-prod '))тогда ajax
            
            $('body').on('click', '.remove-product', function(e){// сначала обращаемся к родительскому, чтоб срабатывало
                // .remove для новых добавленных срабатывало.
                e.preventDefault();
                let elem = $(this); // по кот кликаем, указываем в начале, зафиксируем
                let id = elem.data('id');
                 $.ajax({
                    type: 'POST',
                    url: '/remove-from-cart',
                    data: {id: id},//serialize() собирает все данные формы, кодирует их и преобразует в строку, This это форма
                    success: function(result){//result то что выводит метод контроллера
                        //console.log(result);
                        showCart(result);
                    }
                 });
            });
			function showCart(result) {
				$('#exampleModal .modal-body').html(result);//modal-body для перезаписи корзины
				$('#exampleModal').modal();//при клике окно
			}


           $('.clear-cart').click(function(e){
             e.preventDefault();

             $.ajax({
             	type: 'POST',
             	url: '/clear-cart',
             	success: function(result){//result то что выводит метод контроллера
             		//console.log(result);
             		showCart(result);
             	}
             });
           });




    });
    })(jQuery);
    