<main>
<?php
    session_start();

    $rol = $_SESSION['rol'];

    if($rol=="RECEPCIONISTA" ){
        $usuario=$_SESSION['username'];

        $id_res = $_SESSION['id_reserva'];
        $precio = $_SESSION['precio_reserva'];

    }else if($rol=="PASAJERO"){
        header("location: ../Vista/viewUser");
    }else{
        header("location: ../Vista/login");
    }
?>
<a href="viewReception" class="btn"> <--Return </a>
<div class="container py-5">
	
    <!-- For demo purpose -->
    <div class="row mb-4">
        <div class="col-lg-8 mx-auto text-center">
            <h1 class="display-6">Payment Center</h1>
        </div>
    </div> <!-- End -->
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card ">
                <div class="card-header">

                    <div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2">
                        <!-- Credit card form tabs -->
                        <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
                            <li class="nav-item"> <a data-toggle="pill" href="#credit-card" class="nav-link active "> <i class="fas fa-credit-card mr-2"></i> Credit Card </a> </li>
                            <li class="nav-item"> <a data-toggle="pill" href="#pse" class="nav-link "> <i class="fas fa-hand-holding-usd mr-2"></i> PSE </a> </li>
                        </ul>
                    </div> <!-- End -->

                    <!-- Credit card form content -->
                    <div class="tab-content">
                        <!-- credit card info-->
                        <div id="credit-card" class="tab-pane fade show active pt-3">
                            <form role="form" >
								<div class="form-group "> <label for="Select Your Bank">
									<h6>Select your Bank</h6>
								</label> <select class="form-control" id="ccmonth">
									<option value="Value0" selected disabled>--Please select your Bank--</option>
										<option value="Bancolombia">Bancolombia</option>
										<option value="BBVA">BBVA</option>
										<option value="Caja Social">Caja Social</option>
										<option value="Banco Agrario">Banco Agrario</option>
										<option value="Banco falabella">Banco Falabella</option>
								</select> </div>
                                <div class="form-group"> <label for="cardNumber">
                                        <h6>Card number</h6>
                                    </label>
                                    <div class="input-group"> <input type="number" name="cardNumber" id="cardNumber" placeholder="Valid card number" class="form-control " maxlength="19" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required/>
                                        <div class="input-group-append"> <span class="input-group-text text-muted"> <i class="fab fa-cc-visa mx-1"></i> <i class="fab fa-cc-mastercard mx-1"></i> <i class="fab fa-cc-amex mx-1"></i> </span> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group"> <label><span class="hidden-xs">
                                                    <h6>Expiration Date</h6>
                                                </span></label>
                                            <div class="input-group"> <input type="number" id="mm" placeholder="MM" maxlength="2" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="" class="form-control" required> <input type="number" id="yy" placeholder="YY" maxlength="2" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="" class="form-control" required> </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group mb-4"> <label data-toggle="tooltip" title="Three digit CV code on the back of your card">
                                                <h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
                                            </label> <input id="cvv" type="number" maxlength="3" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required class="form-control"> </div>
                                    </div>
                                </div>
								<div class="form-group col-sm-6" style="margin-left: -12px; top:-10px;"> <label for="monto">
                                        <h6>Amount</h6>
								</label> <input type="number" name="monto" required class="form-control" disabled value="<?php echo $precio;?>">  </div>

                                <div class="card-footer"> <button type="button" onclick="creditCard('<?php echo $id_res;?>', '<?php echo $precio;?>');" class="subscribe btn btn-primary btn-block shadow-sm"> Confirm Payment </button>
                            </form>
                        </div>
                    </div> <!-- End -->

                    <!-- PSE info -->
                    <div id="pse" class="tab-pane fade pt-3">
						<form role="form" >
							<div class="form-group"> <label for="email">
									<h6>Email</h6>
								</label> <input type="email" id="email" name="email" placeholder="Email" required class="form-control "> </div>
							<div class="form-group "> <label for="Select Your Bank">
								<h6>Select your Bank</h6>
							</label> <select class="form-control" id="ccmonth2">
								<option value="Value0" selected disabled>--Please select your Bank--</option>
									<option value="Bancolombia">Bancolombia</option>
									<option value="BBVA">BBVA</option>
									<option value="Caja Social">Caja Social</option>
									<option value="Banco Agrario">Banco Agrario</option>
									<option value="Banco Falabella">Banco Falabella</option>
							</select> </div>
							
							<div class="form-group col-sm-6" style="margin-left: -12px;"> <label for="monto">
									<h6>Amount</h6>
							</label> <input type="number" name="monto" required class="form-control" disabled value="<?php echo $precio;?>"> </div>

							<div class="card-footer"> <button type="button" onclick="pse('<?php echo $id_res;?>', '<?php echo $precio;?>');" class="subscribe btn btn-primary btn-block shadow-sm"> Confirm Payment </button>
						</form>
                    </div> <!-- End -->
                   
                </div>
            </div>
        </div>
    </div>
</div>

<div class="popup" id="pop" style="display: none;"> 
    <div class="valid">
        <svg version="1.1" id="Layer_2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
        x="0px" y="0px" width="15px" height="15px" viewBox="222.744 227.408 67.744 58.526"
        enable-background="new 222.744 227.408 67.744 58.526" xml:space="preserve">
            <path fill="#39BA6F" d="M250.062,285.934c-9.435-11.111-15.731-18.195-27.318-28.935l5.793-5.357
	c6.778,3.28,11.076,5.774,18.693,11.204c14.32-16.25,23.783-24.495,41.372-35.438l1.886,4.335
	C275.983,244.402,265.359,258.502,250.062,285.934z" />
        </svg>
    </div>
     <h3 style="margin-left: 47px; color: #fff;">Successful payment!</h3>

    <p  style="margin-left: 19px; color: #fff;">We have received your payment, happy travel</p>
    <div class="bottom-popup" ><a class="start" href="#">NEXT</a>

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
<script src="/Resources/JS/toastr.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
<script src="/Resources/JS/payments.js"></script>

</main> 