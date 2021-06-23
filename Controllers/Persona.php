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
        

    }