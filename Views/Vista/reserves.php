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
                            
                            $resultado = $mysqli->query("SELECT reserva.vuelo_id, reserva.nombre_reserva, reserva.valor_pasaj, vuelos.ciudad_origen_vuelo, vuelos.ciudad_destino_vuelo, pasaXreser.estado_pago, reserva.cant_pasaj 
                                        FROM reserva 
                                        LEFT JOIN vuelos ON reserva.vuelo_id = vuelos.id_vuelo 
                                        LEFT JOIN pasaXreser ON pasaXreser.nombre_reserva = reserva.nombre_reserva
                                        WHERE pasaXreser.estado_pago = 'SIN PAGAR'
                                        GROUP BY reserva.nombre_reserva;");
                            
                            $row_cnt = $resultado->num_rows;
                            $resultado->data_seek(0);
                                while ($fila = $resultado->fetch_assoc()) {

                                    echo "
                                    <div class='col-sm-3' style='margin-bottom:20px;'>
                                        <div class='card border-primary mb-3'>
                                            <div class='card-body'>
                                                <h5 class='card-title'><img src='/Resources/Images/viaje-ida-y-vuelta.png'> ".$fila['ciudad_origen_vuelo']." -> ".$fila['ciudad_destino_vuelo']."</h5>
                                                <ul class='list-group list-group-flush'>
                                                    <li class='list-group-item'><img src='/Resources/Images/estado-financiero.png'> ID Airplane: ".$fila['vuelo_id']."</li>
                                                    <li class='list-group-item'><img src='/Resources/Images/tarjeta-de-embarque.png'> ID Reserve: ".$fila['nombre_reserva']."</li>
                                                    <li class='list-group-item'><img src='/Resources/Images/pasajero.png'> Passengers: ".$fila['cant_pasaj']."</li>
                                                    <li class='list-group-item'><img src='/Resources/Images/money.png'> Value: $".number_format($fila['valor_pasaj'])."</li>
                                                </ul>
                                            </div>
                                            <div class='card-footer bg-transparent border-primary' style='align-content: center; display: grid;'>
                                                <a onclick='addPay(".$fila['nombre_reserva'].", ".$fila['valor_pasaj'].");' class='btn btn-success' style='margin-bottom:8px;color: #fff;'>Pay</a>
                                                <a onclick='deleteReserv(".$fila['nombre_reserva'].");' class='btn btn-danger' style='color: #fff;'>Delete Reserve</a>
                                            </div>
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

<script>
    function addPay(id, monto){
        let data = new FormData()
        data.append("id_res",id)
        data.append("monto",monto)

        $.ajax({
            url: "http://127.0.0.1:9000/Persona/addPay",
            data,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
        }).done(function(respuesta){
            location='payments';
            
        })
    }

    function deleteReserv(id){
        let data = new FormData()
        data.append("id_res",id);

        $.ajax({
            url: "http://127.0.0.1:9000/Persona/deleteRes",
            data,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
        }).done(function(respuesta){
            if(respuesta != 1){
                toastr.error("Error")
            }else{
                location.reload();
            }
        })
    }   
</script>

</main>