<!-- Servidor web de ULL Makerspace -->
<!-- Diseñado por Salvador Pérez del Pino -->
<!DOCTYPE html>
<link rel="stylesheet" href="./css/content.css">
<html>
  <body>
    <?php
      if($_SERVER['REQUEST_METHOD'] == 'GET') {
        // Retrieve data from URI
        // Request de la forma: uid=X&psswd=Y&locker=Z
        //                      \-4-/ \--6-/  \--7--/
        $uidLen = 4;
        $psswdLen = 6;
        $lockerLen = 7;
        $data = $_SERVER["QUERY_STRING"];
        $uid = substr($data, $uidLen, stripos($data, "&") - 1);
        $data = substr(stripos($data, "&") + 1, strlen($data));
        $passwd = substr($data, stripos($data, "&") + 1, strlen($data));
        $db = new SQLite3('../bbdd/acceso_makerspace.db');
        // Selecciona el nombre del usuario que tenga permiso en ese armario con esa tarjeta
        $query = "SELECT nombre FROM usuarios natural join permisos WHERE armario_1 = 1 and id_usuario = '$uid';";
        echo "uid = '$uid'";
        echo "passwd = '$passwd'";
        echo "locker = '$locker'";
        /*
        $resultado = $db->query($query);
        if (!$resultado) {die($db->lastErrorMsg());} else {
          $user = $resultado->fetchArray();
        }
        */
        $db->close();
        // Envia el resultado al cliente
        // joson_encode(array('usuario'=>$user));
        // devolver la respuesta al cliente
        header('Content-Type: text/plain');
        header('HTTP/1.1 200 OK');
        // echo resultado;
      }
    ?>
  </body>
</html>

