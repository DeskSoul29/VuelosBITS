<?php
    class Persona extends Controllers{

        function users(){
            $user = $_POST["pers_ced"];
            $password = $_POST["pers_nombre"];

            $res = $this->model->searchUser($user, $password);
            echo $res;
        }

    }