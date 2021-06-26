$(function(){
    const origen = document.getElementById("Origin");
	const destino = document.getElementById("Destiny");
	const fecha = document.getElementById("date");

	let data = new FormData()
	data.append("origen",origen.value);
	data.append("destino",destino.value);
	data.append("fecha",fecha.value);

	$.ajax({
		url: "http://127.0.0.1:9000/Persona/getFlights",
        data,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: res => {
			try{
				let data = JSON.parse(res)
                let option = ""
				let add = ""

				if(JSON.stringify(data.results) !== '[]'){

					data.results.forEach(element => {
						const toogle = toogleP(JSON.stringify(element.id_vuelo));
						option += `
						<div id="Travels">
							<div class="card" style="width: 533px;">
								<div class="card-header">
									<img src="/Resources/Images/calendario.png">
									Date: ${element.fecha_vuelo}
								</div>
								<div class="card-body">
									<h5 class="card-title"><img src="/Resources/Images/viaje-ida-y-vuelta.png">
									${element.ciudad_origen_vuelo} <img src="/Resources/Images/flecha-correcta.png" > ${element.ciudad_destino_vuelo}</h5>
									<a class="card-text"> <img src="/Resources/Images/tarjeta-de-embarque.png"> CODE: ${element.id_vuelo} </a><br>
									<a class="card-text"> <img src="/Resources/Images/pasajero.png"> Passengers:  </a></br>
									<a class="card-text"> <img src="/Resources/Images/money.png"> COP: $700.000 </a>
									<a href="#modal" onclick="addReserv(${element.id_vuelo}, '${element.ciudad_origen_vuelo}', '${element.ciudad_destino_vuelo}', '${element.fecha_vuelo}');" class="btn btn-primary" style="transition: all 0.15s linear; color:#ffff; right: 10px; position:absolute; bottom:10px; ">RESERVE</a>
								</div>
							</div>
						</div>
						`
					})
					$("#card > option").remove()
					$("#card").append(option)
				}else{
					add = `
					<span>
						<img src="/Resources/Images/not-flights.png" style="display: block; margin:auto; margin-top: 30px;">
						<h5 style="text-align: center; top:10px; color: #0c4e80">There are no flights for this date</h5>
						<h6 style="text-align: center;">Please try again with a different date</h6>
					</span>
					`
					$("#card").append(add)
				}	
			}catch (error){
				
			}
		}
	});
}); 
