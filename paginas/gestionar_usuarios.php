<!-- Servidor web de ULL Makerspace -->
<!-- Diseñado por Salvador Pérez del Pino-->
<!DOCTYPE html>
<link rel="stylesheet" href="./../css/content.css">
<html>
  <?php include('./../html/cabeza-paginas.html')?>

  <body>
    <?php include('./../html/cabecera-paginas.html')?>
    <?php include('./../html/barra-navegacion-paginas.html')?>

    <!-- Acceso a la base de datos de usuarios y consultas-->
    <?php
      $db = pg_connect("host=localhost port=5432") or die("Could not connect");

      $stat = pg_connection_status($dbconn);
      if ($stat === PGSQL_CONNECTION_OK) {echo 'Connection status ok';} 
      else {echo 'Connection status bad';}    
      $consulta = "SELECT * FROM usuarios";
      //$resultado = pg_query($consulta);
      //if(!$resultado) {die($db->lastErrorMsg());}
    ?>

    <!-- Lista de usuarios para modificar -->
    <form>
      <label>Editar usuario</label>
      <select id="opcion" onchange="redirigirEdicionUsuario()">
        <option value="">------</option>
        <?php
          /*$resultado = pg_query("SELECT * FROM usuarios;");
          while ($usuario = $resultado->fetchArray()) {
            echo '<option value="'.$usuario['uid'].'">'.$usuario['nombre'].' '.$usuario['apellidos'].'<br>'.'</option>';
          }*/
        ?>
      </select>
    </form>

    <!-- Tabla de usuarios -->
    <div id="fondoElementos">
      <table >
        <tr id='index'>
          <th>ID Usuario</th>
          <th>Nombre</th>
          <th>Apellidos</th>
          <th>Correo</th>
          <th>Rol</th>
        </tr>
      <?php
        //mostrar las filas de la tabla de usuarios
        /*while ($usuario = $resultado->fetchArray()) {
          echo '<tr>';
            echo '<td>'.$usuario['uid'].'</td>';
            echo '<td>'.$usuario['nombre'].'</td>';
            echo '<td>'.$usuario['apellidos'].'</td>';
            echo '<td>'.$usuario['correo'].'</td>';
            echo '<td>'.$usuario['rol'].'</td>';
          echo '</tr>';
        }*/
        //$db->close();
      ?>
      </table>
    </div>
  </body>
  <script src="./../js/redirigir.js"></script>
</html>