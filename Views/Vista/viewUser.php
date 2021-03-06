<main>
   <script>
      window.onload = classLoading();
      function classLoading() {
         setTimeout(function () {
            $('.loader_bg').fadeToggle();
         }, 1500);
      }
   </script>
   <?php
   session_start();
   
   $rol = $_SESSION['rol'];

   if($rol=="PASAJERO"){
      $usuario=$_SESSION['username'];
   }else if($rol=="RECEPCIONISTA"){
      header("location: ../Vista/viewReception");
   }else{
      header("location: ../Vista/login");
   }

   ?>

   <div class="loader_bg">
      <div class="loader"><img src="/Resources/Images/loading.gif"></div>
   </div>

   <header>
      <div class="header">
         <div class="header_white_section">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-md-12">
                     <div class="header_information">
                        <ul style="margin-right: 65px;">
                           <li id="nameUser"><img src="/Resources/Images/profile-user.png" /><a>
                                 <?php echo"Welcome, $usuario";?>
                              </a></li>
                           <li id="signOff"><img src="/Resources/Images/sign_off.png" alt="#" /><a
                                 href="/Models/logout.php"> SIGN OFF</a></li>
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
                           <li class="active"> <a>Home</a> </li>
                        </ul>
                     </nav>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </header>

   <section >
         <div class="banner-main">
            <img src="/Resources/Images/Guatape.jpg"/>
            <div class="container">
               <div class="text-bg">
                  <h1>Colombia<br><strong class="blue">Amazing </strong><strong class="red">Tour</strong></h1>
                  <div class="button_section">
                  <a href="#from-Search" class="tm-down-arrow-link"><i class="fa fa-2x fa-angle-down tm-down-arrow"></i></a>       
                  </div>
                  
                  <div class="container">

                     <form class="main-form" id="from-Search" method="get" action="/Controllers/viewReservation.php">
                        <h3>Find Your Way</h3>
                        <div class="row">
                           <div class="col-md-9">
                              <div class="row">

                                 <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                    <label >Origin</label>
                                    <select class="form-control" name="Origen" class="Travel" id="Origin"></select>
                                 </div>

                                 <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                 </div>

                                 <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                    <label >Adults</label>
                                    <input type="number" class="form-control" id="Adults" name="Adulto" min="0" max="9">
                                 </div>

                                 <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                    <label >Destination</label>
                                    <select class="form-control" class="Travel" name="Destino" id="Destiny" disabled></select>
                                 </div>

                                 <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                    <label >Date</label>
                                    <input class="form-control" id="date" name="Fecha" type="date" min="<?php echo date("Y-m-d");?>" >
                                 </div>

                                 <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                                    <label >Children</label>
                                    <input type="number" class="form-control" id="Children" name="Ninos" min="0" max="9" onchange="ShowSelected();" disabled>
                                 </div>
                              </div>
                           </div>
                           <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                              <input type="submit" class="btn btn-success btn-lg btn-block" style="top: 40%; position:relative;" value="SEARCH">
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </section>


</main>