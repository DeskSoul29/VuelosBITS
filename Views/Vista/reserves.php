<main>

    <?php
        session_start();

        $rol= $_SESSION['rol'];

        if($rol=="RECEPCIONISTA" ){
            $usuario=$_SESSION['username'];

            $origen= $_POST['Origen'];
            $destino= $_POST['Destino'];
            $pasajeroA= $_POST['Adulto'];
            $pasajeroN= $_POST['Ninos'];
            $fecha= $_POST['Fecha'];


            unset($_SESSION['id_reserva']);
            unset($_SESSION['precio_reserva']);
            unset($_SESSION['cant_pasajeros']);
            unset($_SESSION['org_res']);
            unset($_SESSION['des_res']);
            
        }else if($rol=="PASAJERO"){
            header("location: ../Vista/viewUser" );
        }else{
            header("location: ../Vista/login" );
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
                                <li id="nameUser"><img
                                        src="/Resources/Images/profile-user.png"/><a>
                                        <?php 
                                            echo" Welcome, $usuario";
                                        ?>
                                        </a></li>
                                    <li id="signOff"><img
                                            src="/Resources/Images/sign_off.png"/><a
                                            href="/Models/logout.php">
                                            SIGN OFF</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col">
                        <div class="full">
                            <div class="logo">
                                <img src="/Resources/Images/log.png"></a> 
                            </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                    <div class="menu-area">
                        <nav class="main-menu">
                            <ul class="menu-area-main">
                                <li> <a href="http://127.0.0.1:9000/Vista/viewReception">Home</a></li>
                                <li> <a class="active">Reserves</a></li>
                                <li> <a href="http://127.0.0.1:9000/Vista/financialBalance">Financial balance</a></li>
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
                <div class="col-12" style="background-color: rgb(243, 242, 246); height:499px; overflow:scroll; overflow-x:hidden">
                    <div class="jxbuIk">

                    <div class="row" id="cardRes">

                        <?php
                            $mysqli = new mysqli("localhost","desksoul","jcrn2917","db_vuelos");
                            $resultado = $mysqli->query("SELECT reserva.nombre_reserva, reserva.valor_pasaj, vuelos.ciudad_origen_vuelo, vuelos.ciudad_destino_vuelo, pasaXreser.estado_pago, reserva.cant_pasaj 
                                        FROM reserva 
                                        LEFT JOIN vuelos ON reserva.vuelo_id = vuelos.id_vuelo 
                                        LEFT JOIN pasaXreser ON pasaXreser.nombre_reserva = reserva.nombre_reserva
                                        WHERE pasaXreser = 'SIN PAGAR';");
                            $resultado->data_seek(0);
                            while ($fila = $resultado->fetch_assoc()) {
                                echo "
                                <div class='col-sm-3' style='margin-bottom:20px;'>
                                    <div class='card border-primary mb-3'>
                                        <div class='card-body'>
                                            <h5 class='card-title'><img src='/Resources/Images/viaje-ida-y-vuelta.png'> ".$fila['ciudad_origen_vuelo']." -> ".$fila['ciudad_destino_vuelo']."</h5>
                                            <ul class='list-group list-group-flush'>
                                                <li class='list-group-item'><img src='/Resources/Images/estado-financiero.png'> Status: ".$fila['estado_pago']."</li>
                                                <li class='list-group-item'><img src='/Resources/Images/tarjeta-de-embarque.png'> ID Reserve: ".$fila['nombre_reserva']."</li>
                                                <li class='list-group-item'><img src='/Resources/Images/pasajero.png'> Passengers: ".$fila['cant_pasaj']."</li>
                                                <li class='list-group-item'><img src='/Resources/Images/money.png'> Value: $".$fila['valor_pasaj']."</li>
                                            </ul>
                                        </div>
                                        <div class='card-footer bg-transparent border-primary' style='align-content: center; display: grid;'>
                                            <a onclick='deleteReserv(".$fila['nombre_reserva'].");' class='btn btn-danger' style='color: #fff;'>Delete Reserve</a>
                                        </div>
                                    </div>
                                </div> 
                                ";    
                            }

                        ?>
                        
                    
                        <!-- <div class="col-sm-4" style="margin-bottom:20px;">
                            <div class="card border-primary mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Cucuta -> Bogota</h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">Cras justo odio</li>
                                        <li class="list-group-item">Dapibus ac facilisis in</li>
                                        <li class="list-group-item">Vestibulum at eros</li>
                                    </ul>
                                </div>
                                <div class="card-footer bg-transparent border-primary" style="align-content: center; display: grid;">
                                    <a href="#" class="btn btn-primary" >Go somewhere</a>
                                </div>
                            </div>
                        </div> -->
                        
                    
                    </div>


                        <!-- <div class="card" style="margin-bottom: 30px;">
                            <div class="card-body">
                            <h5 class="card-title">Cucuta -> Bogota</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Cras justo odio</li>
                                <li class="list-group-item">Dapibus ac facilisis in</li>
                                <li class="list-group-item">Vestibulum at eros</li>
                            </ul>
                            <a class="card-text">ID Reserva: </a><br>
                            <a class="card-text">Estado: </a><br>
                            <a class="card-text">Precio: </a><br>
                            <a href="#" style="margin-left:1080px;" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div> -->
                        
                    </div>
                </div>

               

            </div>
        </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/Resources/JS/jquery-3.4.1.min.js"></script>
<script src="/Resources/JS/toastr.min.js"></script>
<script src="/Resources/JS/deleteRes.js"></script>

</main>