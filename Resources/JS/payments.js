toastr.options.preventDuplicates = true

$(function() {
	$('[data-toggle="tooltip"]').tooltip()
})

$('a.start').click(function (event) {
	$('.popup').hide("slow");
	location='viewReception';
});


function pse(id_reser, monto){
	var todo_correct= true;
	
	
	if(document.getElementById("email").value == ""){
		todo_correct = false;
	}
	if(document.getElementById("ccmonth2").value == "Value0"){
		todo_correct = false;
		
	}

	if(!todo_correct){
		alert("Missing data to fill")
		event.preventDefault()
		
	}else{
		var email = document.getElementById("email").value;
		var banco = document.getElementById("ccmonth2").value;

		let data = new FormData()
		data.append("id_res",id_reser);
		data.append("monto",monto);
		data.append("email",email);
		data.append("banco",banco)
		$.ajax({
			url: "http://127.0.0.1:9000/Persona/updateResPSE",
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
				document.getElementById("pop").removeAttribute("style");				
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

function creditCard(id_reser, monto){
	var todo_correct= true;
	
	
	if(document.getElementById("ccmonth").value == "Value0"){
		todo_correct = false;
	}
	if(document.getElementById("cardNumber").value == ""){
		todo_correct = false;
	}
	if(document.getElementById("mm").value == ""){
		todo_correct = false;
	}
	if(document.getElementById("cvv").value == ""){
		todo_correct = false;
	}
	if(document.getElementById("yy").value == ""){
		todo_correct = false;
	}

	if(!todo_correct){
		alert("Missing data to fill")
		event.preventDefault()
	}else{
		var banco = document.getElementById("ccmonth").value;
		var mes = document.getElementById("mm").value;
		var ano = document.getElementById("yy").value;
		var cvv = document.getElementById("cvv").value;
		var num = document.getElementById("cardNumber").value;
		var fcad = mes+"/"+ano;

		let data = new FormData()
		data.append("id_res",id_reser);
		data.append("monto",monto);
		data.append("banco",banco);
		data.append("fcad",fcad);
		data.append("cvv",cvv);
		data.append("num",num);

		$.ajax({
			url: "http://127.0.0.1:9000/Persona/updateResCREDIT",
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
				document.getElementById("pop").removeAttribute("style");
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
