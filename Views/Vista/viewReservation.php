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
                                    <li> <a class="active">Flights</a> </li>
                                    <li> <a href="http://127.0.0.1:9000/Vista/reserves">Reserves</a></li>
                                    <li> <a href="http://127.0.0.1:9000/Vista/financialBalance">Financial balance</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <section style="position: relative; box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 8px !important; z-index: 3;">
            <form class="main-form2" id="from-Search" method="POST" action="viewReservation">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-2">
                                <label>Origin</label>
                                <select class="form-control" name="Origen"
                                    class="Travel" id="Origin">
                                    <option> Select</option>
                                    <?php
                                    $mysqli = new mysqli("localhost","desksoul","jcrn2917","db_vuelos");
                                    $resultado = $mysqli->query("SELECT * FROM aeropuerto");
                                    $resultado->data_seek(0);
                                    while ($fila = $resultado->fetch_assoc()) {
                                        if($origen == $fila['ciudad_aeropuerto'])
                                            echo "<OPTION VALUE='". $fila['ciudad_aeropuerto'] ."' selected>". $fila['ciudad_aeropuerto'] ."</OPTION>";
                                        else
                                            echo "<OPTION VALUE='". $fila['ciudad_aeropuerto'] ."'>". $fila['ciudad_aeropuerto'] ."</OPTION>"; 
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-2">
                                <label>Destination</label>
                                <select class="form-control" class="Travel"
                                    name="Destino" id="Destiny" >
                                    <option> Select</option>
                                    <?php
                                    $mysqli = new mysqli("localhost","desksoul","jcrn2917","db_vuelos");
                                    $resultado = $mysqli->query("SELECT * FROM aeropuerto");
                                    $resultado->data_seek(0);
                                    while ($fila = $resultado->fetch_assoc()) {
                                        if($destino == $fila['ciudad_aeropuerto'])
                                            echo "<OPTION VALUE='". $fila['ciudad_aeropuerto'] ."' selected>". $fila['ciudad_aeropuerto'] ."</OPTION>";
                                        else
                                            echo "<OPTION VALUE='". $fila['ciudad_aeropuerto'] ."'>". $fila['ciudad_aeropuerto'] ."</OPTION>"; 
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-2">
                                <label>Date</label>
                                <input class="form-control" id="date" name="Fecha" type="date" min="<?php echo date("Y-m-d");?>" value="<?php echo "$fecha";?>" >
                            </div>

                            <div class="col-1">
                                <label>Adults</label>
                                <input type="number" class="form-control" id="Adults" name="Adulto" min="0" max="9" value="<?php echo "$pasajeroA";?>">
                            </div>

                            <div class="col-1">
                                <label>Children</label>
                                <input type="number" class="form-control" id="Children" name="Ninos" min="0" max="9" value="<?php echo "$pasajeroN";?>">
                            </div>

                            <div class="col-4">
                                <input type="submit" class="btn btn-success btn-lg btn-block" style="top: 25%; position:relative;" value="SEARCH">
                            </div>

                    </div>
                </div>
            </div>
        </form>
    </section>


            
    <section>
        <div class="col-md-12" >
            <div class="row" >

                <div class="col-7" style="background-color: rgb(243, 242, 246); height:418px; overflow:scroll; overflow-x:hidden">                    
                    <div class="jxbuIk">

                        <div class="row">
                            <label style="padding-top: 10px; font-size:20px; color:black">
                            <img src="/Resources/Images/avion.png">  CHOOSE A FLIGHT</label>
                        </div>
                        
                        <div class="row" id="card"></div>

                    </div>
                </div>


                <div id="processR" class="col-5 bg-success">
                    <span id="span1">
                        <img src="/Resources/Images/aeroplane.png" style="display: block; margin:auto; margin-top: 120px;">
                        <h5 style="text-align: center; top:10px; color: #0c4e80">You have not yet selected a flight</h5>
                        <h6 style="text-align: center;">Your flights will appear here once you select them.</h6>
                    </span>
                </div>

            </div>
        </div>
    </section>



    <aside id="modal" class="modal">
        <div class="content-modal">
            <header>
                <a href="#" class="close-modal">X</a>
                <h2>DO YOU WANT TO ADD LUGGAGE?</h2>
            </header>
            <article style="color: beige;">
                
                <div class="row" style="position:relative; ">
                    <img style="display: block; margin:auto; margin-top: 20px;" src="/Resources/Images/maleta.png"></img>
                </div>
                <input type="radio" id="b1" name="cbox" value="Small" style="margin-left: 90px;" > Small
                <input type="radio" id="b2" name="cbox" value="Medium" style="margin-left: 30px;"> Median
                <input type="radio" id="b3" name="cbox" value="Grande" style="margin-left: 30px;"> Large <br>
                
                <a href="#" onclick="addBaggage('No');" class="btn btn-warning" style="margin-left:30px; margin-top: 40px;">Continue Without Luggage</a>
                <a href="#" onclick="addBaggage('Yes');" class="btn btn-success" style="margin-left:30px; margin-top: 40px;">Add Luggage</a>
            </article>            
        </div>
    </aside>
   

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/Resources/JS/jquery-3.4.1.min.js"></script>
    <script src="/Resources/JS/toastr.min.js"></script>
    <script src="/Resources/JS/reservation.js"></script>

    <script>
        $(function(){

            const origen = document.getElementById("Origin");
            const destino = document.getElementById("Destiny");
            const fecha = document.getElementById("date");

            let data = new FormData()
            data.append("origen",origen.value);
            data.append("destino",destino.value);
            data.append("fecha",fecha.value);

            $.ajax({
                url: "http://127.0.0.1:9000/Persona/getFlights",
                data,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: res => {
                    try{
                        let data = JSON.parse(res)
                        let option = ""
                        let add = ""

                        if(JSON.stringify(data.results) !== '[]'){

                            data.results.forEach(element => {
                                option += `
                                <div id="Travels">
                                    <div class="card" style="width: 533px;">
                                        <div class="card-header" id="h_p" >
                                            
                                            <span class="adGREEN">
                                                AVAILABLE
                                            </span>
                                            <img src="/Resources/Images/calendario.png">
                                            Date: ${element.fecha_vuelo}
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title"><img src="/Resources/Images/viaje-ida-y-vuelta.png">
                                            ${element.ciudad_origen_vuelo} <img src="/Resources/Images/flecha-correcta.png" > ${element.ciudad_destino_vuelo}</h5>
                                            <a class="card-text"> <img src="/Resources/Images/tarjeta-de-embarque.png"> CODE: ${element.id_vuelo} </a><br>
                                            <a class="card-text"> <img src="/Resources/Images/pasajero.png"> Passengers: ${50 - element.suma}</a></br>
                                            <a class="card-text"> <img src="/Resources/Images/money.png"> COP: $700,000 </a>
                                            <a href="#modal" onclick="addReserv(${element.id_vuelo}, '${element.ciudad_origen_vuelo}', '${element.ciudad_destino_vuelo}', '${element.fecha_vuelo}');" class="btn btn-primary" style="transition: all 0.15s linear; color:#ffff; right: 10px; position:absolute; bottom:10px; ">RESERVE</a>
                                        </div>
                                    </div>
                                </div>
                                `
                            })
                            $("#card > option").remove()
                            $("#card").append(option)

                        }else{
                            add = `
                            <span>
                                <img src="/Resources/Images/not-flights.png" style="display: block; margin:auto; margin-top: 30px;">
                                <h5 style="text-align: center; top:10px; color: #0c4e80">There are no flights for this date</h5>
                                <h6 style="text-align: center;">Please try again with a different date</h6>
                            </span>
                            `
                            $("#card").append(add)
                        }	
                    }catch (error){
                        
                    }
                }
            });
        });
    </script>
</main>

