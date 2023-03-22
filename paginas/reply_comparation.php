<!-- Servidor web de ULL Makerspace -->
<!-- Diseñado por Salvador Pérez del Pino -->
<!DOCTYPE html>
<html>
  <body>
    <?php
      //if($_SERVER['REQUEST_METHOD'] == 'GET') {
        // Retrieve data from URI
        // Request de la forma: uid=X&psswd=Y&locker=Z
        //                      \-4-/ \--6-/  \--7--/
        $uid = $_GET["uid"];
        $psswd = $_GET["psswd"];
        $armario = $_GET["locker"];

        $db = pg_connect("host=localhost port=5432 dbname=makerspacecontrol user=postgres password=postgres") or die("Could not connect");
        // Selecciona el nombre del usuario que tenga permiso en ese armario con esa tarjeta
        $consulta = "SELECT nombre FROM usuarios natural join permisos WHERE armario_1 = '$armario' and uid = '$uid';";
        //echo '<p>'.$uid.'</p>';
        //echo '<p>'.$psswd.'</p>';
        //echo '<p>'.$armario.'</p>';
        //echo '<p>'.$consulta.'</p>';
        $resultado = pg_query($consulta);
        $usuario = pg_fetch_row($resultado);


        
        // Envia el resultado al cliente
        // joson_encode(array('usuario'=>$user));
        // devolver la respuesta al cliente
        //header('Content-Type: text/plain');
        //header('HTTP/1.1 200 OK');
        echo '<p>'.$usuario[0].'</p>';
      //}
    ?>
  </body>
</html>