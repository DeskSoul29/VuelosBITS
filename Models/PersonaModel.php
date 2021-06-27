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
    $sql = "SELECT vuelos.id_vuelo, vuelos.ciudad_origen_vuelo, vuelos.ciudad_destino_vuelo, vuelos.fecha_vuelo, COUNT(pasaXreser.estado_pago)as suma
            FROM vuelos 
              LEFT JOIN reserva ON reserva.vuelo_id = vuelos.id_vuelo 
              LEFT JOIN pasaXreser ON pasaXreser.nombre_reserva = reserva.nombre_reserva
                WHERE vuelos.ciudad_origen_vuelo='".$origen."' AND vuelos.ciudad_destino_vuelo='".$destino."' AND vuelos.fecha_vuelo='".$fecha."'
                GROUP BY vuelos.id_vuelo";

    // $sql = "SELECT id_vuelo, ciudad_origen_vuelo, ciudad_destino_vuelo, fecha_vuelo 
    //         FROM vuelos 
    //         WHERE ciudad_origen_vuelo='".$origen."' AND ciudad_destino_vuelo = '".$destino."' AND fecha_vuelo='".$fecha."'; ";

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
    
    try {

      $sql = "DELETE FROM pasaXreser WHERE nombre_reserva = :id";
	    $stmt = $this->connect()->prepare($sql);
	    $stmt->bindParam(':id', $id_res);
	    $stmt->execute();

      $sql2 = "DELETE FROM equipaje WHERE reserva_id = :id";
      $stmt2 = $this->connect()->prepare($sql2);
	    $stmt2->bindParam(':id', $id_res);
	    $stmt2->execute();

      $sql3 = "DELETE FROM reserva WHERE nombre_reserva = :id";
      $stmt3 = $this->connect()->prepare($sql3);
	    $stmt3->bindParam(':id', $id_res);
	    $stmt3->execute();

      return 1;
    } catch(PDOException $e) {
      echo $e->getMessage();
    }

  }

  function reservations($id, $origen, $destino, $pasajeros, $maleta, $check, $precio, $id_res){
    try{
      session_start();
      
      $Tipo1 = "INDIVIDUAL";
      $Tipo2 = "GRUPAL";

      $_SESSION['id_reserva'] = $id_res;
      $_SESSION['precio_reserva'] = $precio;
      

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
                $sentencia->bindParam(1, rand(1000, 9000));
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


  function updateReserPSE($id_res, $monto, $email, $banco){
    try{
      $pago = "PAGADO";

      $sentencia = $this->connect()->prepare("INSERT INTO pse (correopagador, bancoapagar, monto, id_res) 
              VALUES (?, ?, ?, ?)");
      $sentencia->bindParam(1, $email);
      $sentencia->bindParam(2, $banco);
      $sentencia->bindParam(3, $monto);
      $sentencia->bindParam(4, $id_res);
      $sentencia->execute();

      $sentencia2 = $this->connect()->prepare("UPDATE pasaXreser SET estado_pago = ?
                            WHERE nombre_reserva = ?");
      $sentencia2->bindValue(1, $pago, PDO::PARAM_STR);
      $sentencia2->bindValue(2, $id_res, PDO::PARAM_STR);
      $sentencia2->execute();

      return 1;
    }catch(PDOException $e) {
      return $e->getMessage();
    }
  }

  function updateReserCREDIT($id_res, $monto, $banco, $fcad, $cvv, $numcard){
    try{
      $pago = "PAGADO";

      $sentencia = $this->connect()->prepare("INSERT INTO tarjetacredito (numero, fechavencimiento, cvv, bancoapagar, monto, id_res) 
              VALUES (?, ?, ?, ?, ?, ?)");
      $sentencia->bindParam(1, $numcard);
      $sentencia->bindParam(2, $fcad);
      $sentencia->bindParam(3, $cvv);
      $sentencia->bindParam(4, $banco);
      $sentencia->bindParam(5, $monto);
      $sentencia->bindParam(6, $id_res);
      $sentencia->execute();

      $sentencia2 = $this->connect()->prepare("UPDATE pasaXreser SET estado_pago = ?
                            WHERE nombre_reserva = ?");
      $sentencia2->bindValue(1, $pago, PDO::PARAM_STR);
      $sentencia2->bindValue(2, $id_res, PDO::PARAM_STR);
      $sentencia2->execute();


      return 1;
    }catch(PDOException $e) {
      return $e->getMessage();
    }
  }

  
  
}
