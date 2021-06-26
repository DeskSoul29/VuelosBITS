<main>
<?php
    session_start();

    $rol = $_SESSION['rol'];

    if($rol=="RECEPCIONISTA" ){
        $usuario=$_SESSION['username'];

        $id_res = $_SESSION['id_reserva'];
        $precio = $_SESSION['precio_reserva'];
        $origen = $_SESSION['org_res'];
        $destino = $_SESSION['des_res'];

    }else if($rol=="PASAJERO"){
        header("location: ../Vista/viewUser");
    }else{
        header("location: ../Vista/login");
    }
?>    

<header>
    <div class="header">
        <div class="header_white_section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                    <div class="header_information">
                        <ul style="margin-right: 65px;">
                            <li id="nameUser"><img src="/Resources/Images/profile-user.png"/><a> <?php echo"Welcome, $usuario";?>  </a></li>
                            <li id="signOff"><img src="/Resources/Images/sign_off.png" alt="#"/><a href="/Models/logout.php"> SIGN OFF</a></li>
                        </ul>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col ">
                    <div class="full">
                        <div class="logo"><img src="/Resources/Images/log.png" alt="#"></a> </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                    <div class="menu-area">
                            <nav class="main-menu">
                                <ul class="menu-area-main">
                                <li><a href="http://127.0.0.1:9000/Vista/viewReception">Home</a> </li>
                                <li><a href="http://127.0.0.1:9000/Vista/reserves">Reserves</a></li>
                                <li><a class="active">Payments</a></li>
                                <li><a href="http://127.0.0.1:9000/Vista/financialBalance">Financial balance</a></li>
                                </ul>
                            </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<section>
        <div class="col-md-12" >
            <div class="row" >
                <div class="col-7" style="background-color: rgb(243, 242, 246); height:499px; overflow:scroll; overflow-x:hidden">
                    <div class="jxbuIk">

                        <div class="row">
                            <label style="padding-top: 10px; font-size:20px; color:black">
                            <img src="/Resources/Images/pasajero.png">  DATA OF THE PASSENGERS</label>
                        </div>

                        <div class="row">
                            <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                                <div class="card-header">PASSENGERS -> <?php echo $id_res;?></div>
                                <div class="card-body">
                                    <h5 class="card-title"> <?php echo "$origen -> $destino" ;?> </h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-5 bg-success" id="card">
                
                </div>

            </div>
        </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/Resources/JS/jquery-3.4.1.min.js"></script>
<script src="/Resources/JS/toastr.min.js"></script>
<script src="/Resources/JS/passengers.js"></script>

</main>