"use strict";
toastr.options.preventDuplicates = true


$('#Origin').change(function(){
	$('#Destiny').removeAttr('disabled');
});

$('#Adults').change(function(){
	$('#Children').removeAttr('disabled');
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


$(function(){
	$.ajax({
		url: "http://127.0.0.1:9000/Persona/obtenerTodo",
        data: {},
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: res => {
			try{
				let data = JSON.parse(res)
                let option = "<option>Select</option>"
                data.results.forEach(element => {
                    option += `
						<option value="${element.ciudad_aeropuerto}">${element.ciudad_aeropuerto}</option>
                    `
				})
				$("#Origin > option").remove()
				$("#Destiny > option").remove()

                $("#Origin").append(option)
				$("#Destiny").append(option)
			}catch (error){
				console.log(error)
			}
		}
	});
});


