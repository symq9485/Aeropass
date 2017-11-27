$(document).ready(function(){
	$(document).on('click','#rpasajero',function()	{
		$.ajax({
			url: 'registro01.php',
			type: 'POST',
			data: {ciPasajero: $('#ciPasajero').val(), nombrePasajero: $('#nombrePasajero').val(), apellidoPasajero: $('#apellidoPasajero').val(), telfPasajero: $('#telfPasajero').val(), numVuelo: $('#numVuelo').val(), cTipo: $('#cTipo').val()},
			beforeSend: function(){
				console.log($('#ciPasajero').val());
				console.log($('#nombrePasajero').val());
        console.log($('#apellidoPasajero').val());
        console.log($('#telfPasajero').val());
        console.log($('#numVuelo').val());
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
