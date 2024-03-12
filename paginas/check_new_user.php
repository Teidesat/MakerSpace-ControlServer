<!-- Servidor web de ULL Makerspace -->
<!-- Diseñado por Salvador Pérez del Pino -->
<!DOCTYPE html>
<html>
  <body>
    <!-- Comprobar que el usuario existe -->
    <?php
      // Request de la forma: ?uid=X&psswd=Y
      $uid = $_GET["uid"];
      $db = pg_connect("host=localhost port=5432 dbname=makerspacecontrol user=postgres password=postgres") or die("Could not connect");
      $consulta = "SELECT uid FROM usuarios WHERE uid = '$uid';";
      $resultado = pg_query($consulta);
      $usuario = pg_fetch_row($resultado);

      if(is_null($usuario)) {echo '<p>%-1%</p>';}
      else {echo '<p>%'.$usuario[2].'%</P>';}
    ?>
  </body>
</html>