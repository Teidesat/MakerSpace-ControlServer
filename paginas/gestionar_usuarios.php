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
      $db = pg_connect("host=localhost port=5432 dbname=makerspacecontrol user=postgres password=postgres") or die("Could not connect");
      $consulta = "SELECT * FROM usuarios";
      $resultado = pg_query($consulta);
    ?>

    <!-- Lista de usuarios para modificar -->
    <form>
      <label>Editar usuario</label>
      <select id="opcion" onchange="redirigirEdicionUsuario()">
        <option value="">------</option>
        <?php
          $resultado = pg_query("SELECT * FROM usuarios;");
          while ($usuario = pg_fetch_row($resultado)) {
            echo '<option value="'.$usuario[0].'">'.$usuario[1].' '.$usuario[2].'<br>'.'</option>';
          }
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
        $resultado = pg_query("SELECT * FROM usuarios;");
        while ($usuario = pg_fetch_row($resultado)) {
          echo '<tr>';
            echo '<td>'.$usuario[0].'</td>';
            echo '<td>'.$usuario[2].'</td>';
            echo '<td>'.$usuario[3].'</td>';
            echo '<td>'.$usuario[4].'</td>';
            echo '<td>'.$usuario[5].'</td>';
          echo '</tr>';
        }
      ?>
      </table>
    </div>
  </body>
  <script src="./../js/redirigir.js"></script>
</html>
