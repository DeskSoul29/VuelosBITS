<?php
class PersonaModel extends Connection{

    function searchUser($user, $pass){
        $hostname = 'localhost';
        $database = 'db_vuelos';
        $username = 'desksoul';
        $password = 'jcrn2917';

        $conexion = new mysqli($hostname, $username, $password, $database);

        $consulta = "SELECT email_usuario, contrasena 
                    FROM usuario 
                    WHERE email_usuario = '".$user."' AND contrasena = '".$pass."' ";

        
        if($sentencia= $conexion->prepare($consulta)){
        //    $sentencia->execute();
            $data = $sentencia->execute();
            $sentencia->store_result();

            printf("Numero de filas %d.\n", $sentencia->num_rows);
            $result = $sentencia->fetch();

            printf("Result");
            print_r($result);
            printf("Data");
            print_r($data);

            $data = array('results' => $data);

            echo json_encode($data);
            $sentencia->close();
        }
        

        mysqli_query($conexion, $consulta) or die(mysqli_connect_error());
        mysqli_close($conexion);
        

        /* $hostname = 'localhost';
        $database = 'db_vuelos';
        $username = 'desksoul';
        $password = 'jcrn2917';
        $mysqli = new mysqli($hostname, $username, $password, $database);

        $consulta = $mysqli->query("SELECT `email_usuario` 
                                    FROM `usuario` 
                                    WHERE `email_usuario` = '".$user."'");

        if($consulta->num_rows==1):
            $datos = $consulta->fetch_assoc();
            $e = json_encode(array('error'=>false,'tipo'=> $datos['email_usuario']));
        else:
            $e = json_encode(array('error'=>true));
        endif;

        return $e;

        $mysqli->close(); */
        

        /* $columns = "`email_usuario`,`contraseña`";
        $tables = "usuario";
        $where = "`email_usuario` = 'jhannavarro2001@gmail.com'";
        $params = "";

        return $this->db->select($columns, $tables, $where, $params); */
    }
}