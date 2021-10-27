	$(document).ready( function (e) {
		$('input[name=output]').on ('click', function(d){
			$.ajax({
				type : 'post',
				url : 'server.php',
				data : {direction: $('textarea[name=txtdirection]').val()},
				dataType: 'json',
				success: function(data){
					$('.child-grid').removeClass('fa-arrow-left').removeClass('fas');
					$('.child-grid').removeClass('fa-arrow-right').removeClass('fas');
					$('.child-grid').removeClass('fa-arrow-up').removeClass('fas');
					$('.child-grid').removeClass('fa-arrow-down').removeClass('fas');

					$('.' + data.position).addClass(data.arrow);
					$('.result').html(data.full_result);
				}
			});
		});
	});

//request handler//

