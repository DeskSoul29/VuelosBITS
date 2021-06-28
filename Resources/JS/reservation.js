'use strict';
toastr.options.preventDuplicates = true


function addReserv(id, origen, destino, fecha){
	document.getElementById("span1").setAttribute("style","display: none;")
	var adult = parseFloat(document.getElementById("Adults").value);
	var children = parseFloat(document.getElementById("Children").value);
	var suma = adult + children;
	var precio = suma* 700000;

	let reser = `
	<from id='from-Reserv'>
		<div id="reservCard" class="card " style="margin-top: 15px">
			<div class="card-header" >
				RESERVATION IN PROCESS
			</div>
			<div class="card-body">
				<div class="row">
					<h5 class="card-title col-8" >${origen} -> ${destino}</h5>
					<h6 class="card-title col-4">${fecha}</h6>
				</div>
				<p class="card-text">
					<img src="/Resources/Images/maletas.png"> Baggage: <strong id="pasaje">---</strong><br>
					<img src="/Resources/Images/pasajero.png"> Passengers: ${suma}<br>
					<img src="/Resources/Images/money.png"> Total price: $${precio}<br>
				</p>
			</div>
			<div class="card-footer text-muted">
				<a href="#"	id="btn-abrir-popup" onclick="createReserv('${id}','${origen}', '${destino}', ${suma}, ${precio});" class="btn btn-success" style="margin-left: 5px;">Next</a>
				<button id='btnpagar' onclick="pasar();" class="btn btn-danger" style="margin-left: 80px;" disabled>Pay</button>
				<a href="#" onclick="deleteReserv();" class="btn btn-warning" style="margin-left: 80px;">Change</a>
			</div>
		</div>
		</from>
	`;
	$("#processR").append(reser)

	document.getElementById("card").setAttribute("style","display: none;")

}

function pasar(){
	location='payments'
}

function createReserv(id, origen, destino, pasajeros, precio){
	
	let maleta = document.getElementById("pasaje").innerHTML;
	var seleccion = $('input[name="cbox"]:checked').val();


	var id_res = Math.floor(Math.random() * (10000 - 999)) + 999;

	if(seleccion == undefined){
		seleccion = "Small"
	}
	

	let data = new FormData()
	data.append("id_vuelo",id);
	data.append("id_res",id_res);
	data.append("origen",origen);
	data.append("destino",destino);
	data.append("pasajeros",pasajeros);
	data.append("maleta",maleta);
	data.append("precio",precio);
	data.append("check",seleccion);


	var jqxhr = $.ajax({
		url: "http://127.0.0.1:9000/Persona/uploadReservation",
		data,
		cache: false,
		contentType: false,
		processData: false,
		type: 'POST',
	})
	.done(function(respuesta){
		if(respuesta != 1){
			console.log(respuesta)
		}else{
			addPassengers(id_res, pasajeros);
		}
	})
	.fail(function(resp){
		console.log(resp.responseText);
	})
	.always(function(e){
	})
}

function addPassengers(id_res, pasajero){
	for (let i = 0; i < pasajero; i++) {
		var texto = prompt("Passenger -> Digite cedula");

		while(texto == ""){
			var texto = prompt("Passenger "+(i+1)+"-> Digite cedula");
		}
 
		let data = new FormData()
		data.append("pasajero",texto);
		data.append("id_res",id_res);

		var open = $.ajax({
			url: "http://127.0.0.1:9000/Persona/uploadPassengers",
			data,
			cache: false,
			contentType: false,
			processData: false,
			type: 'POST',
		})
		.done(function(respuesta){
			if(respuesta != 1){
				toastr.error(respuesta)
			}else{
				$("#btnpagar").removeAttr("disabled");
			}
		})
		.fail(function(resp){
			console.log(resp.responseText);
		})
		.always(function(){
			console.log("Complete");

		});
	}
}

function prevent(event){
	event.preventDefault()
}

function deleteReserv(){
	var reserv = document.getElementById("from-Reserv");	
	var padre = reserv.parentNode;
	padre.removeChild(reserv);

	document.getElementById("card").removeAttribute("style")

	document.getElementById("span1").removeAttribute("style")
}

function addBaggage(res){
	document.getElementById("pasaje").innerHTML = res;
	
	document.getElementById("b1").checked = false;
	document.getElementById("b2").checked = false;
	document.getElementById("b3").checked = false;
}


document.getElementById("from-Search").addEventListener("submit", function(event){
	var todo_correcto = true;

	if(document.getElementById("Origin").value == "Select"){
		todo_correcto = false;
		toastr.error("Select an Origin")
	}

	if(document.getElementById("Destiny").value == "Select"){
		todo_correcto = false;
		toastr.error("Select a Destination")
	}

	if(document.getElementById("Destiny").value == document.getElementById("Origin").value){
		todo_correcto = false;
		toastr.error("Select a different Destination")
	}

	if(document.getElementById('date').value == null || document.getElementById('date').value == ""){
        todo_correcto = false;
		toastr.error("Select a Date")
    }

	if(document.getElementById("Adults").value == "0" && document.getElementById("Children").value != "0"){
		toastr.error("All children must be accompanied by an adult")
		todo_correcto = false;
	}else if(document.getElementById("Adults").value == "0" || document.getElementById("Adults").value == ""){
		toastr.error("There must be at least one adult")
		todo_correcto = false;
	} 

	if(!todo_correcto) 
        event.preventDefault();
    
});

