function deleteReserv(id){
    let data = new FormData()
	data.append("id_res",id);

    $.ajax({
        url: "http://127.0.0.1:9000/Persona/uploadPassengers",
        data,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
    }).done(function(respuesta){
		if(respuesta != 1){
			toastr.error("Error")
		}else{
			toastr.success('Elimindado Correctamente', 'Proceso Exitoso')
		}
	})
}               
                    
