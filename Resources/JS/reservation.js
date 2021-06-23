'use strict';
toastr.options.preventDuplicates = true


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
                data.results.forEach(element => {
                    option += `
					<div id="Travels">
						<div class="card">	
							<div class="card-header"><img src="/Resources/Images/calendario.png">
								Date: ${element.fecha_vuelo}
							</div>
							<div class="card-body">
								<h5 class="card-title"><img src="/Resources/Images/viaje-ida-y-vuelta.png">
								 ${element.ciudad_origen_vuelo} <img src="/Resources/Images/flecha-correcta.png" > ${element.ciudad_destino_vuelo}</h5>
								<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
								<a href="#" class="btn btn-primary">RESERVE</a>
							</div>
						</div>
					</div>
                    `
				})
				$("#card > option").remove()

				$("#card").append(option)
			}catch (error){
			}
		}
	});
}); 


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

