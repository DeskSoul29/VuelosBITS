"use strict";

const user = document.getElementById('userLog');
const pass = document.getElementById('passLog');

//Data Form
document.getElementById("btn_login").addEventListener("click", function( event ) {
	if(user.value!=="" && pass.value!==""){
		searchUser();
	}
}, false);


function searchUser(){
	let data = new FormData()
	data.append("userLG", user.value)
	data.append("passLG", pass.value)

	$.ajax({
		url: 'http://127.0.0.1:9000/Persona/users',
		type: 'POST',
		cache: false,
		contentType: false,
		processData: false,
		data,
		beforeSend: function(){
			$('#btn_login').val('Validando...');
		}
	})
	.done(function(respuesta){
		const obj = JSON.parse(respuesta);
		if(!obj.error){
			if (obj.rol == 'RECEPCIONISTA') {
				location='viewReception';
			}else if (obj.rol == 'PASAJERO') {
				location='viewUser';
			}

		} else {
			$('.error').slideDown('slow');
			setTimeout(function(){
				$('.error').slideUp('slow');
			},5000);

			$('#btn_login').val('ACCESS');
		}
	})
	.fail(function(resp){
		console.log(resp.responseText);
	})
	.always(function(){
		console.log("Complete");
	});

	user.value = "";
	pass.value = "";
}


//Animations
const inputs = document.querySelectorAll(".input");

function addcl(){
	let parent = this.parentNode.parentNode;
	parent.classList.add("focus");
}
function remcl(){
	let parent = this.parentNode.parentNode;
	if(this.value == ""){
		parent.classList.remove("focus");
	}
}

inputs.forEach(input => {
	input.addEventListener("focus", addcl);
	input.addEventListener("blur", remcl);
});

