<?php
    class Persona extends Controllers{

        function users(){
            $user = $_POST["userLG"];
            $password = $_POST["passLG"];

            $res = $this->model->searchUser($user, $password);
            echo $res;
        }

        function obtenerTodo(){
            $res = $this->model->selectCities();
            if (is_array($res)) 
                echo json_encode($res);
            else
                echo $res;
        }

        function getFlights(){
            $origen= $_POST['origen'];
            $destino= $_POST['destino'];
            $fecha= $_POST['fecha'];
            
            $res = $this->model->selectTravels($origen, $destino, $fecha);
            if (is_array($res)) 
                echo json_encode($res);
            else
                echo $res;
        }

        function deleteRes(){
            $id_res= $_POST['id_res'];

            $res = $this->model->deletResse($id_res);
            echo $res;
        }

        function uploadReservation(){

            $id_vuelo= $_POST['id_vuelo'];
            $origen= $_POST['origen'];
            $destino= $_POST['destino'];
            $pasajeros= $_POST['pasajeros'];
            $maleta= $_POST['maleta'];
            $check = $_POST['check'];
            $precio = $_POST['precio'];
            $id_res = $_POST['id_res'];

            $res = $this->model->reservations($id_vuelo, $origen, $destino, $pasajeros, $maleta, $check, $precio, $id_res);
            echo $res;
        }

        function uploadPassengers(){
            $id_pas = $_POST['pasajero'];
            $id_res = $_POST['id_res'];

            $res = $this->model->uploadPassenger($id_pas, $id_res);
            echo $res;
        }

        function updateResPSE(){
            $id_res = $_POST['id_res'];
            $monto = $_POST['monto'];
            $email = $_POST['email'];
            $banco = $_POST['banco'];

            $res = $this->model->updateReserPSE($id_res, $monto, $email, $banco);
            echo $res;
        }
        function updateResCREDIT(){
            $id_res = $_POST['id_res'];
            $monto = $_POST['monto'];
            $banco = $_POST['banco'];
            $fcad = $_POST['fcad'];
            $cvv = $_POST['cvv'];
            $numcard = $_POST['num'];

            $res = $this->model->updateReserCREDIT($id_res, $monto, $banco, $fcad, $cvv, $numcard);
            echo $res;
        }

        function addPay(){
            session_start();

            $_SESSION['id_reserva'] = $_POST['id_res'];
            $_SESSION['precio_reserva'] = $_POST['monto'];
        }
    }