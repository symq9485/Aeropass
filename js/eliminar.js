$(document).ready(function(){
	$(document).on('click','#epasajero',function()	{
		$.ajax({
			url: 'eliminar01.php',
			type: 'POST',
			data: {ciPasajero: $('#ciPasajero').val(), cTipo: $('#cTipo').val()},
			beforeSend: function(){
				console.log($('#ciPasajero').val());
        console.log($('#cTipo').val());
			}
		})
		.done(function(output){
			console.log(output);
			$('#datos').empty().append(output);
		})
		.fail(function(){
			console.log('error');
		})
		.always(function(){
			console.log("complete");
		});
	})
})
