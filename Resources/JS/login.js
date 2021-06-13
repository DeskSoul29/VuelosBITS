//Data Form
document.getElementById("btn_login").addEventListener("click", function( event ) {
	searchUser()
}, false);


function searchUser(){
	const user = document.getElementById('userLog');
	const pass = document.getElementById('passLog');

	let data = FormData()
	data.append("", user.value);
	data.append("", pass.value);

	$.ajax({
		url: "http://127.0.0.1:9000/Persona/Users",
		data,
		cache: false,
        contentType: false,
		processData: false,
        type: 'POST',
		success: res => {
			if (res == 1) {
				user.value = "";
				pass.value = "";
			}else toastr.error(res, "Algo ha salido mal")
		}
	});
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

