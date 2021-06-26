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

  function toogle($id){

    $sql = "SELECT SUM(reserva.cant_pasaj) as Num 
          FROM vuelos 
          LEFT JOIN reserva ON reserva.vuelo_id = vuelos.id_vuelo
          WHERE vuelos.id_vuelo = '".$id."' ";
    try {
      $sentencia = $this->connect()->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
      $sentencia->execute();

      if ($sentencia->rowCount() > 0) :
        $datos = $sentencia->fetch();
        echo json_encode(array('error' => false, 'num' => $datos['Num']));
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
    $sql = "SELECT id_vuelo, ciudad_origen_vuelo, ciudad_destino_vuelo, fecha_vuelo 
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

  function uploadPassenger($id_pas, $id_res){

    $estado = "SIN PAGAR";
    try{
      $sentencia = $this->connect()->prepare("INSERT INTO pasaXreser (id_pasajero, nombre_reserva, estado_pago) 
              VALUES (?, ?, ?)");

              $sentencia->bindParam(1, $id_pas);
              $sentencia->bindParam(2, $id_res);
              $sentencia->bindParam(3, $estado);

              $sentencia->execute();
              return 1;
    }catch(PDOException $e){
      return $e->getMessage();
    }
    $sentencia = null;

  }

  function deletResse($id_res){
    $sql = "DELETE FROM `pasaXreser` WHERE `nombre_reserva`= ':id_res'";
    $q = $this->connect()->prepare($sql);
    $q-> bindParam(':id_res', $id_res, PDO::PARAM_INT);
    $q->execute();
      if($q->rowCount() > 0){
        return 1;

      }else{
        return $q->errorInfo(); 
      }

  }

  function reservations($id, $origen, $destino, $pasajeros, $maleta, $check, $precio, $id_res){
    try{
      session_start();
      
      $Tipo1 = "INDIVIDUAL";
      $Tipo2 = "GRUPAL";

      $_SESSION['id_reserva'] = $id_res;
      $_SESSION['precio_reserva'] = $precio;
      $_SESSION['org_res'] = $origen;
      $_SESSION['des_res'] = $destino;
      

      $sentencia = $this->connect()->prepare("INSERT INTO reserva (nombre_reserva, tipo_reserva, cant_pasaj, vuelo_id, valor_pasaj) 
              VALUES (?, ?, ?, ?, ?)");

              $sentencia->bindParam(1, $id_res);
              if($pasajeros > 1){
                $sentencia->bindParam(2, $Tipo2);
              }else{
                $sentencia->bindParam(2, $Tipo1);
              }
              $sentencia->bindParam(3, $pasajeros);
              $sentencia->bindParam(4, $id);  
              $sentencia->bindParam(5, $precio);

              $sentencia->execute();

      if($maleta == "Yes"){
        $sentencia = $this->connect()->prepare("INSERT INTO equipaje (id_maleta, tipo_maleta, origen_equipaje, destino_equipaje, reserva_id) 
                VALUES (?, ?, ?, ?, ?)");
                $sentencia->bindParam(1, rand(1, 9000));
                $sentencia->bindParam(2, $check);
                $sentencia->bindParam(3, $origen);
                $sentencia->bindParam(4, $destino);
                $sentencia->bindParam(5, $id_res);
          
                $sentencia->execute();
      }
      
      return 1;

    }catch(PDOException $e) {
      return $e->getMessage();
    }

  }

  
  
}
