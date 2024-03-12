<!-- Servidor web de ULL Makerspace -->
<!-- Diseñado por Salvador Pérez del Pino -->
<!DOCTYPE html>
<html>
  <body>
    <!-- Buscar si el ususario tiene permisos para abrir el armario-->
    <?php
        // Request de la forma: ?uid=X&psswd=Y&locker=Z
        $uid = $_GET["uid"];
        $psswd = $_GET["psswd"];
        $armario = $_GET["locker"];
        $db = pg_connect("host=localhost port=5432 dbname=makerspacecontrol user=postgres password=postgres") or die("Could not connect");
        $consulta = "SELECT nombre FROM usuarios NATURAL JOIN permisos WHERE armario_$armario = 1 and uid = '$uid';";
        $resultado = pg_query($consulta);
        $usuario = pg_fetch_row($resultado);

        echo '<p>'.$usuario[0].'</p>';
      //}
    ?>
  </body>
</html>