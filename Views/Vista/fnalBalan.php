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


</main>