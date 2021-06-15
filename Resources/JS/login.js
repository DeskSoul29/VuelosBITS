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
	data.append("pers_ced", user.value)
	data.append("pers_nombre", pass.value)

	
	
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
		success: respuesta => {

			if(respuesta == 1) {
				const data = JSON.parse(res);
				console.log(data)
			} else {
				console.log(respuesta, "Algo ha salido mal");
			}
		
		}
		console.log(respuesta);
		/* if(!respuesta.error){
			if (respuesta.tipo=='Admin') {
				location='main_app/Admin/admin.php';
			}else if (respuesta.tipo=='Usuario') {
				location='main_app/Usuario/usuario.php';
			}
		}else {
			$('.error').slideDown('slow');
			setTimeout(function(){
				$('.error').slideUp('slow');
			},3000);
			$('.botonlg').val('Iniciar Secion');
		} */
	})
	.fail(function(resp){
		console.log(resp.responseText);
	})
	.always(function(){
		console.log("Complete");
		//$('#btn_login').val('ACCESS');
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

