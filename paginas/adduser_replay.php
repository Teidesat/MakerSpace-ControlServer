<!-- Servidor web de ULL Makerspace -->
<!-- Diseñado por Salvador Pérez del Pino -->
<!DOCTYPE html>
<html>
  <body>
    <!-- Añadir ususario (codigo de tarjeta) a la base de datos-->
    <?php
      // Request de la forma: ?uid=X&psswd=Y
      $uid = $_GET["uid"];
      $psswd = $_GET["psswd"];
      $db = pg_connect("host=localhost port=5432 dbname=makerspacecontrol user=postgres password=postgres") or die("Could not connect");
      $consulta = "SELECT uid FROM usuarios WHERE uid = '$uid';";
      $resultado = pg_query($consulta);
      $usuario = pg_fetch_row($resultado);

      // Crear entrada con la tarjeta nueva en la base de datos si no existía
      if(is_null($usuario)) {
        $consulta = "INSERT INTO usuarios VALUES('$uid', '$psswd', 'pendiente de añadir', '', '', '');";
        $resultado = pg_query($consulta);

        $consulta = "INSERT INTO permisos VALUES('$uid', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);";
        $resultado = pg_query($consulta);
      }
      echo '<p>'.$usuario[0].'</p>';
    ?>
  </body>
</html>
