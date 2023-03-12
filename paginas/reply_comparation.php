<!-- Servidor web de ULL Makerspace -->
<!-- Diseñado por Salvador Pérez del Pino -->
<!DOCTYPE html>
<link rel="stylesheet" href="./css/content.css">
<html>
  <?php include('./html/cabeza.html')?>

  <body>
    <?php include('./html/cabecera.html')?>
    <?php include('./html/barra-navegacion.html')?>



    <?php
      if($_SERVER['REQUEST_METHOD'] == 'GET') {
        // Retrieve data from URI
        // Request de la forma: uid=X&locker=Y
        //                      \-4-/ \--7--/
        $uidLen = 4;
        $lockerLen = 7;
        $data = $_SERVER["QUERY_STRING"];
        $uid = substr($data, $uidLen, stripos($data, "&") - 1);
        $locker = substr($data, stripos($data, "&") + 1 + $userLen, strlen($data));
        $db = new SQLite3('../bbdd/makerspace.db');
        // Selecciona el nombre del usuario que tenga permiso en ese armario con esa tarjeta
        $query = "SELECT CONCAT(nombre, apellidos) FROM usuarios natural join permisos WHERE armario_$locker = 1 and card_id = '$uid';";
        $resultado = $db->query($query);
        if (!$resultado) {die($db->lastErrorMsg());} else {
          $user = $resultado->fetchArray();
        }

        $db->close();
        // Envia el resultado al cliente
        joson_encode(array('usuario'=>$user));
      }
    ?>
  </body>
</html>

