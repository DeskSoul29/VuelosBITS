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

            $piloto = 2000000;
            $comOper = 1800000;
            $comisar = 1500000;
            $azafata = 1800000;
            $combstible = 5782194;


            unset($_SESSION['id_reserva']);
            unset($_SESSION['precio_reserva']);
            
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
                                <li> <a href="http://127.0.0.1:9000/Vista/reserves">Reserves</a></li>
                                <li> <a class="active">Financial balance</a></li>
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
                                $resultado = $mysqli->query("SELECT vuelos.id_vuelo, vuelos.ciudad_origen_vuelo, vuelos.ciudad_destino_vuelo, vuelos.fecha_vuelo, COUNT(pasaXreser.estado_pago)as sum 
                                        FROM vuelos
                                            LEFT JOIN reserva ON reserva.vuelo_id = vuelos.id_vuelo
                                            LEFT JOIN pasaXreser ON pasaXreser.nombre_reserva = reserva.nombre_reserva
                                            WHERE pasaXreser.estado_pago= 'PAGADO' 
                                            GROUP BY vuelos.id_vuelo; ");
                                
                                $row_cnt = $resultado->num_rows;
                                $resultado->data_seek(0);
                                    while ($fila = $resultado->fetch_assoc()) {
                                        echo "
                                        <div class='col-sm-4' style=' font-size: 10px;'>
                                            <div class='card border-primary mb-3'>
                                                <form action='generar/generar-pdf.php'>
                                                    <div class='card-body' >
                                                        <h5 class='card-title'><img src='/Resources/Images/viaje-ida-y-vuelta.png'> ".$fila['ciudad_origen_vuelo']." -> ".$fila['ciudad_destino_vuelo']."</h5>
                                                        <div class='row'>
                                                            <div class='col'>
                                                                <ul class='list-group list-group-flush'>
                                                                    <li class='list-group-item'><img src='/Resources/Images/estado-financiero.png'> ID Airplane: ".$fila['id_vuelo']."</li>
                                                                    <li class='list-group-item'><img src='/Resources/Images/calendario.png'> Date: ".$fila['fecha_vuelo']."</li>
                                                                    <li class='list-group-item'><img src='/Resources/Images/pasajero.png'> Passengers: ".$fila['sum']."</li>
                                                                    <li class='list-group-item'><img src='/Resources/Images/money.png'> Value: $".number_format(($fila['sum'])*700000)."</li>
                                                                </ul>
                                                            </div>
                                                            <div class='col'>
                                                                <ul class='list-group list-group-flush'>
                                                                    <li class='list-group-item'> Pilot: $".number_format($piloto)."</li>
                                                                    <li class='list-group-item'> Communications Operators: $".number_format($comOper)."</li>
                                                                    <li class='list-group-item'> Commissar: $".number_format($comisar)."</li>
                                                                    <li class='list-group-item'> Stewardess: $".number_format($azafata)."</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class='row'>
                                                            <h6 class='card-header'>Fuel: $".number_format($combstible)." </h6>
                                                            <h6 class='card-header'>Crew: $".number_format(($piloto*2)+($azafata*4)+($comisar*2)+$comOper)." </h6>
                                                            <h6 class='card-header'>Total Earnings: $".number_format(($fila['sum'])*700000)."</h6>
                                                        </div>
                                                    </div>
                                                    <div class='card-footer bg-transparent border-primary' style='align-content: center; display: grid;'>
                                                        <a onclick='printReport();' class='btn btn-success' style='color: #fff;'>Print Report</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div> ";   
                                    }
                            ?>        
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/Resources/JS/jquery-3.4.1.min.js"></script>
<script src="/Resources/JS/toastr.min.js"></script>
<script src="/Resources/JS/fnalBalan.js"></script>

</main>