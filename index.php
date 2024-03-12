<!-- Servidor web de ULL Makerspace -->
<!-- Diseñado por Salvador Pérez del Pino -->
<!DOCTYPE html>
<link rel="stylesheet" href="./css/content.css">
<html>
  <?php include('./html/cabeza-index.html') ?>

  <body>
    <!-- #######  QUERÍAS UN EASTER EGG, NO JOSH? AQUÍ LO TIENES #########-->
    <?php include('./html/cabecera-index.html') ?>
    <?php include('./html/barra-navegacion.html') ?>
    
    <?php
      $db = pg_connect("host=localhost port=5432 dbname=makerspacecontrol user=postgres password=postgres") or die("Could not connect");
      $consulta = "SELECT * FROM usuarios";
      $resultado = pg_query($consulta);
    ?>

    <!-- Lista de usuarios para modificar -->
    <form>
      <label>Editar usuario</label>
      <select id="opcion" onchange="redirigir()">
        <option value="">------</option>
        <?php
          $consulta = "SELECT * FROM usuarios;";
          $resultado = pg_query($consulta);
          while ($usuario = pg_fetch_row($resultado)) {
            echo '<option value="'.$usuario[0].'">'.$usuario[0].': '.$usuario[2].' '.$usuario[3].'<br>'.'</option>';
          }
        ?>
      </select>
    </form>

    <!-- Tabla de usuarios -->
    <div id="fondoElementos">
      <table >
        <tr id='index'>
          <th>ID Tarjeta</th>
          <th>Nombre</th>
          <th>Apellidos</th>
          <th>Correo</th>
          <th>Rol</th>
          <th>Entrada</th>
          <th>Almacen</th>
          <th>Armario 3d</th>
          <th>armario 1</th>
          <th>armario 2</th>
          <th>armario 3</th>
          <th>armario 4</th>
          <th>armario 5</th>
          <th>armario 6</th>
          <th>armario 7</th>
          <th>armario 8</th>
          <th>armario 9</th>
        </tr>
      <?php
        //mostrar las filas de la tabla de usuarios y sus permisos
        $consulta = "SELECT * FROM usuarios NATURAL JOIN permisos;";
        $resultado = pg_query($consulta);
        while ($usuario = pg_fetch_row($resultado)) {
          echo '<tr>';
            // datos del usuario
            echo '<td>'.$usuario[0].'</td>';
            echo '<td>'.$usuario[2].'</td>';
            echo '<td>'.$usuario[3].'</td>';
            echo '<td>'.$usuario[4].'</td>';
            echo '<td>'.$usuario[5].'</td>';
            // permisos del usuario
            echo '<td>'.(($usuario[6] == 1) ? 'Si' : '').'</td>';
            echo '<td>'.(($usuario[7] == 1) ? 'Si' : '').'</td>';
            echo '<td>'.(($usuario[8] == 1) ? 'Si' : '').'</td>';
            echo '<td>'.(($usuario[9] == 1) ? 'Si' : '').'</td>';
            echo '<td>'.(($usuario[10] == 1) ? 'Si' : '').'</td>';
            echo '<td>'.(($usuario[11] == 1) ? 'Si' : '').'</td>';
            echo '<td>'.(($usuario[12] == 1) ? 'Si' : '').'</td>';
            echo '<td>'.(($usuario[13] == 1) ? 'Si' : '').'</td>';
            echo '<td>'.(($usuario[14] == 1) ? 'Si' : '').'</td>';
            echo '<td>'.(($usuario[15] == 1) ? 'Si' : '').'</td>';
            echo '<td>'.(($usuario[16] == 1) ? 'Si' : '').'</td>';
            echo '<td>'.(($usuario[17] == 1) ? 'Si' : '').'</td>';
          echo '</tr>';
        }
      ?>
      </table>
    </div>
  </body>
  <script src="./../js/redirigir.js"></script>
  </body>
</html>
