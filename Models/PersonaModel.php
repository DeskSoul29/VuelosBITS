<?php
class PersonaModel extends DB{

  function searchUser($user, $pass)  {
    sleep(1);
    session_start();

    $sql = "SELECT usuario.usuario, usuario.contraseña, usuario.email, persona.roll
                    FROM usuario 
                        LEFT JOIN persona ON usuario.cedula = persona.cedula
                        WHERE usuario.email= '" . $user . "' AND usuario.contraseña = '" . $pass . "' ";

    try {
      $sentencia = $this->connect()->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
      $sentencia->execute();

      if ($sentencia->rowCount() > 0) :
        $datos = $sentencia->fetch();
        $_SESSION['username'] = $datos['usuario'];
        $_SESSION['rol'] = $datos['roll'];
        echo json_encode(array('error' => false, 'rol' => $datos['roll']));
      else :
        echo json_encode(array('error' => true));
      endif;

      $sentencia = null;
    } catch (PDOException $e) {
      print $e->getMessage();
    }
  }

  function selectCities(){
    $sql = "SELECT ciudad_aeropuerto FROM aeropuerto ";

    try {
      $sentencia = $this->connect()->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
      $sentencia->execute();

      $datos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
      return array('results' => $datos);
    } catch (PDOException $e) {
      return $e->getMessage();
    }
    $sentencia = null;
  }

  function selectTravels($origen, $destino, $fecha){
    $sql = "SELECT ciudad_origen_vuelo, ciudad_destino_vuelo, fecha_vuelo 
            FROM vuelos 
            WHERE ciudad_origen_vuelo='".$origen."' AND ciudad_destino_vuelo = '".$destino."' AND fecha_vuelo='".$fecha."'; ";

    try {
      $sentencia = $this->connect()->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
      $sentencia->execute();

      $datos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
      return json_encode(array('results' => $datos));
      
    } catch (PDOException $e) {
      return $e->getMessage();
    }
    $sentencia = null;
  }
}
