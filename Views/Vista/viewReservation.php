<main style="overflow-y: hidden;">

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
                                    <li> <a href="#about">About</a> </li>
                                    <li> <a href="#travel">Travel</a></li>
                                    <li> <a href="#blog">Blog</a></li>
                                    <li> <a href="#contact">Contact Us</a></li>
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
        <div class="col-md-12 " >
            <div class="jsmvKK">
                <div class="col-7" style="background-color: rgb(243, 242, 246);">
                    <div class="jxbuIk">
                        
                        <div class="row">
                            <label style="padding-top: 10px; font-size:20px; color:black">
                            <img src="/Resources/Images/avion.png">  Choose a flight</label>
                        </div>
                        
                        <div class="row" id="card">


                        <div id="Travels">
						<div class="card">
							<div class="card-header ">
                                <span>
                                    <div class="adGREEN">
                                        sold out
                                    </div>
                                </span>
                                <img src="/Resources/Images/calendario.png">
                                    Date: ${element.fecha_vuelo}
                            </div>
                                
							
							<div class="card-body">
								<h5 class="card-title"><img src="/Resources/Images/viaje-ida-y-vuelta.png">
								 Cucuta <img src="/Resources/Images/flecha-correcta.png" > Bogota</h5>
								<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
								<a href="#" class="btn btn-primary">RESERVE</a>
							</div>
						</div>
					</div>

                        
					    </div>
                    </div>
                </div>

                <div class="col-5"">

                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/Resources/JS/jquery-3.4.1.min.js"></script>
    <script src="/Resources/JS/toastr.min.js"></script>
    <script src="/Resources/JS/reservation.js"></script>

</main>